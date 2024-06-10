<?php

require_once '../class/Department.php';

$department = new Department($conn);

if (isset($_POST['department_id'])) {
    $department_id = $_POST['department_id'];
    $subjects = $department->getSubjectsByDepartmentId($department_id);

    if (!empty($subjects)) {
        echo '<option value="null" selected>เลือกหมวดวิชา</option>';
        foreach ($subjects as $subject) {
            echo '<option value="' . htmlspecialchars($subject['subject_id']) . '">' . htmlspecialchars($subject['subject_name']) . '</option>';
        }
    } else {
        echo '<option value="null" selected>ไม่มีหมวดวิชา</option>';
    }
} else {
    echo '<option value="null" selected>เลือกแผนกก่อน</option>';
}
