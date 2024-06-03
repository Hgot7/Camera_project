<?php
session_start();

include_once('../class/building.php');
$building = new Building($conn);
// parametor
$building_id = $_GET['id'];

if ($building->deleteBuilding($building_id)) {
    $_SESSION['success'] = "Building deleted successfully!";
    header('location: buildingmanage.php');
    exit;
} else {
    $_SESSION['error'] = "Failed to deleted building";
}
