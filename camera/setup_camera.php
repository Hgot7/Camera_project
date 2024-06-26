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
require_once '../class/camera.php';
require_once '../class/room.php';

// create instance

$building = new Building($conn);
$room = new Room($conn);
$camera = new Camera($conn);

$buildings = $building->getBuildings();

if (isset($_GET['id'])) {
    $camera_id = $_GET['id'];
    // Get camera details by camera_id
    $cameraDetail = $camera->getCamerasById($camera_id);
    $rooms = $room->getRoomsWithBuilding($cameraDetail['building_id']);
}

if (isset($_POST['updatecamera'])) {
    $camera_id = $_POST['camera_id'];
    $building_id = $_POST['building_id'];
    $room_id = $_POST['room_id'];
    $camera_name = $_POST['camera_name'];

    $rooms = $room->getRoomsWithBuilding($building_id);

    if ($camera->updateCamera($camera_id, $building_id, $room_id, $camera_name)) {
        $_SESSION['success'] = "Success to update camera name " . $camera_name;
        header('Location: ../camera.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to update camera";
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
                <!-- <h1>ตั้งค่าตำแหน่งกล้อง</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../camera.php">Camera</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ตั้งค่าตำแหน่งกล้อง</li>
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
                        <P>ตั้งค่าตำแหน่งกล้อง</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">ชื่ออาคาร</label> <code> *เลือกอาคารใหม่ได้</code>
                        <form action="./setup_camera.php" method="post" onsubmit="return validateForm();">
                            <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->
                            <div class="form-floating mb-3">
                                <select class="form-select" name="building_id" id="building" aria-label="Floating label select example" required>
                                    <!-- <option value="null" selected>เลือกอาคาร</option> -->
                                    <?php foreach ($buildings as $buildingOption) : ?>
                                        <option value="<?php echo $buildingOption['building_id']; ?>" <?php echo $buildingOption['building_id'] == $cameraDetail['building_id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($buildingOption['building_fullname']) . " - " . htmlspecialchars($buildingOption['building_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="room" class="form-label">ห้องเรียนในอาคาร</label>
                                <select class="form-select" name="room_id" id="room" aria-label="Floating label select example" required>
                                    <!-- <option value="null" selected="">เลือกห้องเรียน</option> -->
                                    <?php foreach ($rooms as $roomOption) : ?>
                                        <option value="<?php echo $roomOption['room_id']; ?>" <?php echo $roomOption['room_id'] == $cameraDetail['room_id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($roomOption['room_name']) . " - " . htmlspecialchars($roomOption['room_number']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                    </div>
                    <div class="card1-header">
                        <P>ตั้งค่ารายละเอียดกล้อง</P>
                    </div>
                    <div class="card1-body">
                        <div class="form-floating mb-3">

                            <label class="form-label">ชื่อกล้อง</label><code> *แก้ไขชื่อกล้องได้</code>
                            <div class="input-group">
                                <input type="text" class="form-control" id="camera_name" name="camera_name" autocomplete="off" required placeholder="ตั้งชื่อกล้อง" value="<?php echo $cameraDetail['camera_name']; ?>">
                            </div>
                        </div>
                        <input type="hidden" name="camera_id" value="<?php echo htmlspecialchars($camera_id); ?>">
                        <button type="submit" name="updatecamera" class="btn btn-danger">บันทึก</button>
                        <a type="button" href="../camera.php" class="btn btn-secondary">กลับ</a>
                    </div>
                </div>
                </form>
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

    function validateForm() {
        var roomSelect = document.getElementById("room");
        if (roomSelect.value === "null") {
            alert("กรุณาเลือกห้องเรียนที่ถูกต้อง");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>

</html>