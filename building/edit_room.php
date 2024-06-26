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


// Create instances
$room = new Room($conn);
$building = new Building($conn);

// Get all buildings for the dropdown
$buildings = $building->getBuildings();

if (isset($_GET['id'])) {
    $room_id = $_GET['id'];
    $roomDetails = $room->getRoomDetails($room_id);
}

if (isset($_POST['editroom'])) {

    $building_id = $_POST['building_id'];
    $room_name =  $_POST['room_name'];
    $room_number = $_POST['room_number'];
    $room_id = $_POST['room_id'];
    $roombuilding_id = $_POST['roombuilding_id'];


    if ($room->updateRoom($building_id, $room_name, $room_number, $room_id)) {
        if ($building_id != $roombuilding_id) {
            foreach ($buildings as $buildingOption) {
                if ($buildingOption['building_id'] == $building_id) {
                    $_SESSION['success'] = "Room : " . $room_name . " moved to new building " . htmlspecialchars($buildingOption['building_fullname']) . " - " . htmlspecialchars($buildingOption['building_name']);
                    break;
                }
            }
        } else {
            $_SESSION['success'] = "Success to update room : " . $room_name;
        }
        header('location: ../building.php');
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
                <!-- <h1>แก้ไขห้องเรียนในอาคาร</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../building.php">Building</a></li>
                        <li class="breadcrumb-item active" aria-current="page">แก้ไขห้องเรียนในอาคาร</li>
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
                        <P>แก้ไขห้องเรียนในอาคาร</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">ชื่ออาคาร</label><code> *เลือกชื่ออาคารใหม่ได้</code>
                        <form action="./edit_room.php" method="post">
                            <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($roomDetails['room_id']); ?>">
                            <input type="hidden" name="roombuilding_id" value="<?php echo htmlspecialchars($roomDetails['building_id']); ?>">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="building_id" id="building_id" aria-label="Floating label select example" required>
                                    <option value="" selected>เลือกอาคาร</option>
                                    <?php foreach ($buildings as $buildingOption) : ?>
                                        <option value="<?php echo $buildingOption['building_id']; ?>" <?php echo $buildingOption['building_id'] == $roomDetails['building_id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($buildingOption['building_fullname']) . " - " . htmlspecialchars($buildingOption['building_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <label for="room_name" class="form-label">ตั้งชื่อห้องเรียนในอาคาร</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="ชื่อห้อง" name="room_name" value="<?php echo htmlspecialchars($roomDetails['room_name']); ?>" autocomplete="off" required="">
                                    </div>
                                </div>
                                <span class="input-group-text">-</span>
                                <div class="input-group">
                                    <label for="room_number" class="form-label">ตั้งหมายเลขห้องเรียนในอาคาร</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="เลขห้อง เช่น 101" name="room_number" value="<?php echo htmlspecialchars($roomDetails['room_number']); ?>" autocomplete="off" required="">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="editroom" class="btn btn-danger">บันทึก</button>
                            <a type="button" href="../building.php" class="btn btn-secondary ">กลับ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>