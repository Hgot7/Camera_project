<?php
session_start();
require_once '../connect.php';
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
