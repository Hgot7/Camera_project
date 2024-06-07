<?php
session_start();

require_once '../class/department.php';
// create instance
$department = new Department($conn);

if (isset($_GET['id'])) {
    $subject_id = $_GET['id'];
    $subject = $department->getSubjecBySujectId($subject_id);

    if ($department->deleteSubject($subject_id)) {
        $_SESSION['success'] = "Subject " . $subject['subject_name'] . " deleted successfully";
        header('Location: ../subject.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to delete subject.";
        header('Location: ../subject.php');
        exit;
    }
}
