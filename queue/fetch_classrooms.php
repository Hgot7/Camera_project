<?php

require_once '../class/classroom.php';
$classroom = new Classroom($conn);

if (isset($_POST['department_id'])) {
    if ($_POST['department_id'] == '0') {
        echo "<option value='0' selected>เลือกแผนกก่อน</option>";
    } else {
        $department_id = $_POST['department_id'];

        $classrooms = $classroom->getClassroomsByDepartment($department_id);

        if ($classrooms) {
            foreach ($classrooms as $classroom) {
                echo "<option value='" . $classroom['classroom_id'] . "'>" . htmlspecialchars($classroom['class']) . "</option>";
            }
        } else {
            echo "<option value='0' selected>ไม่มีชั้นเรียนในแผนกนี้</option>";
        }
    }
}
