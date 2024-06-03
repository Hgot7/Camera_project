<?php
session_start();

require_once '../class/building.php';
require_once '../class/room.php';
// create instance of class in class/building.php
$building = new Building($conn);
// Retrieve all buildings
$buildings = $building->getBuildings();
// create instance of class in class/room.php
$room = new Room($conn);

// add data room in building
if (isset($_POST['addroom'])) {

    $building_id = htmlspecialchars($_POST['building_id']);
    $room_name = htmlspecialchars($_POST['room_name']);
    $room_number = htmlspecialchars($_POST['room_number']);

    if ($room->addRoom($building_id, $room_name, $room_number)) {
        $_SESSION['success'] = "Success to add room";
        header('location: ../building.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to add room";
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
                <!-- <h1>เพิ่มห้องเรียนในอาคาร</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../building.php">Building</a></li>
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มห้องเรียนในอาคาร</li>
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
                        <P>เพิ่มห้องเรียนในอาคาร</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">ชื่ออาคาร</label>
                        <form action="add_room.php" method="post">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="building_id" id="building_id" aria-label="Floating label select example">
                                    <option value="" selected>เลือกอาคาร</option> <?php foreach ($buildings as $buildingOption) : ?>
                                        <option value="<?php echo $buildingOption['building_id']; ?>">
                                            <?php echo htmlspecialchars($buildingOption['building_fullname']) . " - " . htmlspecialchars($buildingOption['building_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <label for="building" class="form-label">ตั้งชื่อห้องเรียนในอาคาร</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="ชื่อห้อง" name="room_name" autocomplete="off" required="">
                                    </div>
                                </div>
                                <span class="input-group-text">-</span>
                                <div class="input-group">
                                    <label for="building" class="form-label">ตั้งหมายเลยห้องเรียนในอาคาร</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="เลขห้อง เช่น 101" name="room_number" autocomplete="off" required="">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="addroom" class="btn btn-primary">บันทึก</button>
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