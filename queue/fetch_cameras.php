<?php
require_once '../class/camera.php';

$camera = new Camera($conn);

if (isset($_POST['building_id']) && isset($_POST['room_id'])) {
    $building_id = $_POST['building_id'];
    $room_id = $_POST['room_id'];

    $cameras = $camera->getCamerasByBuildingAndRoom($building_id, $room_id);

    if ($cameras) {
        foreach ($cameras as $camera) {
            echo "<option value='" . htmlspecialchars($camera['camera_id']) . "'>" . htmlspecialchars($camera['camera_name']) . "</option>";
        }
    } else {
        echo "<option value='null' selected>ไม่มีกล้องในห้องนี้</option>";
    }
}
