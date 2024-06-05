<?php
session_start();
require_once './class/building.php';
require_once './class/camera.php';

// create instance
$camera = new Camera($conn);

// Get camera details by status
$cameraDetailsNonActive = $camera->getCamerasByStatus(0);
$cameraDetailsActive = $camera->getCamerasByStatus(1);
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
        <h1>Camera</h1>
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
                        <P>ข้อมูลกล้อง</P>
                    </div>
                    <div class="card1-body">
                        <nav class="mb-2">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link text-success active" id="nav-cameraActive-tab" data-bs-toggle="tab" data-bs-target="#nav-cameraActive" type="button" role="tab" aria-controls="nav-cameraActive" aria-selected="false">Active</button>
                                <button class="nav-link text-danger" id="nav-cameraNonActive-tab" data-bs-toggle="tab" data-bs-target="#nav-cameraNonActive" type="button" role="tab" aria-controls="nav-cameraNonActive" aria-selected="true">Non Active</button>
                            </div>
                            <a href="./camera/add_camera.php" class="btn btn-success">เพิ่มกล้องในอาคาร</a>
                        </nav>
                        <div class="tab-pane fade active show" id="nav-cameraActive" role="tabpanel" aria-labelledby="nav-cameraActive-tab">
                            <div class="table-responsive">
                                <table id="cameraActive" class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                    <thead class="table-thead">
                                        <?php if (empty($cameraDetailsActive)) : ?>
                                            <tr>
                                                <th scope="col" class="text-center">No camera is on</th>
                                            </tr>
                                        <?php else : ?>
                                            <tr>
                                                <th scope="col">ชื่อกล้อง</th>
                                                <th scope="col">อาคาร</th>
                                                <th scope="col">ห้องเรียนในอาคาร</th>
                                                <th scope="col">ปิดกล้อง</th>
                                            </tr>
                                        <?php endif; ?>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cameraDetailsActive as $detail) : ?>
                                            <tr class="table1-active">
                                                <td scope="row"><?php echo htmlspecialchars($detail['camera_name']) ?></td>
                                                <td><?php echo  htmlspecialchars($detail['building_fullname']) . " - " . htmlspecialchars($detail['building_name']) ?></td>
                                                <td><?php echo  htmlspecialchars($detail['room_name']) . " - " . htmlspecialchars($detail['room_number']) ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-danger" href="./camera/status_camera.php?id=<?php echo htmlspecialchars($detail['camera_id']) ?>">ปิด</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-cameraNonActive" role="tabpanel" aria-labelledby="nav-cameraNonActive-tab">
                            <div class="table-responsive">
                                <table id="cameraNonActive" class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                    <thead class="table-thead">
                                        <?php if (empty($cameraDetailsNonActive)) : ?>
                                            <tr>
                                                <th scope="col" class="text-center">No camera is off</th>
                                            </tr>
                                        <?php else : ?>
                                            <tr>
                                                <th scope="col">ชื่อกล้อง</th>
                                                <th scope="col">อาคาร</th>
                                                <th scope="col">ห้องเรียนในอาคาร</th>
                                                <th scope="col">เปิดกล้อง</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        <?php endif; ?>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cameraDetailsNonActive as $detail) : ?>
                                            <tr class="table1-active">
                                                <td scope="row"><?php echo htmlspecialchars($detail['camera_name']) ?></td>
                                                <td><?php echo htmlspecialchars($detail['building_fullname']) . " - " . htmlspecialchars($detail['building_name']) ?></td>
                                                <td><?php echo  htmlspecialchars($detail['room_name']) . " - " . htmlspecialchars($detail['room_number']) ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="./camera/status_camera.php?id=<?php echo htmlspecialchars($detail['camera_id']) ?>">เปิด</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning" href="./camera/setup_camera.php?id=<?php echo htmlspecialchars($detail['camera_id']) ?>">ตั้งค่า</a>
                                                    <a onclick="return confirm('Are you sure you want to delete?');" class="btn btn-sm btn-danger" href="./camera/delete_camera.php?id=<?php echo htmlspecialchars($detail['camera_id']) ?>">ลบ</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- <button type="submit" class="btn btn-danger btn-width mt-2">ลบทั้งหมด</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Load the tab from localStorage if available
            let activeTab = localStorage.getItem('camerastatusmenu');
            if (activeTab) {
                $('.nav-link').removeClass('active');
                $('.tab-pane').removeClass('active show');
                $('#' + activeTab + '-tab').addClass('active');
                $('#' + activeTab).addClass('active show');
            }

            // Add click event to save tab state
            $('#nav-tab button').on('click', function() {
                let selectedTab = $(this).attr('data-bs-target').substring(1);
                localStorage.setItem('camerastatusmenu', selectedTab);
            });
        });
    </script>
</body>

</html>