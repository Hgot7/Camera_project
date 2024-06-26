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
require_once '../class/Department.php'; // Ensure the correct path to the Department class

$department = new Department($conn); // Create the Department object

if (isset($_POST['addSub-subject'])) {
    $subject_id = $_POST['subject_id'];
    $sub_subject_name = $_POST['sub_subjectname'];

    if ($department->addSubSubject($subject_id, $sub_subject_name)) {
        $_SESSION['success'] = "Sub-subject " . $sub_subject_name . " added successfully!";
        header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
        exit;
    } else {
        $_SESSION['error'] = "Failed to add sub-subject.";
        header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
        exit;
    }
}
