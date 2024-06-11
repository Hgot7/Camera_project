<?php
require_once '../class/room.php';

$room = new Room($conn);

if (isset($_POST['building_id'])) {
    $building_id = $_POST['building_id'];
    $rooms = $room->getRoomsWithBuilding($building_id);

    if ($building_id == '0') {
        echo '<option value="null">โปรดเลือกอาคารก่อน</option>';
    } elseif ($rooms) {
        foreach ($rooms as $room) {
            echo '<option value="' . htmlspecialchars($room['room_id']) . '">' . htmlspecialchars($room['room_name']) . ' - ' . htmlspecialchars($room['room_number']) . '</option>';
        }
    } else {
        echo '<option value="null">ไม่มีห้องเรียนในอาคารนี้</option>';
    }
}
