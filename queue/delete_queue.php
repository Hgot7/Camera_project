<?php
session_start();
include_once('../class/user.php');
$user = new User($conn);
if (!isset($_SESSION['admin_login'])) {
    // Check remember me token
    if (!$user->checkRememberMe()) {
        header('Location: ../index.php');
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        exit;
    }
}
require_once '../class/queueSetup.php';

// Create instance
$queue_setup = new QueueSetup($conn);

if (isset($_GET['id'])) {
    $queue_id = $_GET['id'];

    if ($queue_setup->deleteQueueSetup($queue_id)) {
        $_SESSION['success'] = "Successfully deleted queue";
        header('Location: ../queue.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to delete queue";
        header('Location: ../queue.php');
        exit;
    }
}
