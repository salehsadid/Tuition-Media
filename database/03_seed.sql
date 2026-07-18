-- ============================================================
--  SmartTutor Database Schema
--  File       : 03_seed.sql
--  Database   : Oracle 11g XE
--  Description: Inserts realistic sample data for development
-- ============================================================

INSERT INTO ST_SUBJECT (subject_name) VALUES ('Mathematics');
INSERT INTO ST_SUBJECT (subject_name) VALUES ('Physics');
INSERT INTO ST_SUBJECT (subject_name) VALUES ('English');

INSERT INTO ST_LOCATION (area_name, district) VALUES ('Dhanmondi', 'Dhaka');
INSERT INTO ST_LOCATION (area_name, district) VALUES ('Mirpur', 'Dhaka');

-- Users (Password: Test@1234)
INSERT INTO ST_USER (email, password_hash, role, is_active) VALUES ('admin@smarttutor.com', '$2y$10$xzFoDbwex2Wvdwj1/1oHi.hG8.iFCDOgE.5JVnvIjgfMfUOp8qFN2', 'admin', 1);
INSERT INTO ST_USER (email, password_hash, role, is_active) VALUES ('john@student.com', '$2y$10$xzFoDbwex2Wvdwj1/1oHi.hG8.iFCDOgE.5JVnvIjgfMfUOp8qFN2', 'student', 1);
INSERT INTO ST_USER (email, password_hash, role, is_active) VALUES ('kamrul@tutor.com', '$2y$10$xzFoDbwex2Wvdwj1/1oHi.hG8.iFCDOgE.5JVnvIjgfMfUOp8qFN2', 'tutor', 1);
INSERT INTO ST_USER (email, password_hash, role, is_active) VALUES ('farhan@tutor.com', '$2y$10$xzFoDbwex2Wvdwj1/1oHi.hG8.iFCDOgE.5JVnvIjgfMfUOp8qFN2', 'tutor', 1);

INSERT INTO ST_ADMIN (user_id, full_name) VALUES (1, 'System Admin');
INSERT INTO ST_STUDENT (user_id, full_name, phone) VALUES (2, 'Saleh Sadid Mir', '01711111111');
INSERT INTO ST_TUTOR (user_id, full_name, phone, expected_salary) VALUES (3, 'Kamrul Islam', '01811111111', 5000);
INSERT INTO ST_TUTOR (user_id, full_name, phone, expected_salary) VALUES (4, 'Farhan Ahmed', '01911111111', 8000);

-- Posts
INSERT INTO ST_TUITION_POST (student_id, subject_id, location_id, class_level, days_per_week, monthly_salary, status) 
VALUES (1, 1, 1, 'Class 10', 3, 5000, 'open');

INSERT INTO ST_TUITION_POST (student_id, subject_id, location_id, class_level, days_per_week, monthly_salary, status, hired_tutor_id) 
VALUES (1, 2, 2, 'HSC', 4, 8000, 'assigned', 2);

-- Applications
INSERT INTO ST_APPLICATION (post_id, tutor_id, cover_note, status) VALUES (1, 1, 'I can teach math.', 'pending');
INSERT INTO ST_APPLICATION (post_id, tutor_id, cover_note, status) VALUES (2, 2, 'Physics expert.', 'accepted');

COMMIT;
