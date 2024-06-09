<?php
session_start();
require_once '../class/department.php';

$department = new Department($conn);

if (isset($_GET['id'])) {
    $sub_subject_id = $_GET['id']; // หรือใช้ GET แล้วแต่สถานการณ์

    $sub_subject = $department->getSubSubjectBySubSubjectId($sub_subject_id);
    if ($department->deleteSubSubject($sub_subject_id)) {
        $_SESSION['success'] = "Sub-subject " . $sub_subject['sub_subject_name'] . " deleted successfully!";
        header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
        exit;
    } else {
        $_SESSION['error'] = "Failed to delete sub-subject " . $sub_subject['sub_subject_name'];
        header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
        exit;
    }
}
