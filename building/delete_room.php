<?php
session_start();

include_once('../class/room.php');
$room = new Room($conn);
// parametor
$rooms_id = $_GET['id'];

if ($room->deleteRoom($rooms_id)) {
    $_SESSION['success'] = "room deleted successfully!";
    header('location: ../building.php');
    exit;
} else {
    $_SESSION['error'] = "Failed to deleted room";
}
