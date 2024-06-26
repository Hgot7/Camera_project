<?php
session_start();
include_once('./class/user.php');
$user = new User($conn);
if (!isset($_SESSION['admin_login'])) {
    // Check remember me token
    if (!$user->checkRememberMe()) {
        header('Location: ./index.php');
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        exit;
    }
}

require_once './class/building.php';
require_once './class/department.php';
require_once './class/classroom.php';
require_once './class/queueSetup.php';
require_once './class/room.php';
require_once './class/camera.php';

// create instance
$building = new Building($conn);
$room = new Room($conn);
$camera = new Camera($conn);
$queue_setup = new QueueSetup($conn);
$department = new Department($conn);
$classroom = new Classroom($conn);
// Get department 
$departments = $department->getDepartments();
// Get queue
$queue_setups = $queue_setup->getQueueSetups();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <!-- นำเข้าไฟล์ CSS ของ Bootstrap Icons ผ่าน CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="./assets/images/cameradark.png" type="png">
    <title>RIETC</title>
    <script src="./jquery.js"></script>
    <script src="./script.js"></script>
</head>

<body>
    <?php include_once("./assets/components/header.php"); ?>
    <?php include_once("./assets/components/sidebar.php"); ?>
    <?php include_once("./assets/components/sidebarResponsive.php"); ?>

    <div class="overlay"></div>
    <!-- Spinner Start -->
    <div id="spinner" class="show spinner-container">
        <div class="spinner-border text-danger" role="status"></div>
    </div>

    <div class="container">
        <h1>Queue</h1>
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
    <div class="container ">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-body">
                        <div class="time">
                            <div class="time-colon">
                                <div class="time-text">
                                    <span class="num hour_num"><?php echo date('h'); ?></span>
                                    <span class="text">Hours</span>
                                </div>
                                <span class="colon">:</span>
                            </div>
                            <div class="time-colon">
                                <div class="time-text">
                                    <span class="num min_num"><?php echo date('i'); ?></span>
                                    <span class="text">Minutes</span>
                                </div>
                                <span class="colon">:</span>
                            </div>
                            <div class="time-colon">
                                <div class="time-text">
                                    <span class="num sec_num"><?php echo date('s'); ?></span>
                                    <span class="text">Seconds</span>
                                </div>
                                <span class="am_pm"><?php echo date('A'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <div class="col mb-0">
                            <p style="align-content: center;margin: 0px 0px 0px 0px;">รายการคิวถ่ายรูป</p>
                            <div class="form-floating" style="display:flex;flex-direction:row;margin-top:10px">
                                <a href="./queue/add_queue.php" class="btn btn-success" style="margin-right:1px;">เพิ่มคิวถ่ายรูป</a>
                            </div>
                        </div>
                    </div>
                    <div class="card1-body">
                        <div class="table-responsive">
                            <table class="table text-center align-middle table-hover mb-0" style="padding: 0px; table-layout: auto !important;">
                                <thead class="table-thead">
                                    <?php if (empty($queue_setups)) : ?>
                                        <tr>
                                            <th scope="col" class="text-center">No queue list</th>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">ชื่อห้อง</th>
                                            <th scope="col">แผนก</th>
                                            <th scope="col">วัน</th>
                                            <th scope="col">เริ่มถ่าย</th>
                                            <th scope="col">ส่งรูป</th>
                                            <th scope="col">อาคาร</th>
                                            <th scope="col">ห้อง</th>
                                            <th scope="col">กล้อง</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    <?php endif; ?>
                                </thead>
                                <tbody>
                                    <?php foreach ($queue_setups as $queue) :
                                        $classroomDetails = $classroom->getClassroomById($queue['classroom_id']);
                                        $departmentDetails = $department->getDepartmenById($classroomDetails['department_id']);
                                        $buildingDetails = $building->getBuildingsByBuildingId($queue['building_id']);
                                        $roomDetails = $room->getRoomDetails($queue['room_id']);
                                        $cameraDetails = $camera->getCamerasById($queue['camera_id']);
                                    ?>
                                        <tr class="table1-active">
                                            <td scope="row"><?php echo htmlspecialchars($queue['queue_id']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($classroomDetails['class']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($departmentDetails['department_name']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($queue['day']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($queue['time_start']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($queue['time_stop']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($buildingDetails['building_name']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($roomDetails['room_name']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($cameraDetails['camera_name']); ?></td>
                                            <td>
                                                <a class="btn btn-sm btn-warning" href="./queue/edit_queue.php?id=<?php echo $queue['queue_id']; ?>">แก้ไข</a>
                                                <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?');" href="./queue/delete_queue.php?id=<?php echo $queue['queue_id']; ?>">ลบ</a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTime() {
            let date = new Date(),
                hour = date.getHours(),
                min = date.getMinutes(),
                sec = date.getSeconds();

            let d = hour < 12 ? "AM" : "PM";
            hour = hour % 12 || 12; // Convert to 12-hour format

            // Adding leading zeros
            hour = hour.toString().padStart(2, '0');
            min = min.toString().padStart(2, '0');
            sec = sec.toString().padStart(2, '0');

            document.querySelector(".hour_num").innerText = hour;
            document.querySelector(".min_num").innerText = min;
            document.querySelector(".sec_num").innerText = sec;
            document.querySelector(".am_pm").innerText = d;
        }

        // Update time immediately and then every second
        updateTime();
        setInterval(updateTime, 1000);

        // Dark mode toggle (if needed)
        let timeContainer = document.querySelector(".time");
        document.querySelector(".icons").onclick = () => {
            timeContainer.classList.toggle("dark");
        }
    });
</script>

</html>