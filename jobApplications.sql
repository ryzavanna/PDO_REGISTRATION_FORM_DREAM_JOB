CREATE DATABASE IF NOT EXISTS dba_job_application;
USE dba_job_application;

CREATE TABLE IF NOT EXISTS dba_applications (
    applicant_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    primary_db_engine VARCHAR(50) NOT NULL,
    years_of_experience INT NOT NULL,
    certifications VARCHAR(255) DEFAULT 'None',
    date_applied TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);