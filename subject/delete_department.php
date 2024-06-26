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

try {
    if (isset($_GET['id'])) {
        $department_id = $_GET['id'];
        if ($department->deleteDepartment($department_id)) {
            $_SESSION['success'] = "Successfully deleted department";
        } else {
            $_SESSION['error'] = "Failed to delete department";
        }
        header('Location: ./departmentmanage.php');
        exit;
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Integrity constraint violation
        $_SESSION['error'] = "Cannot delete this department because it is being used in other records. Please remove those references first.";
    } else {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
    header('Location: ./departmentmanage.php');
    exit;
}
