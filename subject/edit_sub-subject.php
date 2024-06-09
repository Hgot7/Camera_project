<?php
session_start();

require_once '../class/department.php';
// create instance
$department = new Department($conn);

if (isset($_POST['editSub-subject'])) {
    $sub_subject_id = $_POST['sub_subjectid'];
    $sub_subject_name = $_POST['sub_subjectname'];

    if ($department->updateSubSubject($sub_subject_id, $sub_subject_name)) {
        $_SESSION['success'] = "Subject " . $sub_subject_name . " update successfully";
        header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
        exit;
    } else {
        $_SESSION['error'] = "Failed to update subject.";
        header('Location: ./subjectmanage.php?id=' . $_SESSION['subject_id']);
        exit;
    }
}
