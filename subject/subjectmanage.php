<?php
session_start();
require_once '../class/department.php';

// Create instance
$department = new Department($conn);
// Get department 
$departments = $department->getDepartments();

if (isset($_GET['id'])) {
    $subject_id = $_GET['id'];
    $_SESSION['subject_id'] = $subject_id;
    $sub_subjects = $department->getSubSubjects($subject_id);
    $showResult = $department->getDepartmentAndSubject($subject_id);
}

if (isset($_POST['editClassroom'])) {
    $subject_id = $_POST['subject_id'];   // Assuming subject_id is also sent in the form
    $department_id = $_POST['department_id'];
    $OldDepartment_id = $_POST['OldDepartment_id'];
    $level = $_POST['level'];
    $sublevel = $_POST['sublevel'];
    $class = $_POST['class'];
    $building_id = $_POST['building_id'];
    $room_id = $_POST['room_id'];
    $line_token = $_POST['line_token'];

    if ($classroom->updateClassroom($subject_id, $department_id, $level, $sublevel, $class, $building_id, $room_id, $line_token)) {

        if ($OldDepartment_id != $department_id) {
            foreach ($departments as $department) {
                if ($department['department_id'] == $department_id) {
                    $_SESSION['success'] = "Classroom " . $class . " moved to new department " . htmlspecialchars($department['department_name']);
                    break;
                }
            }
        } else {
            $_SESSION['success'] = "Classroom " . $class . "updated successfully!";
        }
        header('location: ../classroom.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to update Classroom";
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <!-- นำเข้าไฟล์ CSS ของ Bootstrap Icons ผ่าน CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/cameradark.png" type="png">
    <title>RIETC</title>
    <script src="../jquery.js"></script>
    <script src="../script.js"></script>
</head>

<body>
    <?php include_once("../assets/components/header.php"); ?>
    <?php include_once("../assets/components/sidebar.php"); ?>
    <?php include_once("../assets/components/sidebarResponsive.php"); ?>

    <div class="overlay"></div>
    <!-- Spinner Start -->
    <div id="spinner" class="show spinner-container">
        <div class="spinner-border text-danger" role="status"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <!-- <h1>Subject</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../subject.php">Subject</a></li>
                        <li class="breadcrumb-item active" aria-current="page">จัดการวิชาในหมวดวิชา</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?></div>
        <?php  } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?></div>
        <?php  } ?>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <div class="col mb-0">
                            <p style="align-content: center;margin: 0px 0px 0px 0px;">จัดการวิชาในหมวดวิชา : <?php echo $showResult['subject_name']; ?></p>
                            <div class="form-floating" style="display:flex;flex-direction:row;margin-top:10px">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSub_subjectsModal" style="margin-right: 1px !important;">
                                    เพิ่มวิชาในหมวดวิชา
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addSub_subjectsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSub_subjectsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title" id="addSub_subjectsModalLabel">เพิ่มวิชาในหมวดวิชา</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="subject" class="form-label" style="font-weight:normal;">ตั้งชื่อวิชา</label>
                                                <form action="./add_sub-subject.php" method="post">
                                                    <div class="input-group">
                                                        <input type="hidden" class="form-control" id="subject_id" name="subject_id" value="<?php echo $_SESSION['subject_id']; ?>">
                                                        <input type="text" class="form-control" placeholder="ใส่ชื่อวิชา" name="sub_subjectname" autocomplete="off" required="">
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="addSub-subject" class="btn btn-primary" style="margin-right: 5px;">บันทึก</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card1-body">
                        <div class="table-responsive">
                            <table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                <thead class="table-thead">
                                    <?php if (empty($sub_subjects)) : ?>
                                        <tr>
                                            <th scope="col" class="text-center">No sub-subjects in this subject</th>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <th scope="col">ชื่อวิชา</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    <?php endif; ?>
                                </thead>
                                <tbody>
                                    <?php foreach ($sub_subjects as $sub_subject) : ?>
                                        <tr class="table1-active">
                                            <td scope="row"><?php echo htmlspecialchars($sub_subject['sub_subject_name']) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editSub_subjectModal<?php echo $sub_subject['sub_subject_id']; ?>" style="margin-right: 1px !important;">
                                                    ตั้งค่า
                                                </button>
                                                <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?');" href="./delete_sub-subject.php?id=<?php echo $sub_subject['sub_subject_id']; ?>">ลบ</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        </form>
                    </div>
                    <?php foreach ($sub_subjects as $sub_subject) : ?>
                        <!-- Modal -->
                        <div class="modal fade" id="editSub_subjectModal<?php echo $sub_subject['sub_subject_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSub_subjectModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p class="modal-title" id="editSub_subjectModalLabel">แก้ไขข้อมูลวิชา</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="./edit_sub-subject.php" method="post" style="display: flex;">
                                            <div class="input-group">
                                                <label for="department" class="form-label" style="font-weight:normal;">ชื่อวิชา</label>
                                                <div class="input-group">
                                                    <input type="hidden" class="form-control" id="sub_subject" name="sub_subjectid" value="<?php echo $sub_subject['sub_subject_id']; ?>">
                                                    <input type="text" class="form-control" id="sub_subject" name="sub_subjectname" value="<?php echo htmlspecialchars($sub_subject['sub_subject_name']); ?>" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="editSub-subject" name="editSub-subject" class="btn btn-danger" style="margin-right: 5px;">บันทึกการแก้ไข</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>