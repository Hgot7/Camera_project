
<?php
require_once '../class/department.php';
$department = new Department($conn);
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
    $subject_details = $department->getSubjectsByDepartmentId($department_id);
    if (!empty($subject_details)) {
      $output = '<table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
            <thead class="table-thead">
                 <tr>
                   <th scope="col">ชื่อหมวดวิชา</th>
                   <th scope="col">Action</th>
                 </tr>
            </thead>
            <tbody>';
      foreach ($subject_details as $detail) {
        $output .= '<tr class="table1-active">
                <td scope="row">' . htmlspecialchars($detail['subject_name']) . '</td>
                <td>
                    <a href="./subject/subjectmanage.php?id=' . $detail['subject_id'] . '" class="btn btn-primary">จัดการวิชา</a>
                    <a href="./subject/edit_subject.php?id=' . $detail['subject_id'] . '" class="btn btn-warning">แก้ไข</a>                  
                    <a onclick="return confirm(\'Are you sure you want to delete?\');" class="btn btn-sm btn-danger" href="../subject/delete_subject.php?id=' . $detail['subject_id'] . '">ลบ</a>
                </td>
            </tr>';
      }
      $output .= '</tbody></table>';
      echo $output;
    } else {
      $output = '<table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
            <thead class="table-thead">
            <tr>
            <th scope="col" class="text-center">No data subject in this department</th>
        </tr>
            </thead>';
      echo $output;
    }
  }
}
