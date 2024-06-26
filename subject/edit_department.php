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
// Create instance
$department = new Department($conn);

if (isset($_POST['editDepartment'])) {
    $department_id = $_POST['department_id'];
    $department_name = $_POST['department_name'];

    if ($department->updateDepartment($department_id, $department_name)) {
        $_SESSION['success'] = "Successfully updated department : " . $department_name;
        header('Location: ./departmentmanage.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to update department";
    }
}
