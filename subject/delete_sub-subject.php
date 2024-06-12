<?php
session_start();
require_once '../class/department.php';

$department = new Department($conn);

try {
    if (isset($_GET['id'])) {
        $sub_subject_id = $_GET['id']; // หรือใช้ GET แล้วแต่สถานการณ์

        $sub_subject = $department->getSubSubjectBySubSubjectId($sub_subject_id);
        if ($department->deleteSubSubject($sub_subject_id)) {
            $_SESSION['success'] = "Sub-subject " . $sub_subject['sub_subject_name'] . " deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete sub-subject " . $sub_subject['sub_subject_name'];
        }
        header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
        exit;
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Integrity constraint violation
        $_SESSION['error'] = "Cannot delete this sub-subject because it is being used in other records. Please remove those references first.";
    } else {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
    header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
    exit;
}
