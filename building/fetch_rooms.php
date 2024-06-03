<?php
require_once '../class/room.php';
$room = new Room($conn);

if (isset($_POST['building_id'])) {
    $building_id = $_POST['building_id'];

    $rooms = $room->getRoomsWithBuilding($building_id);
    echo json_encode($rooms);
}


