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
include_once('../class/camera.php');

$camera = new Camera($conn);

if (isset($_GET['id'])) {
    $camera_id = $_GET['id'];

    try {
        if ($camera->deleteCamera($camera_id)) {
            $_SESSION['success'] = "Success to delete camera";
        } else {
            $_SESSION['error'] = "Failed to delete camera";
        }
        header('Location: ../camera.php');
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Integrity constraint violation
            $_SESSION['error'] = "Cannot delete this camera because it is being used in a queue setup. Please remove those references first.";
        } else {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
        header('Location: ../camera.php');
        exit;
    }
}
