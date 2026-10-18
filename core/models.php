<?php
require_once __DIR__ . '/dbConfig.php';

// Create: Insert new job application
function insertApplication($pdo, $first_name, $last_name, $email, $primary_db_engine, $years_of_experience, $certifications) {
    $sql = "INSERT INTO dba_applications (first_name, last_name, email, primary_db_engine, years_of_experience, certifications) 
            VALUES (:first_name, :last_name, :email, :primary_db_engine, :years_of_experience, :certifications)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':email' => $email,
        ':primary_db_engine' => $primary_db_engine,
        ':years_of_experience' => $years_of_experience,
        ':certifications' => $certifications
    ]);
}

// Read All: Fetch all applications
function getAllApplications($pdo) {
    $sql = "SELECT * FROM dba_applications ORDER BY date_applied DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Read One: Fetch single application by ID
function getApplicationByID($pdo, $applicant_id) {
    $sql = "SELECT * FROM dba_applications WHERE applicant_id = :applicant_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':applicant_id' => $applicant_id]);
    return $stmt->fetch();
}

// Update: Edit existing record
function updateApplication($pdo, $applicant_id, $first_name, $last_name, $email, $primary_db_engine, $years_of_experience, $certifications) {
    $sql = "UPDATE dba_applications 
            SET first_name = :first_name, 
                last_name = :last_name, 
                email = :email, 
                primary_db_engine = :primary_db_engine, 
                years_of_experience = :years_of_experience, 
                certifications = :certifications 
            WHERE applicant_id = :applicant_id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':email' => $email,
        ':primary_db_engine' => $primary_db_engine,
        ':years_of_experience' => $years_of_experience,
        ':certifications' => $certifications,
        ':applicant_id' => $applicant_id
    ]);
}

// Delete: Remove record by ID
function deleteApplication($pdo, $applicant_id) {
    $sql = "DELETE FROM dba_applications WHERE applicant_id = :applicant_id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':applicant_id' => $applicant_id]);
}
?>