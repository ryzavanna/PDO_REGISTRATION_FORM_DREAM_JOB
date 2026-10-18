<?php
require_once __DIR__ . '/models.php';

// Handle Insert Request
if (isset($_POST['insertBtn'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $primary_db_engine = trim($_POST['primary_db_engine']);
    $years_of_experience = trim($_POST['years_of_experience']);
    $certifications = trim($_POST['certifications']);

    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($primary_db_engine)) {
        if (insertApplication($pdo, $first_name, $last_name, $email, $primary_db_engine, $years_of_experience, $certifications)) {
            header("Location: ../index.php?status=success");
            exit();
        }
    }
    header("Location: ../index.php?status=failed");
    exit();
}

// Handle Update Request
if (isset($_POST['updateBtn'])) {
    $applicant_id = $_POST['applicant_id'];
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $primary_db_engine = trim($_POST['primary_db_engine']);
    $years_of_experience = trim($_POST['years_of_experience']);
    $certifications = trim($_POST['certifications']);

    if (updateApplication($pdo, $applicant_id, $first_name, $last_name, $email, $primary_db_engine, $years_of_experience, $certifications)) {
        header("Location: ../index.php?status=updated");
        exit();
    } else {
        header("Location: ../index.php?status=failed");
        exit();
    }
}

// Handle Delete Request
if (isset($_POST['deleteBtn'])) {
    $applicant_id = $_POST['applicant_id'];
    if (deleteApplication($pdo, $applicant_id)) {
        header("Location: ../index.php?status=deleted");
        exit();
    } else {
        header("Location: ../index.php?status=failed");
        exit();
    }
}
?>