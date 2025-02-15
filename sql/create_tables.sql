CREATE DATABASE IF NOT EXISTS internship_portal;

USE internship_portal;

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(255),
  email VARCHAR(255),
  mobile VARCHAR(15),
  qualification VARCHAR(50),
  graduation_year INT,
  about TEXT,
  certifications TEXT,
  projects TEXT,
  skills TEXT,
  software TEXT,
  experience INT,
  soft_skills TEXT,
  resume_path VARCHAR(255),
  quiz_score INT DEFAULT 0
);

CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question_text TEXT,
  options TEXT
);