<?php
session_start();
require_once '../class/building.php';
$building = new Building($conn);

if (isset($_POST['editbuilding'])) {
    if (isset($_POST['building_id']) && isset($_POST['building_fullname']) && isset($_POST['building_name'])) {
        $building_id = $_POST['building_id'];
        $building_fullname = htmlspecialchars($_POST['building_fullname']);
        $building_name = htmlspecialchars($_POST['building_name']);

        if ($building->updateBuilding($building_id, $building_fullname, $building_name)) {
            $_SESSION['success'] = "Building name " . $building_fullname . " updated successfully!";
            header('location: buildingmanage.php');
            exit;
        } else {
            $_SESSION['error'] = "Failed to update building";
            header('location: buildingmanage.php');
            exit;
        }
    } else {
        $_SESSION['error'] = "Missing required building information ".$building_fullname."";
        header('location: buildingmanage.php');
        exit;
    }
}
