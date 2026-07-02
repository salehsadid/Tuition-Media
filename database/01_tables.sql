-- Short forms:
    -- uq - unique
    -- ck -  check
    -- ST - smart tutor
    -- trg - trigger
    -- seq - sequence
    -- bi - before insert	
    -- bu - before update	
    -- bd - before delete	
    -- ai - after insert	
    -- au - after update	
    -- ad - after delete

BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_notification_bi';    EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_assignment_bi';       EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_application_bi';      EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_tuition_post_bi';     EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_location_bi';         EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_subject_bi';          EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_tutor_bi';            EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_student_bi';          EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_admin_bi';            EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TRIGGER trg_st_user_bi';             EXCEPTION WHEN OTHERS THEN NULL; END;
/


BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_NOTIFICATION CASCADE CONSTRAINTS PURGE';      EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_TUITION_ASSIGNMENT CASCADE CONSTRAINTS PURGE'; EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_APPLICATION CASCADE CONSTRAINTS PURGE';        EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_TUITION_POST CASCADE CONSTRAINTS PURGE';       EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_TUTOR CASCADE CONSTRAINTS PURGE';              EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_STUDENT CASCADE CONSTRAINTS PURGE';            EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_ADMIN CASCADE CONSTRAINTS PURGE';              EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_LOCATION CASCADE CONSTRAINTS PURGE';           EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_SUBJECT CASCADE CONSTRAINTS PURGE';            EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP TABLE ST_USER CASCADE CONSTRAINTS PURGE';               EXCEPTION WHEN OTHERS THEN NULL; END;
/


BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_notification';   EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_assignment';     EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_application';    EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_tuition_post';   EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_location';       EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_subject';        EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_tutor';          EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_student';        EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_admin';          EXCEPTION WHEN OTHERS THEN NULL; END;
/
BEGIN EXECUTE IMMEDIATE 'DROP SEQUENCE seq_st_user';           EXCEPTION WHEN OTHERS THEN NULL; END;
/


CREATE TABLE ST_USER (
    user_id       NUMBER          CONSTRAINT pk_st_user PRIMARY KEY,
    email         VARCHAR2(150)   NOT NULL,
    password_hash VARCHAR2(255)   NOT NULL,
    role          VARCHAR2(10)    NOT NULL,
    is_active     NUMBER(1)       DEFAULT 1 NOT NULL,
    created_at    TIMESTAMP       DEFAULT CURRENT_TIMESTAMP NOT NULL,
    
    CONSTRAINT uq_st_user_email   UNIQUE (email),
    CONSTRAINT ck_st_user_role    CHECK  (role IN ('admin','student','tutor')),
    CONSTRAINT ck_st_user_active  CHECK  (is_active IN (0,1))
);

CREATE SEQUENCE seq_st_user START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_user_bi
BEFORE INSERT ON ST_USER
FOR EACH ROW
BEGIN
    IF :NEW.user_id IS NULL THEN
        SELECT seq_st_user.NEXTVAL INTO :NEW.user_id FROM DUAL;
    END IF;
END;
/


CREATE TABLE ST_ADMIN (
    admin_id   NUMBER        CONSTRAINT pk_st_admin PRIMARY KEY,
    user_id    NUMBER        NOT NULL,
    full_name  VARCHAR2(100) NOT NULL,

    CONSTRAINT uq_st_admin_user UNIQUE (user_id)
);

CREATE SEQUENCE seq_st_admin START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_admin_bi
BEFORE INSERT ON ST_ADMIN
FOR EACH ROW
BEGIN
    IF :NEW.admin_id IS NULL THEN
        SELECT seq_st_admin.NEXTVAL INTO :NEW.admin_id FROM DUAL;
    END IF;
END;
/

CREATE TABLE ST_STUDENT (
    student_id  NUMBER        CONSTRAINT pk_st_student PRIMARY KEY,
    user_id     NUMBER        NOT NULL,
    full_name   VARCHAR2(100) NOT NULL,
    phone       VARCHAR2(20),
    address     VARCHAR2(255),
    created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP NOT NULL,
    
    CONSTRAINT uq_st_student_user UNIQUE (user_id)
);

CREATE SEQUENCE seq_st_student START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_student_bi
BEFORE INSERT ON ST_STUDENT
FOR EACH ROW
BEGIN
    IF :NEW.student_id IS NULL THEN
        SELECT seq_st_student.NEXTVAL INTO :NEW.student_id FROM DUAL;
    END IF;
END;
/

CREATE TABLE ST_TUTOR (
    tutor_id          NUMBER          CONSTRAINT pk_st_tutor PRIMARY KEY,
    user_id           NUMBER          NOT NULL,
    full_name         VARCHAR2(100)   NOT NULL,
    phone             VARCHAR2(20),
    university        VARCHAR2(150),
    department        VARCHAR2(100),
    cgpa              NUMBER(3,2),
    experience_years  NUMBER(2)       DEFAULT 0,
    expected_salary   NUMBER(10,2),
    preferred_areas   VARCHAR2(255),
    is_verified       NUMBER(1)       DEFAULT 0 NOT NULL,
    created_at        TIMESTAMP       DEFAULT CURRENT_TIMESTAMP NOT NULL,
    
    CONSTRAINT uq_st_tutor_user      UNIQUE (user_id),
    CONSTRAINT ck_st_tutor_cgpa      CHECK  (cgpa BETWEEN 0.00 AND 4.00),
    CONSTRAINT ck_st_tutor_verified  CHECK  (is_verified IN (0,1))
);

CREATE SEQUENCE seq_st_tutor START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_tutor_bi
BEFORE INSERT ON ST_TUTOR
FOR EACH ROW
BEGIN
    IF :NEW.tutor_id IS NULL THEN
        SELECT seq_st_tutor.NEXTVAL INTO :NEW.tutor_id FROM DUAL;
    END IF;
END;
/



CREATE TABLE ST_SUBJECT (
    subject_id    NUMBER        CONSTRAINT pk_st_subject PRIMARY KEY,
    subject_name  VARCHAR2(100) NOT NULL,
    
    CONSTRAINT uq_st_subject_name UNIQUE (subject_name)
);

CREATE SEQUENCE seq_st_subject START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_subject_bi
BEFORE INSERT ON ST_SUBJECT
FOR EACH ROW
BEGIN
    IF :NEW.subject_id IS NULL THEN
        SELECT seq_st_subject.NEXTVAL INTO :NEW.subject_id FROM DUAL;
    END IF;
END;
/



CREATE TABLE ST_LOCATION (
    location_id  NUMBER        CONSTRAINT pk_st_location PRIMARY KEY,
    area_name    VARCHAR2(100) NOT NULL,
    district     VARCHAR2(100) DEFAULT 'Dhaka' NOT NULL,
    
    CONSTRAINT uq_st_location_area UNIQUE (area_name, district)
);

CREATE SEQUENCE seq_st_location START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_location_bi
BEFORE INSERT ON ST_LOCATION
FOR EACH ROW
BEGIN
    IF :NEW.location_id IS NULL THEN
        SELECT seq_st_location.NEXTVAL INTO :NEW.location_id FROM DUAL;
    END IF;
END;
/


CREATE TABLE ST_TUITION_POST (
    post_id          NUMBER          CONSTRAINT pk_st_tuition_post PRIMARY KEY,
    student_id       NUMBER          NOT NULL,
    subject_id       NUMBER          NOT NULL,
    location_id      NUMBER          NOT NULL,
    class_level      VARCHAR2(50)    NOT NULL,
    days_per_week    NUMBER(1)       NOT NULL,
    monthly_salary   NUMBER(10,2)    NOT NULL,
    additional_info  VARCHAR2(2000),
    status           VARCHAR2(10)    DEFAULT 'open' NOT NULL,
    created_at       TIMESTAMP       DEFAULT CURRENT_TIMESTAMP NOT NULL,
    
    CONSTRAINT ck_st_post_status      CHECK (status IN ('open','assigned','closed')),
    CONSTRAINT ck_st_post_days        CHECK (days_per_week BETWEEN 1 AND 7),
    CONSTRAINT ck_st_post_salary      CHECK (monthly_salary > 0)
);

CREATE SEQUENCE seq_st_tuition_post START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_tuition_post_bi
BEFORE INSERT ON ST_TUITION_POST
FOR EACH ROW
BEGIN
    IF :NEW.post_id IS NULL THEN
        SELECT seq_st_tuition_post.NEXTVAL INTO :NEW.post_id FROM DUAL;
    END IF;
END;
/


CREATE TABLE ST_APPLICATION (
    application_id  NUMBER          CONSTRAINT pk_st_application PRIMARY KEY,
    post_id         NUMBER          NOT NULL,
    tutor_id        NUMBER          NOT NULL,
    cover_note      VARCHAR2(2000),
    status          VARCHAR2(10)    DEFAULT 'pending' NOT NULL,
    applied_at      TIMESTAMP       DEFAULT CURRENT_TIMESTAMP NOT NULL,
    
    CONSTRAINT uq_st_application      UNIQUE (post_id, tutor_id),
    CONSTRAINT ck_st_application_status CHECK (status IN ('pending','accepted','rejected'))
);

CREATE SEQUENCE seq_st_application START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_application_bi
BEFORE INSERT ON ST_APPLICATION
FOR EACH ROW
BEGIN
    IF :NEW.application_id IS NULL THEN
        SELECT seq_st_application.NEXTVAL INTO :NEW.application_id FROM DUAL;
    END IF;
END;
/


CREATE TABLE ST_TUITION_ASSIGNMENT (
    assignment_id   NUMBER        CONSTRAINT pk_st_assignment PRIMARY KEY,
    application_id  NUMBER        NOT NULL,
    post_id         NUMBER        NOT NULL,
    tutor_id        NUMBER        NOT NULL,
    student_id      NUMBER        NOT NULL,
    start_date      DATE          DEFAULT SYSDATE NOT NULL,
    status          VARCHAR2(15)  DEFAULT 'active' NOT NULL,
    created_at      TIMESTAMP     DEFAULT CURRENT_TIMESTAMP NOT NULL,
    
    CONSTRAINT uq_st_assignment_app   UNIQUE (application_id),
    CONSTRAINT ck_st_assignment_status CHECK (status IN ('active','completed','cancelled'))
);

CREATE SEQUENCE seq_st_assignment START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_assignment_bi
BEFORE INSERT ON ST_TUITION_ASSIGNMENT
FOR EACH ROW
BEGIN
    IF :NEW.assignment_id IS NULL THEN
        SELECT seq_st_assignment.NEXTVAL INTO :NEW.assignment_id FROM DUAL;
    END IF;
END;
/

CREATE TABLE ST_NOTIFICATION (
    notification_id  NUMBER         CONSTRAINT pk_st_notification PRIMARY KEY,
    user_id          NUMBER         NOT NULL,
    title            VARCHAR2(200)  NOT NULL,
    message          VARCHAR2(2000) NOT NULL,
    is_read          NUMBER(1)      DEFAULT 0 NOT NULL,
    created_at       TIMESTAMP      DEFAULT CURRENT_TIMESTAMP NOT NULL,
    
    CONSTRAINT ck_st_notification_read CHECK (is_read IN (0,1))
);

CREATE SEQUENCE seq_st_notification START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;

CREATE OR REPLACE TRIGGER trg_st_notification_bi
BEFORE INSERT ON ST_NOTIFICATION
FOR EACH ROW
BEGIN
    IF :NEW.notification_id IS NULL THEN
        SELECT seq_st_notification.NEXTVAL INTO :NEW.notification_id FROM DUAL;
    END IF;
END;
/

COMMIT;


SELECT table_name, num_rows
FROM   user_tables
WHERE  table_name LIKE 'ST_%'
ORDER  BY table_name;
