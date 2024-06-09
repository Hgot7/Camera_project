<?php
session_start();
require_once '../class/Department.php'; // Ensure the correct path to the Department class

$department = new Department($conn); // Create the Department object

if (isset($_POST['addSub-subject'])) {
    $subject_id = $_POST['subject_id'];
    $sub_subject_name = $_POST['sub_subjectname'];

    if ($department->addSubSubject($subject_id, $sub_subject_name)) {
        $_SESSION['success'] = "Sub-subject " . $sub_subject_name . " added successfully!";
        header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
        exit;
    } else {
        $_SESSION['error'] = "Failed to add sub-subject.";
        header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
        exit;
    }
}
