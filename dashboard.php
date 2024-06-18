<?php
session_start();
include_once('./class/user.php');
include_once('./class/building.php');
include_once('./class/camera.php');
include_once('./class/department.php');
include_once('./class/classroom.php');

$user = new User($conn);
if (!isset($_SESSION['admin_login'])) {
    // Check remember me token
    if (!$user->checkRememberMe()) {
        header('Location: ./index.php');
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        exit;
    }
}

// instance
$building = new Building($conn);
$camera = new Camera($conn);
$classroom = new Classroom($conn);
$department = new department($conn);

// get array data
$buildings = $building->getBuildings();
$cameras = $camera->getCameras();
$cameraDetailsActive = $camera->getCamerasByStatus(1);
$classrooms = $classroom->getClassrooms();
$subjects = $department->getSubjects();




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
        <h1 style=" margin-bottom: inherit; margin-top: inherit;">Dashboard</h1>
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
        <div class="row row-cols-4">

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="card-item">
                            <div class="card-header">
                                <span class="">Building</span>
                            </div>
                            <div class="card-title">
                                <span class="card-text-number"><?php echo count($buildings); ?></span>
                                <span class="card-text"> Buildings</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                        <div class="card-item">
                            <div class="card-header">
                                <span class="">Camera</span>
                            </div>
                            <div class="card-title">
                                <span class="card-text-number"><?php echo count($cameras); ?></span>
                                <span class="card-text"> Devices</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="card-item">
                            <div class="card-header">
                                <span class="">Classroom</span>
                            </div>
                            <div class="card-title">
                                <span class="card-text-number"><?php echo count($classrooms); ?></span>
                                <span class="card-text"> Total</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <div class="card-item">
                            <div class="card-header">
                                <span class="">Subject</span>
                            </div>
                            <div class="card-title">
                                <span class="card-text-number"><?php echo count($subjects); ?></span>
                                <span class="card-text"> Total</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h1 style="margin-bottom: inherit;padding-left: 10px;">Camera Active</h1>
            <div class="table-responsive">
                <table class="table text-center align-middle table-hover mb-0">
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

                            </tr>
                        <?php endif; ?>
                    </thead>

                    
                    <tbody>
                        <?php foreach ($cameraDetailsActive as $detail) : ?>
                            <tr class="table-active">
                                <td scope="row"><?php echo htmlspecialchars($detail['camera_name']) ?></td>
                                <td><?php echo  htmlspecialchars($detail['building_fullname']) . " - " . htmlspecialchars($detail['building_name']) ?></td>
                                <td><?php echo  htmlspecialchars($detail['room_name']) . " - " . htmlspecialchars($detail['room_number']) ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>