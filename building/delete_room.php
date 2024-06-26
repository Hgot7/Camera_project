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
include_once('../class/room.php');
$room = new Room($conn);
// parametor
$rooms_id = $_GET['id'];

try {
    if ($room->deleteRoom($rooms_id)) {
        $_SESSION['success'] = "room deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to deleted room";
    }
    header('location: ../building.php');
    exit;
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Integrity constraint violation
        $_SESSION['error'] = "Cannot delete this room because it is being used in other records. Please remove those references first.";
    } else {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
    header('location: ../building.php');
    exit;
}
