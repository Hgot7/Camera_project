<?php

require_once '../class/Department.php';

$department = new Department($conn);

if (isset($_POST['subject_id'])) {
    $subject_id = $_POST['subject_id'];
    $subSubjects = $department->getSubSubjectsBySubjectId($subject_id);

    if (!empty($subSubjects)) {
        echo '<option value="null" selected>เลือกวิชา</option>';
        foreach ($subSubjects as $subSubject) {
            echo '<option value="' . htmlspecialchars($subSubject['sub_subject_id']) . '">' . htmlspecialchars($subSubject['sub_subject_name']) . '</option>';
        }
    } else {
        echo '<option value="null" selected>ไม่มีวิชา</option>';
    }
} else {
    echo '<option value="null" selected>เลือกหมวดวิชาก่อน</option>';
}
?>
