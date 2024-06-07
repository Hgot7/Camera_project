<?php
session_start();
require_once './class/department.php';

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
        <h1>Classroom</h1>
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
                            <p style="align-content: center;margin: 10px 0px 0px 0px;">ข้อมูลชั้นเรียนในแผนก</p>
                            <!-- <div class="form-floating" style="display:flex;flex-direction:row;margin-top:10px">
                                <a href="./classroom/add_classroom.php" class="btn btn-success" style="margin-right: 0 !important;">เพิ่มชั้นเรียน</a>
                            </div> -->
                        </div>

                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">ชื่อแผนก</label>
                        <div class="col mb-2">
                            <select class="form-select" name="department_id" id="department" aria-label="Floating label select example">
                                <option value="0" selected>เลือกแผนก</option>
                                <?php foreach ($departments as $department) : ?>
                                    <option value="<?php echo $department['department_id']; ?>">
                                        <?php echo htmlspecialchars($department['department_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-floating" style="display:flex;flex-direction:row;margin-top:initial">
                                <!-- <a href="./classroom/add_department.php" class="btn btn-primary" style="margin-right: 1px !important;">จัดการแผนก</a> -->
                                <a href="./classroom/departmentmanage.php" class="btn btn-primary">จัดการแผนก</a>
                                <a href="./classroom/add_classroom.php" class="btn btn-success" style="margin-right: 1px;">เพิ่มชั้นเรียน</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="classroomTable" class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col" class="text-center">Select a department first</th>
                                    </tr>
                                </thead>
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
        function fetchClassrooms(departmentId) {
            $.ajax({
                url: './classroom/fetch_classroom.php',
                type: 'POST',
                data: {
                    department_id: departmentId
                },
                success: function(response) {
                    $('#classroomTable').html(response);
                }
            });
        }
        // Check if departmentId is in localStorage
        var savedDepartmentId = localStorage.getItem('departmentIdWithClassroom');
        if (savedDepartmentId) {
            $('#department').val(savedDepartmentId);
            fetchClassrooms(savedDepartmentId);
        }

        // When the department dropdown changes
        $('#department').change(function() {
            var departmentId = $(this).val();
            localStorage.setItem('departmentIdWithClassroom', departmentId); // Save the selected departmentId to localStorage
            fetchClassrooms(departmentId); // Fetch the rooms for the selected building
        });
    });
</script>

</html>