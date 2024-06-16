<?php
session_start();
require_once '../class/building.php';
require_once '../class/camera.php';

// create instance
$building = new Building($conn);
$camera = new Camera($conn);
// Retrieve all buildings
$buildings = $building->getBuildings();


if (isset($_POST['addcamera'])) {
    $building_id = $_POST['building_id'];
    $room_id = $_POST['room_id'];
    $camera_name = $_POST['camera_name'];
    $status = isset($_POST['statuscamera']) ? 1 : 0; // Convert checkbox to 0 or 1

    if ($camera->addCamera($building_id, $room_id, $camera_name, $status)) {
        $_SESSION['success'] = "Success to add camera name " . $camera_name;
        header('location: ../camera.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to add camera";
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
                <!-- <h1>เพิ่มกล้องในอาคาร</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../camera.php">Camera</a></li>
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มกล้องในอาคาร</li>
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
                        <p>เพิ่มกล้องในอาคาร</p>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">ชื่ออาคาร</label>
                        <form action="./add_camera.php" method="post" onsubmit="return validateForm();">
                            <div class="form-floating mb-3">
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
                                    <option value="null" selected>เลือกห้องเรียน</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label class="form-label">ชื่อกล้อง</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="camera_name" name="camera_name" autocomplete="off" required placeholder="ตั้งชื่อกล้อง">
                                </div>
                            </div>
                            <!-- <div class="form-floating mb-3">
                                <label for="room" class="form-label">สถานะกล้อง</label>
                                <select class="form-select" name="room" id="room2" aria-label="Floating label select example">
                                    <option value="null" selected="">ปิด</option>
                                    <option value="1">เปิด</option>
                                </select>

                            </div> -->
                            <div class="form-floating mb-3">
                                <label for="room" class="form-label" style="white-space: nowrap;">สถานะกล้อง</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="statuscamera" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked style="margin: initial;">
                                    <label class="form-check-label1" for="flexSwitchCheckChecked">on off</label>
                                </div>
                            </div>
                            <button type="submit" name="addcamera" class="btn btn-success">บันทึก</button>
                            <a type="button" href="../camera.php" class="btn btn-secondary">กลับ</a>
                        </form>
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

    function validateForm() {
        var buildingSelect = document.getElementById("building");
        var roomSelect = document.getElementById("room");

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