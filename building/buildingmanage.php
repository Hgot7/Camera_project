<?php
session_start();

require_once '../class/building.php';
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
                <!-- <h1>จัดการอาคาร</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../building.php">Building</a></li>
                        <li class="breadcrumb-item active" aria-current="page">จัดการอาคาร</li>
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
                            <p style="align-content: center;margin: 0px 0px 0px 0px;">จัดการอาคาร</p>
                            <div class="form-floating" style="display:flex;flex-direction:row;margin-top:10px">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBuildingModal" style="margin-right: 1px !important;">
                                    เพิ่มข้อมูลอาคาร
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addBuildingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBuildingModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title" id="addBuildingModalLabel">เพิ่มอาคาร</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="./add_building.php" method="post" style="display: flex;">
                                                    <div class="input-group">
                                                        <label for="building" class="form-label" style="font-weight:normal;">ตั้งชื่ออาคาร</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="ชื่ออาคาร" name="building_fullname" autocomplete="off" required="">
                                                        </div>
                                                    </div>
                                                    <span class="input-group-text">-</span>
                                                    <div class="input-group">
                                                        <label for="building" class="form-label" style="font-weight:normal;">ตั้งชื่อย่ออาคาร</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="ตัวย่ออาคาร เช่น EL" name="building_name" autocomplete="off" required="">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="addbuilding" class="btn btn-primary" style="margin-right: 5px;">เพิ่มข้อมูล</button>
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
                                    <?php if (empty($buildings)) : ?>
                                        <tr>
                                            <th scope="col" class="text-center">No data</th>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <th scope="col">ชื่ออาคาร</th>
                                            <th scope="col">ชื่อย่ออาคาร</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    <?php endif; ?>
                                </thead>
                                <tbody>
                                    <?php foreach ($buildings as $building) : ?>
                                        <tr class="table1-active">
                                            <td scope="row"><?php echo htmlspecialchars($building['building_fullname']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($building['building_name']); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editBuildingModal<?php echo $building['building_id']; ?>" style="margin-right: 1px !important;">
                                                    แก้ไข
                                                </button>
                                                <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?');" href="delete_building.php?id=<?php echo $building['building_id']; ?>">ลบ</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                        <?php foreach ($buildings as $building) : ?>
                            <!-- Modal -->
                            <div class="modal fade" id="editBuildingModal<?php echo $building['building_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBuildingModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title" id="editBuildingModalLabel">แก้ไขข้อมูลอาคาร</p>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="./edit_building.php" method="post" style="display: flex;">
                                                <div class="input-group">
                                                    <label for="building" class="form-label" style="font-weight:normal;">แก้ไขชื่ออาคาร</label>
                                                    <div class="input-group">
                                                        <input type="hidden" class="form-control" id="building_id" name="building_id" value="<?php echo $building['building_id']; ?>">
                                                        <input type="text" class="form-control" id="building_fullname" name="building_fullname" value="<?php echo htmlspecialchars($building['building_fullname']); ?>" required>
                                                    </div>
                                                </div>
                                                <span class="input-group-text">-</span>
                                                <div class="input-group">
                                                    <label for="building" class="form-label" style="font-weight:normal;">แก้ไขชื่อย่ออาคาร</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="building_name" name="building_name" value="<?php echo htmlspecialchars($building['building_name']); ?>" required>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="editbuilding" name="editbuilding" class="btn btn-danger" style="margin-right: 5px;">บันทึกการแก้ไข</button>
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
    </div>
</body>

</html>