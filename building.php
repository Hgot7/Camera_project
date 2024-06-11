<?php
session_start();
require_once './class/building.php';
// create instance of class in class/building.php
$building = new Building($conn);
// Retrieve all buildings
$buildings = $building->getBuildings();
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
        <h1>Building</h1>
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
                        <P>ข้อมูลห้องเรียนในอาคาร</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">ชื่ออาคาร</label>
                        <div class="col mb-2">
                            <select class="form-select" name="building_id" id="building" aria-label="Floating label select example">
                                <option value="0" selected>เลือกอาคาร</option>
                                <?php foreach ($buildings as $buildingOption) : ?>
                                    <option value="<?php echo $buildingOption['building_id']; ?>">
                                        <?php echo htmlspecialchars($buildingOption['building_fullname']) . " - " . htmlspecialchars($buildingOption['building_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-floating" style="display:flex;flex-direction:row;margin-top:initial">
                                <a href="./building/buildingmanage.php" class="btn btn-primary">จัดการอาคาร</a>
                                <a href="./building/add_room.php" class="btn btn-success" style="margin-right:1px;">เพิ่มห้องเรียนในอาคาร</a>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table id="roomsTable" class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col" class="text-center">Select a building first</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
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
        // Function to fetch rooms
        function fetchRooms(buildingId) {
            $.ajax({
                url: './building/fetch_rooms.php',
                type: 'POST',
                data: {
                    building_id: buildingId
                },
                success: function(response) {
                    $('#roomsTable').html(response);
                }
            });
        }
        // Check if buildingId is in localStorage
        var savedBuildingId = localStorage.getItem('buildingId');
        if (savedBuildingId) {
            $('#building').val(savedBuildingId);
            fetchRooms(savedBuildingId);
        }

        // When the building dropdown changes
        $('#building').change(function() {
            var buildingId = $(this).val();
            localStorage.setItem('buildingId', buildingId); // Save the selected buildingId to localStorage
            fetchRooms(buildingId); // Fetch the rooms for the selected building
        });
    });
</script>

</html>