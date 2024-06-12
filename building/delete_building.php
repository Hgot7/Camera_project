<?php
session_start();

include_once('../class/building.php');
$building = new Building($conn);
// parametor
$building_id = $_GET['id'];

try {
    if ($building->deleteBuilding($building_id)) {
        $_SESSION['success'] = "Building deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to deleted building";
    }
    header('location: buildingmanage.php');
    exit;
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Integrity constraint violation
        $_SESSION['error'] = "Cannot delete this building because it is being used by other records. Please remove those references first.";
    } else {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
    header('location: buildingmanage.php');
    exit;
}
