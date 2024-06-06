<?php
session_start();
require_once '../connect.php';
require_once '../class/department.php';

// Create instance
$department = new Department($conn);

if (isset($_GET['id'])) {
    $department_id = $_GET['id'];

    if ($department->deleteDepartment($department_id)) {
        $_SESSION['success'] = "Successfully deleted department";
        header('Location: ./departmentmanage.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to delete department";
    }
}
