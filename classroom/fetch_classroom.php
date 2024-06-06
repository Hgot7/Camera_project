<?php
require_once '../class/department.php';
require_once '../class/classroom.php';
$department = new Department($conn);
$classroom = new Classroom($conn);

if (isset($_POST['department_id'])) {
    $department_id = $_POST['department_id'];
    if ($department_id == '0') {
        // Handle the case where $department_id is empty (null or "")
        $output = '<table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
          <thead class="table-thead">
            <tr>
              <th scope="col" class="text-center">Select a department first</th>
            </tr>
          </thead>
          <tbody>';
        echo $output;
    } else {
        $classroom_details = $classroom->getClassroomsByDepartment($department_id);
        if (!empty($classroom_details)) {
            $output = '<table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
            <thead class="table-thead">
                <tr>
                    <th scope="col">ระดับชั้นปี</th>
                    <th scope="col">ชื่อห้อง</th>
                    <th scope="col">LINE TOKEN</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($classroom_details as $detail) {
                $output .= '<tr class="table1-active">
                        <td scope="row">' . htmlspecialchars($detail['level']) . '. - ' .  htmlspecialchars($detail['sub_level']) . '</td>
                        <td>' . htmlspecialchars($detail['class']) . '</td>
                        <td>' . htmlspecialchars(substr($detail['line_token'], 0, 5)) . '</td>

                        <td>
                            <a class="btn btn-sm btn-warning" href="../classroom/edit_classroom.php?id=' . $detail['classroom_id'] . '">แก้ไข</a>
                            <a onclick="return confirm(\'Are you sure you want to delete?\');" class="btn btn-sm btn-danger" href="../classroom/delete_classroom.php?id=' . $detail['classroom_id'] . '">ลบ</a>                        </td>
                    </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            $output = '<table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
            <thead class="table-thead">
            <tr>
            <th scope="col" class="text-center">No data classroom in this department</th>
        </tr>
            </thead>
            <tbody>';
            echo $output;
        }
    }
}
