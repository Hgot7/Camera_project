<?php
require_once '../class/camera.php';

// ตรวจสอบว่ามีการส่งค่า camera_id หรือไม่
if (isset($_GET['id'])) {
    $camera_id = $_GET['id'];

    // สร้างอินสแตนซ์ของคลาส Camera
    $camera = new Camera($conn);

    // เรียกใช้เมธอด updateStatusCamera
    if ($camera->updateStatusCamera($camera_id)) {
        // ถ้าการอัปเดตสำเร็จ
        $_SESSION['success'] = "camera status update completed successfully";
    } else {
        // ถ้าการอัปเดตล้มเหลว
        $_SESSION['error'] = "camera status update failed";
    }
    header('location: ../camera.php');
    exit;
} else {
    // ถ้าไม่มีการส่งค่า camera_id มา
    $_SESSION['error'] = "Not found camera_id";
    header('location: ../camera.php');
    exit;
}
