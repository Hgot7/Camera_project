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
require_once '../class/department.php';
// create instance
$department = new Department($conn);
// Get department 
$departments = $department->getDepartments();

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
                <!-- <h1>subject</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../subject.php">Subject</a></li>
                        <li class="breadcrumb-item active" aria-current="page">จัดการแผนก</li>
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
                            <p style="align-content: center;margin: 0px 0px 0px 0px;">จัดการแผนก</p>
                            <div class="form-floating" style="display:flex;flex-direction:row;margin-top:10px">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal" style="margin-right: 1px !important;">
                                    เพิ่มแผนก
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addDepartmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title" id="addDepartmentModalLabel">เพิ่มแผนก</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="department" class="form-label" style="font-weight: normal;">ตั้งชื่อแผนก</label>
                                                <form action="./add_department.php" method="post">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="ชื่อแผนก" name="department_name" autocomplete="off" required="">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="addDepartment" class="btn btn-primary" style="margin-right: 5px;">บันทึก</button>
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
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">ชื่อแผนก</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($departments as $department) : ?>
                                        <tr class="table1-active">
                                            <td scope="row"><?php echo htmlspecialchars($department['department_id']); ?></td>
                                            <td scope="row"><?php echo htmlspecialchars($department['department_name']); ?></td>
                                            <td>
                                                <!-- <a class="btn btn-sm btn-warning" href="edit_department.php?id=<?php echo $department['department_id']; ?>">แก้ไข</a> -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editDepartmentModal<?php echo $department['department_id']; ?>" style="margin-right: 1px !important;">
                                                    แก้ไข
                                                </button>
                                                <a onclick="return confirm('Are you sure you want to delete?');" class="btn btn-sm btn-danger" href="delete_department.php?id=<?php echo $department['department_id']; ?>">ลบ</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php foreach ($departments as $department) : ?>
                            <!-- Modal -->
                            <div class="modal fade" id="editDepartmentModal<?php echo $department['department_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title" id="editDepartmentModalLabel">แก้ไขข้อมูลแผนก</p>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="./edit_department.php" method="post" style="display: flex;">
                                                <div class="input-group">
                                                    <label for="department" class="form-label" style="font-weight:normal;">แก้ไขชื่อแผนก</label>
                                                    <div class="input-group">
                                                        <input type="hidden" class="form-control" id="department_id" name="department_id" value="<?php echo $department['department_id']; ?>">
                                                        <input type="text" class="form-control" id="department_name" name="department_name" value="<?php echo htmlspecialchars($department['department_name']); ?>" required>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="editDepartment" name="editDepartment" class="btn btn-danger" style="margin-right: 5px;">บันทึกการแก้ไข</button>
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
    </div>
    </div>
</body>

</html>