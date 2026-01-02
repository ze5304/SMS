DROP DATABASE IF EXISTS schoolproject;
CREATE DATABASE schoolproject;
USE schoolproject;

-- =========================
-- 1. USERS (LOGIN SYSTEM)
-- =========================
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    usertype ENUM('admin','student','teacher') NOT NULL
);

-- =========================
-- 2. STUDENTS (PROFILE)
-- id == user.id (student)
-- =========================
CREATE TABLE students (
    id INT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(20),
    password VARCHAR(255),
    CONSTRAINT fk_student_user
        FOREIGN KEY (id) REFERENCES user(id)
        ON DELETE CASCADE
);

-- =========================
-- 3. TEACHERS
-- =========================
CREATE TABLE teacher (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    description TEXT,
    image VARCHAR(100)
);

-- =========================
-- 4. COURSES
-- =========================
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    description TEXT,
    image VARCHAR(100)
);

-- =========================
-- 5. RESULTS
-- student_id → students.id
-- course_id  → courses.id
-- =========================
CREATE TABLE result (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    course_id INT,
    mark VARCHAR(20),
    CONSTRAINT fk_result_student
        FOREIGN KEY (student_id) REFERENCES students(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_result_course
        FOREIGN KEY (course_id) REFERENCES courses(id)
        ON DELETE CASCADE
);

-- =========================
-- 6. ADMISSION
-- =========================
CREATE TABLE admission (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(20),
    message TEXT
);


-- SAMPLE DATA
-- =========================

-- users
INSERT INTO user (username,password,usertype) VALUES
('admin','1234','admin'),
('student1','1234','student'),
('teacher1','1234','teacher');

-- students (id must match user.id)
INSERT INTO students (id,username,email,phone,password) VALUES
(2,'student1','student1@gmail.com','0919349370','1234');

-- teachers
INSERT INTO teacher (name,description,image) VALUES
('Mr Alemu','Math teacher','image/alemu.jpg');

-- courses
INSERT INTO courses (name,description,image) VALUES
('Math','Basic Mathematics','image/math.jpg');

-- results
INSERT INTO result (student_id,course_id,mark) VALUES
(2,1,'95');
