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
require_once '../class/classroom.php';
require_once '../class/department.php';

// Create instance of Classroom class
$classroom = new Classroom($conn);
$department = new Department($conn);

// Get department 
$departments = $department->getDepartments();
// Assume classroom_id is received from a form or URL parameter
$classroom_id = $_GET['id']; // หรือใช้ GET แล้วแต่สถานการณ์

try {
    if ($classroom->deleteClassroom($classroom_id)) {
        $_SESSION['success'] = "Classroom deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete classroom.";
    }
    header('Location: ../classroom.php');
    exit;
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Integrity constraint violation
        $_SESSION['error'] = "Cannot delete this classroom because it is being used in other records queue_setup. Please remove those references first.";
    } else {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
    header('Location: ../classroom.php');
    exit;
}
