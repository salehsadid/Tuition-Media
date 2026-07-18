CREATE OR REPLACE VIEW V_ACTIVE_POSTS AS
SELECT 
    p.post_id,
    p.class_level,
    p.monthly_salary,
    p.days_per_week,
    p.created_at, 
    TO_CHAR(p.created_at, 'YYYY-MM-DD HH24:MI:SS') as formatted_date, 
    ROUND(p.monthly_salary / p.days_per_week, 2) AS per_day_salary, 
    s.subject_name,
    l.area_name,
    l.district
FROM ST_TUITION_POST p
JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
JOIN ST_LOCATION l ON p.location_id = l.location_id
WHERE p.status = 'open';
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
CREATE OR REPLACE PROCEDURE PROC_HIRE_TUTOR (
    p_post_id IN NUMBER, 
    p_tutor_id IN NUMBER
) IS
    v_post_status VARCHAR2(10);
BEGIN
    SAVEPOINT before_hire;
    SELECT status INTO v_post_status FROM ST_TUITION_POST WHERE post_id = p_post_id FOR UPDATE;
    IF v_post_status != 'open' THEN
        RAISE_APPLICATION_ERROR(-20001, 'Post is already assigned or closed.');
    END IF;
    UPDATE ST_APPLICATION 
    SET status = 'accepted' 
    WHERE post_id = p_post_id AND tutor_id = p_tutor_id;
    IF SQL%ROWCOUNT = 0 THEN
        RAISE_APPLICATION_ERROR(-20002, 'Tutor application not found.');
    END IF;
    UPDATE ST_APPLICATION 
    SET status = 'rejected' 
    WHERE post_id = p_post_id AND tutor_id != p_tutor_id;
    UPDATE ST_TUITION_POST 
    SET status = 'assigned', hired_tutor_id = p_tutor_id 
    WHERE post_id = p_post_id;
    COMMIT;
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        ROLLBACK TO before_hire;
        RAISE_APPLICATION_ERROR(-20003, 'Post not found.');
    WHEN OTHERS THEN
        ROLLBACK TO before_hire;
        RAISE;
END;
/
CREATE OR REPLACE TYPE Subject_Varray FORCE AS VARRAY(5) OF VARCHAR2(100);
/
CREATE OR REPLACE TYPE Tutor_Obj AS OBJECT (
    tutor_name VARCHAR2(100),
    preferred_subjects Subject_Varray
);
/
