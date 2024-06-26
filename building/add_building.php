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
require_once '../class/building.php';
$building = new Building($conn);

if (isset($_POST['addbuilding'])) {
    $building_name = $_POST['building_name'];
    $building_fullname = $_POST['building_fullname'];

    if ($building->addBuilding($building_name, $building_fullname)) {
        $_SESSION['success'] = "Success to add building ".$building_fullname;
        header('location: ./buildingmanage.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to add building";
    }
}
