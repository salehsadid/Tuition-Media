ALTER TABLE ST_NOTIFICATION MODIFY user_id NULL;
ALTER TABLE ST_NOTIFICATION ADD target_role VARCHAR2(20);
CREATE OR REPLACE TRIGGER trg_notify_student_apply
AFTER INSERT ON ST_APPLICATION
FOR EACH ROW
DECLARE
    v_student_user_id NUMBER;
BEGIN
    SELECT s.user_id INTO v_student_user_id
    FROM ST_TUITION_POST p
    JOIN ST_STUDENT s ON p.student_id = s.student_id
    WHERE p.post_id = :NEW.post_id;
    INSERT INTO ST_NOTIFICATION (user_id, title, message, target_role)
    VALUES (v_student_user_id, 'New Tutor Application', 'A tutor has applied to your tuition post.', 'student');
END;
/
CREATE OR REPLACE TRIGGER trg_notify_tutor_app_status
AFTER UPDATE OF status ON ST_APPLICATION
FOR EACH ROW
DECLARE
    v_tutor_user_id NUMBER;
    v_status_word VARCHAR2(20);
BEGIN
    IF :NEW.status IN ('accepted', 'rejected') AND :OLD.status != :NEW.status THEN
        SELECT user_id INTO v_tutor_user_id
        FROM ST_TUTOR
        WHERE tutor_id = :NEW.tutor_id;
        IF :NEW.status = 'accepted' THEN
            v_status_word := 'Accepted';
        ELSE
            v_status_word := 'Rejected';
        END IF;
        INSERT INTO ST_NOTIFICATION (user_id, title, message, target_role)
        VALUES (v_tutor_user_id, 'Application ' || v_status_word, 'Your application for a tuition post has been ' || LOWER(v_status_word) || '.', 'tutor');
    END IF;
END;
/
CREATE OR REPLACE TRIGGER trg_notify_admin_conn
AFTER UPDATE OF status ON ST_TUITION_POST
FOR EACH ROW
BEGIN
    IF :NEW.status = 'assigned' AND :OLD.status != 'assigned' THEN
        INSERT INTO ST_NOTIFICATION (user_id, title, message, target_role)
        VALUES (NULL, 'New Successful Connection', 'A tutor has been successfully assigned to a tuition post.', 'admin');
    END IF;
END;
/
CREATE OR REPLACE TRIGGER trg_notify_admin_student_reg
AFTER INSERT ON ST_STUDENT
FOR EACH ROW
BEGIN
    INSERT INTO ST_NOTIFICATION (user_id, title, message, target_role)
    VALUES (NULL, 'New Student Registration', 'A new student profile has been created: ' || :NEW.full_name, 'admin');
END;
/
CREATE OR REPLACE TRIGGER trg_notify_admin_tutor_reg
AFTER INSERT ON ST_TUTOR
FOR EACH ROW
BEGIN
    INSERT INTO ST_NOTIFICATION (user_id, title, message, target_role)
    VALUES (NULL, 'New Tutor Registration', 'A new tutor profile has been created: ' || :NEW.full_name, 'admin');
END;
/
COMMIT;
