<?php
session_start();

require_once '../class/department.php';
$department = new department($conn);

if (isset($_POST['addDepartment'])) {
    $department_name = $_POST['department_name'];

    if ($department->addDepartment($department_name)) {
        $_SESSION['success'] = "Successfully added department : " . $department_name;
        header('Location: ./departmentmanage.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to add department";
    }
}
