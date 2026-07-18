-- ============================================================
--  SmartTutor Database Schema
--  File       : 04_plsql_features.sql
--  Database   : Oracle 11g XE
--  Description: Demonstrates all advanced PL/SQL concepts from
--               the Lab Manual (Triggers, Procs, Views, Cursors)
-- ============================================================

-- ============================================================
-- 1. VIEWS & QUERIES (Date, String, Numeric, Aggregate Functions)
-- ============================================================
CREATE OR REPLACE VIEW V_ACTIVE_POSTS AS
SELECT 
    p.post_id,
    s.full_name AS student_name,
    sub.subject_name,
    loc.area_name || ', ' || loc.district AS full_location, -- String Concatenation
    NVL(p.additional_info, 'No additional info provided') AS info, -- NVL Function
    p.monthly_salary,
    ROUND(p.monthly_salary / p.days_per_week, 2) AS per_day_salary, -- Numeric Function (ROUND)
    TO_CHAR(p.created_at, 'DD-MON-YYYY') AS post_date -- Date Function (TO_CHAR)
FROM 
    ST_TUITION_POST p
JOIN ST_STUDENT s ON p.student_id = s.student_id
JOIN ST_SUBJECT sub ON p.subject_id = sub.subject_id
JOIN ST_LOCATION loc ON p.location_id = loc.location_id
WHERE 
    p.status = 'open' 
    AND EXTRACT(MONTH FROM p.created_at) = EXTRACT(MONTH FROM SYSDATE); -- Date Functions (EXTRACT, SYSDATE)

-- ============================================================
-- 2. PL/SQL TRIGGERS (Notification System)
-- ============================================================

-- Trigger 1: Notify Student when a Tutor applies
CREATE OR REPLACE TRIGGER trg_notify_on_apply
AFTER INSERT ON ST_APPLICATION
FOR EACH ROW
DECLARE
    v_student_user_id NUMBER;
    v_tutor_name VARCHAR2(100);
BEGIN
    -- Get the user_id of the student who owns the post
    SELECT s.user_id INTO v_student_user_id
    FROM ST_TUITION_POST p
    JOIN ST_STUDENT s ON p.student_id = s.student_id
    WHERE p.post_id = :NEW.post_id;
    
    -- Get the tutor's name
    SELECT full_name INTO v_tutor_name FROM ST_TUTOR WHERE tutor_id = :NEW.tutor_id;
    
    -- Insert notification
    INSERT INTO ST_NOTIFICATION (user_id, title, message)
    VALUES (v_student_user_id, 'New Application', v_tutor_name || ' has applied to your tuition post!');
END;
/

-- Trigger 2: Notify Tutor and Admin when their application is accepted
CREATE OR REPLACE TRIGGER trg_notify_on_approve
AFTER UPDATE OF status ON ST_APPLICATION
FOR EACH ROW
WHEN (NEW.status = 'accepted' AND OLD.status != 'accepted')
DECLARE
    v_tutor_user_id NUMBER;
    v_tutor_name VARCHAR2(100);
    v_student_name VARCHAR2(100);
    v_admin_user_id NUMBER;
BEGIN
    -- Get the user_id and name of the tutor
    SELECT user_id, full_name INTO v_tutor_user_id, v_tutor_name FROM ST_TUTOR WHERE tutor_id = :NEW.tutor_id;
    
    -- Get the student's name
    SELECT s.full_name INTO v_student_name
    FROM ST_TUITION_POST p
    JOIN ST_STUDENT s ON p.student_id = s.student_id
    WHERE p.post_id = :NEW.post_id;
    
    -- Insert notification for tutor
    INSERT INTO ST_NOTIFICATION (user_id, title, message)
    VALUES (v_tutor_user_id, 'Application Accepted', 'Congratulations! ' || v_student_name || ' has accepted your application.');
    
    -- Insert notification for admin
    BEGIN
        SELECT user_id INTO v_admin_user_id FROM ST_USER WHERE role = 'admin' AND ROWNUM = 1;
        INSERT INTO ST_NOTIFICATION (user_id, title, message)
        VALUES (v_admin_user_id, 'Successful Tuition Match', 'Student ' || v_student_name || ' has hired Tutor ' || v_tutor_name || '!');
    EXCEPTION
        WHEN NO_DATA_FOUND THEN NULL;
    END;
END;
/

-- Trigger 3: Notify Admin when a new account is created
CREATE OR REPLACE TRIGGER trg_notify_admin_on_user
AFTER INSERT ON ST_USER
FOR EACH ROW
DECLARE
    PRAGMA AUTONOMOUS_TRANSACTION;
    v_admin_user_id NUMBER;
BEGIN
    -- Get the admin's user_id
    SELECT user_id INTO v_admin_user_id FROM ST_USER WHERE role = 'admin' AND ROWNUM = 1;
    
    -- Insert notification for admin
    INSERT INTO ST_NOTIFICATION (user_id, title, message)
    VALUES (v_admin_user_id, 'New User Registration', 'A new user has registered with email: ' || :NEW.email);
    
    COMMIT;
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        ROLLBACK; -- Do nothing if no admin exists yet
    WHEN OTHERS THEN
        ROLLBACK;
END;
/

-- ============================================================
-- 3. PROCEDURES & FUNCTIONS (With TCL & Exceptions)
-- ============================================================

-- Function: Get total applications for a post using Aggregate Function (COUNT)
CREATE OR REPLACE FUNCTION FUNC_GET_TOTAL_APPS(p_post_id IN NUMBER) 
RETURN NUMBER IS
    v_count NUMBER;
BEGIN
    SELECT COUNT(*) INTO v_count FROM ST_APPLICATION WHERE post_id = p_post_id;
    RETURN v_count;
EXCEPTION
    WHEN OTHERS THEN
        RETURN 0;
END;
/

-- Procedure: Accept a tutor's application and hire them
CREATE OR REPLACE PROCEDURE PROC_HIRE_TUTOR (
    p_post_id IN NUMBER, 
    p_tutor_id IN NUMBER
) IS
    v_post_status VARCHAR2(10);
BEGIN
    -- Start Transaction
    SAVEPOINT before_hire;
    
    -- Check if post exists and is open
    SELECT status INTO v_post_status FROM ST_TUITION_POST WHERE post_id = p_post_id FOR UPDATE;
    
    IF v_post_status != 'open' THEN
        RAISE_APPLICATION_ERROR(-20001, 'Post is already assigned or closed.');
    END IF;

    -- 1. Update the hired application to accepted
    UPDATE ST_APPLICATION 
    SET status = 'accepted' 
    WHERE post_id = p_post_id AND tutor_id = p_tutor_id;
    
    IF SQL%ROWCOUNT = 0 THEN
        RAISE_APPLICATION_ERROR(-20002, 'Tutor application not found.');
    END IF;
    
    -- 2. Reject all other applications for this post
    UPDATE ST_APPLICATION 
    SET status = 'rejected' 
    WHERE post_id = p_post_id AND tutor_id != p_tutor_id;
    
    -- 3. Update the post to assigned and set the hired tutor
    UPDATE ST_TUITION_POST 
    SET status = 'assigned', hired_tutor_id = p_tutor_id 
    WHERE post_id = p_post_id;
    
    -- Commit Transaction
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Successfully hired tutor for post ' || p_post_id);
    
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        ROLLBACK TO before_hire;
        DBMS_OUTPUT.PUT_LINE('Error: Post not found.');
    WHEN OTHERS THEN
        ROLLBACK TO before_hire;
        DBMS_OUTPUT.PUT_LINE('Error: ' || SQLERRM);
END;
/

-- ============================================================
-- 4. CURSORS & ANONYMOUS BLOCKS
-- ============================================================
-- Example script to print all pending applications using an Explicit Cursor
/*
SET SERVEROUTPUT ON;
DECLARE
    CURSOR cur_apps IS 
        SELECT a.application_id, t.full_name, p.monthly_salary
        FROM ST_APPLICATION a
        JOIN ST_TUTOR t ON a.tutor_id = t.tutor_id
        JOIN ST_TUITION_POST p ON a.post_id = p.post_id
        WHERE a.status = 'pending';
    
    v_app cur_apps%ROWTYPE;
BEGIN
    OPEN cur_apps;
    LOOP
        FETCH cur_apps INTO v_app;
        EXIT WHEN cur_apps%NOTFOUND;
        DBMS_OUTPUT.PUT_LINE('App ID: ' || v_app.application_id || ' | Tutor: ' || v_app.full_name || ' | Salary: ' || v_app.monthly_salary);
    END LOOP;
    CLOSE cur_apps;
END;
/
*/

-- ============================================================
-- 5. OBJECT TYPES & COLLECTIONS (VARRAY)
-- ============================================================
-- Demonstrating complex data types for a Tutor's preferred subjects
CREATE OR REPLACE TYPE Subject_Varray FORCE AS VARRAY(5) OF VARCHAR2(100);
/
CREATE OR REPLACE TYPE Tutor_Obj AS OBJECT (
    tutor_name VARCHAR2(100),
    preferred_subjects Subject_Varray
);
/

-- ============================================================
-- 6. DATA CONTROL LANGUAGE (DCL)
-- ============================================================
/*
-- Creating Roles
CREATE ROLE student_role;
CREATE ROLE tutor_role;
CREATE ROLE admin_role;

-- Granting Privileges
GRANT SELECT, INSERT, UPDATE, DELETE ON ST_TUITION_POST TO student_role;
GRANT SELECT ON ST_TUITION_POST TO tutor_role;
GRANT ALL PRIVILEGES ON ST_USER TO admin_role;

-- Revoking Privileges
REVOKE DELETE ON ST_TUITION_POST FROM student_role;
*/
