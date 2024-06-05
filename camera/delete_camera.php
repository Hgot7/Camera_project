<?php
session_start();
include_once('../class/camera.php');

$camera = new Camera($conn);

if (isset($_GET['id'])) {
    $camera_id = $_GET['id'];

    if ($camera->deleteCamera($camera_id)) {
        $_SESSION['success'] = "Success to delete camera";
        header('Location: ../camera.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to delete camera";
    }
}
