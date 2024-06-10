<?php
session_start();
require_once '../class/classroom.php';
require_once '../class/department.php';

// Create instance of Classroom class
$classroom = new Classroom($conn);
$department = new Department($conn);

// Get department 
$departments = $department->getDepartments();
// Assume classroom_id is received from a form or URL parameter
$classroom_id = $_GET['id']; // หรือใช้ GET แล้วแต่สถานการณ์

if ($classroom->deleteClassroom($classroom_id)) {
    $_SESSION['success'] = "Classroom deleted successfully!";
    header('Location: ../classroom.php');
    exit;
} else {
    $_SESSION['error'] = "Failed to delete classroom.";
    header('Location: ../classroom.php');
    exit;
}
