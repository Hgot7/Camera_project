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
require_once '../class/building.php';
require_once '../class/room.php';
require_once '../class/classroom.php';
require_once '../class/department.php';
require_once '../class/queueSetup.php';

// create instance
$building = new Building($conn);
$department = new Department($conn);
$queue_setup = new QueueSetup($conn);

$buildings = $building->getBuildings();
$departments = $department->getDepartments();

if (isset($_POST['addQueue'])) {
    $department_id = $_POST['department_id'];
    $classroom_id = $_POST['classroom_id'];
    $building_id = $_POST['building_id'];
    $room_id = $_POST['room_id'];
    $camera_id = $_POST['camera_id'];
    $day = $_POST['day'];
    $time_start = $_POST['time_start'];
    $time_stop = $_POST['time_stop'];


    if ($queue_setup->insertQueueSetup($day, $time_start, $time_stop, $classroom_id, $building_id, $room_id, $camera_id)) {
        $_SESSION['success'] = "Queue added successfully!";
        header("Location: ../queue.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to add queue.";
        header("Location: ../queue.php");
        exit();
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
                <!-- <h1>queue</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../queue.php">Queue</a></li>
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลคิวถ่ายรูป</li>
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
                        <P>เพิ่มข้อมูลคิวถ่ายรูป</P>
                    </div>
                    <div class="card1-body">
                        <form id="addQueueForm" action="./add_queue.php" method="post" onsubmit="return validateForm()">
                            <div class="form-floating mb-3">
                                <label for="department" class="form-label">แผนก</label>
                                <select class="form-select" name="department_id" id="department" aria-label="Floating label select example">
                                    <option value="0" selected>เลือกแผนก</option>
                                    <?php foreach ($departments as $department) : ?>
                                        <option value="<?php echo $department['department_id']; ?>">
                                            <?php echo htmlspecialchars($department['department_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="classroom" class="form-label">ชั้นเรียนในแผนก</label>
                                <select class="form-select" name="classroom_id" id="classroom" aria-label="Floating label select example">
                                    <option value="0" selected="">เลือกแผนกก่อน</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <label for="building" class="form-label">ชื่ออาคาร</label>
                                    <div class="input-group">
                                        <select class="form-select" name="building_id" id="building" aria-label="Floating label select example">
                                            <option value="0" selected>เลือกอาคาร</option>
                                            <?php foreach ($buildings as $buildingOption) : ?>
                                                <option value="<?php echo $buildingOption['building_id']; ?>">
                                                    <?php echo htmlspecialchars($buildingOption['building_fullname']) . " - " . htmlspecialchars($buildingOption['building_name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <span class="input-group-text">-</span>
                                <div class="input-group">
                                    <label for="room" class="form-label">ห้องเรียนในอาคาร</label>
                                    <div class="input-group">
                                        <select class="form-select" name="room_id" id="room" aria-label="Floating label select example">
                                            <option value="null" selected="">เลือกอาคารก่อน</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="input-group-text">-</span>
                                <div class="input-group">
                                    <label for="room" class="form-label">กล้อง</label>
                                    <div class="input-group">
                                        <select class="form-select" name="camera_id" id="camera" aria-label="Floating label select example">
                                            <option value="null" selected="">เลือกห้องเรียนก่อน</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <label for="day" class="form-label">วันถ่ายรูป</label>
                                    <div class="input-group">
                                        <select class="form-select" name="day" id="day" aria-label="Floating label select example">
                                            <option value="null" selected="">เลือกวัน</option>
                                            <option value="1">จันทร์</option>
                                            <option value="2">อังคาร</option>
                                            <option value="3">พุธร</option>
                                            <option value="4">พฤหัสบดี</option>
                                            <option value="5">ศุกร์</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="input-group-text">-</span>
                                <div class="input-group">
                                    <label for="time" class="form-label">เลือกเวลาเริ่มถ่ายรูป</label>
                                    <div class="input-group">
                                        <input type="time" id="time_start" name="time_start" required="">
                                    </div>
                                </div>
                                <span class="input-group-text">-</span>
                                <div class="input-group">
                                    <label for="time" class="form-label">เลือกเวลาส่งถ่ายรูป</label>
                                    <div class="input-group">
                                        <input type="time" id="time_stop" name="time_stop" required="">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="addQueue" class="btn btn-success">บันทึก</button>
                            <a type="button" href="../queue.php" class="btn btn-secondary ">กลับ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        // When the department is changed, fetch the classrooms
        $('#department').change(function() {
            var departmentID = $(this).val();
            if (departmentID != "null") {
                $.ajax({
                    url: 'fetch_classrooms.php',
                    type: 'post',
                    data: {
                        department_id: departmentID
                    },
                    success: function(response) {
                        $('#classroom').html(response);
                        $('#classroom').trigger('change'); // Trigger classroom change to load cameras if classroom is already selected
                    }
                });
            } else {
                $('#classroom').html('<option value="null" selected>เลือกชั้นเรียน</option>');
            }
        });
        // When the building is changed, fetch the rooms
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
                        $('#room').trigger('change'); // Trigger room change to load cameras if room is already selected
                    }
                });
            } else {
                $('#room').html('<option value="null" selected>เลือกห้องเรียน</option>');
                $('#camera').html('<option value="null" selected>เลือกกล้อง</option>');
            }
        });

        // When the room is changed, fetch the cameras
        $('#room').change(function() {
            var buildingID = $('#building').val();
            var roomID = $(this).val();
            if (buildingID != "null" && roomID != "null") {
                $.ajax({
                    url: 'fetch_cameras.php',
                    type: 'post',
                    data: {
                        building_id: buildingID,
                        room_id: roomID
                    },
                    success: function(response) {
                        $('#camera').html(response);
                    }
                });
            } else {
                $('#camera').html('<option value="null" selected>เลือกกล้อง</option>');
            }
        });
    });

    function validateForm() {
        var department = document.getElementById("department").value;
        var classroom = document.getElementById("classroom").value;
        var building = document.getElementById("building").value;
        var room = document.getElementById("room").value;
        var camera = document.getElementById("camera").value;
        var day = document.getElementById("day").value;
        var time_start = document.getElementById("time_start").value;
        var time_stop = document.getElementById("time_stop").value;

        if (department == "0") {
            alert("กรุณาเลือกแผนก");
            return false;
        }
        if (classroom == "0") {
            alert("กรุณาเลือกชั้นเรียนในแผนก");
            return false;
        }
        if (building == "0") {
            alert("กรุณาเลือกอาคาร");
            return false;
        }
        if (room == "null") {
            alert("กรุณาเลือกห้องเรียนในอาคาร");
            return false;
        }
        if (camera == "null") {
            alert("กรุณาเลือกกล้อง");
            return false;
        }
        if (day == "null") {
            alert("กรุณาเลือกวันถ่ายรูป");
            return false;
        }
        if (time_start == "") {
            alert("กรุณาเลือกเวลาเริ่มถ่ายรูป");
            return false;
        }
        if (time_stop == "") {
            alert("กรุณาเลือกเวลาสิ้นสุดถ่ายรูป");
            return false;
        }

        return true;
    }
</script>

</html>