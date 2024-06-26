<?php
session_start();
include_once('../class/user.php');
$user = new User($conn);
if (!isset($_SESSION['admin_login'])) {
    // Check remember me token
    if (!$user->checkRememberMe()) {
        header('Location: ../index.php');
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        exit;
    }
}
require_once '../class/department.php';
// create instance
$department = new Department($conn);

try {
    if (isset($_GET['id'])) {
        $subject_id = $_GET['id'];
        $subject = $department->getSubjecBySujectId($subject_id);

        if ($department->deleteSubject($subject_id)) {
            $_SESSION['success'] = "Subject " . $subject['subject_name'] . " deleted successfully";
        } else {
            $_SESSION['error'] = "Failed to delete subject.";
        }
        header('Location: ../subject.php');
        exit;
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Integrity constraint violation
        $_SESSION['error'] = "Cannot delete this subject because it is being used in other records. Please remove those references first.";
    } else {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
    header('Location: ../subject.php');
    exit;
}
