<?php
session_start();
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
