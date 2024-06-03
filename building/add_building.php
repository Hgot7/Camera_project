<?php
session_start();

require_once '../class/building.php';
$building = new Building($conn);

if (isset($_POST['addbuilding'])) {
    $building_name = $_POST['building_name'];
    $building_fullname = $_POST['building_fullname'];

    if ($building->addBuilding($building_name, $building_fullname)) {
        $_SESSION['success'] = "Success to add building";
        header('location: ./buildingmanage.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to add building";
    }
}
