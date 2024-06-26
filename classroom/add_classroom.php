<?php
session_start();
include_once('../class/user.php');
$user = new User($conn);
if (!isset($_SESSION['admin_login'])) {
    // Check remember me token
    if (!$user->checkRememberMe()) {
        header('Location: ../index.php');
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        exit;
    }
}
require_once '../connect.php';
require_once '../class/classroom.php';
require_once '../class/building.php';
require_once '../class/department.php';

// Create instance
$building = new Building($conn);
$classroom = new Classroom($conn);
$department = new Department($conn);

// Get department 
$departments = $department->getDepartments();
// Retrieve all buildings
$buildings = $building->getBuildings();

if (isset($_POST['addClassRoom'])) {
    $department_id = $_POST['department_id'];
    $level = $_POST['level'];
    $sublevel = $_POST['sublevel'];
    $class = $_POST['class'];
    $building_id = $_POST['building_id'];
    $room_id = $_POST['room_id'];
    $subject_id = $_POST['subject_id'];
    $sub_subject_id = $_POST['sub_subject_id'];
    $line_token = $_POST['line_token'];


    if ($classroom->addClassroom($department_id, $level, $sublevel, $class, $building_id, $room_id, $subject_id, $sub_subject_id, $line_token)) {
        foreach ($departments as $department) {
            if ($department['department_id'] == $department_id) {
                $department_name = $department['department_name'];
                break;
            }
        }
        $_SESSION['success'] = "Successfully added a classroom in the " . $department_name;
        header('Location: ../classroom.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to add classroom.";
        header('Location: ../classroom.php');
        exit;
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
                <!-- <h1>Classroom</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../classroom.php">Classroom</a></li>
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มชั้นเรียน</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <P>เพิ่มชั้นเรียน</P>
                    </div>
                    <div class="card1-body">
                        <label class="form-label" for="department">ชื่อแผนก</label>
                        <form action="./add_classroom.php" method="post" onsubmit="return validateForm();">

                            <div class="form-floating mb-3">
                                <select class="form-select" name="department_id" id="department" aria-label="Floating label select example">
                                    <option value="null" selected>เลือกแผนก</option>
                                    <?php foreach ($departments as $department) : ?>
                                        <option value="<?php echo $department['department_id']; ?>">
                                            <?php echo htmlspecialchars($department['department_name']); ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <label class="form-label" for="subject">ชื่อหมวดวิชา</label>
                                    <div class="input-group">
                                        <select class="form-select" name="subject_id" id="subject" aria-label="Floating label select example" required>
                                            <option value="null" selected>โปรดเลือกแผนกก่อน</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="input-group-text">-</span>
                                <div class="input-group">
                                    <label for="sub_subject_id" class="form-label">ชื่อวิชา</label>
                                    <div class="input-group">
                                        <select class="form-select" name="sub_subject_id" id="sub_subject_id" aria-label="Floating label select example">
                                            <option value="null" selected>โปรดเลือกหมวดวิชาก่อน</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <label class="form-label" for="level">รายละเอียดชั้นปี</label>
                                    <div class="input-group">
                                        <select class="form-select" name="level" id="level" aria-label="Floating label select example" required>
                                            <option value="ปวช" selected="">ปวช.</option>
                                            <option value="ปวส">ปวส.</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="input-group-text">-</span>
                                <div class="input-group">
                                    <label for="sublevel" class="form-label">เลขชั้นปี</label>
                                    <div class="input-group">
                                        <select class="form-select" name="sublevel" id="sublevel" aria-label="Floating label select example">
                                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                <option value="<?php echo $i; ?>" <?php echo ($i === 1) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <span class="input-group-text">-</span>
                                <div class="input-group">
                                    <label for="class" class="form-label">ชื่อห้อง</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="ห้องเช่น 1 1/3 ห้องดอกไม้" name="class" autocomplete="off" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <label for="building" class="form-label">ชื่ออาคาร</label>
                                <select class="form-select" name="building_id" id="building" aria-label="Floating label select example">
                                    <option value="0" selected>เลือกอาคาร</option>
                                    <?php foreach ($buildings as $buildingOption) : ?>
                                        <option value="<?php echo $buildingOption['building_id']; ?>">
                                            <?php echo htmlspecialchars($buildingOption['building_fullname']) . " - " . htmlspecialchars($buildingOption['building_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="room" class="form-label">ห้องเรียนในอาคาร</label>
                                <select class="form-select" name="room_id" id="room" aria-label="Floating label select example">
                                    <option value="null" selected>โปรดเลือกอาคารก่อน</option>
                                </select>
                            </div>

                            <label class="form-label" for="building">Line Token</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="line token" name="line_token" autocomplete="off" required="">
                            </div>
                            <button type="submit" name="addClassRoom" class="btn btn-success">บันทึก</button>
                            <a type="button" href="../classroom.php" class="btn btn-secondary">กลับ</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('#building').change(function() {
            var buildingID = $(this).val();
            if (buildingID != "null") {
                $.ajax({
                    url: 'fetch_rooms.php',
                    type: 'post',
                    data: {
                        building_id: buildingID
                    },
                    success: function(response) {
                        $('#room').html(response);
                    }
                });
            } else {
                $('#room').html('<option value="null" selected>เลือกห้องเรียน</option>');
            }
        });
    });
    $(document).ready(function() {
        $('#department').change(function() {
            var departmentID = $(this).val();
            if (departmentID != "null") {
                $.ajax({
                    url: 'fetch_subject.php',
                    type: 'post',
                    data: {
                        department_id: departmentID
                    },
                    success: function(response) {
                        $('#subject').html(response);
                    }
                });
            } else {
                $('#suject').html('<option value="null" selected>เลือกแผนกก่อน</option>');
            }
        });
    });

    $(document).ready(function() {
        $('#department').change(function() {
            var departmentID = $(this).val();
            if (departmentID != "null") {
                $.ajax({
                    url: 'fetch_subject.php',
                    type: 'post',
                    data: {
                        department_id: departmentID
                    },
                    success: function(response) {
                        $('#subject').html(response);
                        $('#sub_subject_id').html('<option value="null" selected>เลือกหมวดวิชาก่อน</option>');
                    }
                });
            } else {
                $('#subject').html('<option value="null" selected>เลือกแผนกก่อน</option>');
                $('#sub_subject_id').html('<option value="null" selected>เลือกหมวดวิชาก่อน</option>');
            }
        });

        $('#subject').change(function() {
            var subjectID = $(this).val();
            if (subjectID != "null") {
                $.ajax({
                    url: 'fetch_sub_subject.php', // Use a different script for fetching sub-subjects
                    type: 'post',
                    data: {
                        subject_id: subjectID
                    },
                    success: function(response) {
                        $('#sub_subject_id').html(response);
                    }
                });
            } else {
                $('#sub_subject_id').html('<option value="null" selected>เลือกหมวดวิชาก่อน</option>');
            }
        });
    });


    function validateForm() {
        var departmentSelect = document.getElementById("department");
        var subjectSelect = document.getElementById("subject");
        var subSubjectSelect = document.getElementById("sub_subject_id");
        var buildingSelect = document.getElementById("building");
        var roomSelect = document.getElementById("room");

        if (departmentSelect.value === "null") {
            alert("กรุณาเลือกแผนกที่ถูกต้อง");
            return false; // Prevent form submission
        }

        if (subjectSelect.value === "null") {
            alert("กรุณาเลือกหมวดวิชาที่ถูกต้อง");
            return false; // Prevent form submission
        }

        if (subSubjectSelect.value === "null") {
            alert("กรุณาเลือกวิชาที่ถูกต้อง");
            return false; // Prevent form submission
        }

        if (buildingSelect.value === "0") {
            alert("กรุณาเลือกอาคารที่ถูกต้อง");
            return false; // Prevent form submission
        }

        if (roomSelect.value === "null") {
            alert("กรุณาเลือกห้องเรียนที่ถูกต้อง");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>

</html>