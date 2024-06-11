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
        <h1>Subject</h1>
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
                        <P>ข้อมูลหมวดวิชาในแผนก</P>
                    </div>
                    <div class="card1-body">
                        <label for="subject" class="form-label">ชื่อแผนก</label>
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
                                <a href="./subject/departmentmanage.php" class="btn btn-primary">จัดการแผนก</a>
                                <a href="./subject/add_subject.php" class="btn btn-success" style="margin-right: 1px !important;">เพิ่มข้อมูลหมวดวิชา</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="subjectTable" class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col" class="text-center">Select a department first</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="editSubjectModal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p class="modal-title" id="editSubjectModalLabel1">แก้ไขชื่อหมวดวิชา</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="subject" class="form-label" style="font-weight:normal;">ตั้งชื่อหมวดวิชา</label>
                                        <form action="subject/edit_subject.php" method="post">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="subject_name_edit" placeholder="ชื่อหมวดวิชา" name="subject_name" value="' . htmlspecialchars($detail['subject_name']) . '" autocomplete="off" required>
                                                <input type="hidden" name="subject_id" value="' . $detail['subject_id'] . '">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" style="margin-right: 5px;">บันทึก</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    </div>
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
        // Function to fetch subject
        function fetchSubjects(departmentId) {
            $.ajax({
                url: './subject/fetch_subject.php',
                type: 'POST',
                data: {
                    department_id: departmentId
                },
                success: function(response) {
                    $('#subjectTable').html(response);
                    initializeModals(); // Call the function to initialize modals after content is loaded
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.log(xhr.responseText);
                }
            });
        }
        // Check if departmentId is in localStorage
        var savedDepartmentId = localStorage.getItem('departmentIdWithSubject');
        if (savedDepartmentId) {
            $('#department').val(savedDepartmentId);
            fetchSubjects(savedDepartmentId);
        }
        // When the building dropdown changes
        $('#department').change(function() {
            var departmentId = $(this).val();
            localStorage.setItem('departmentIdWithSubject', departmentId); // Save the selected departmentId to localStorage
            fetchSubjects(departmentId); // Fetch the rooms for the selected building
        });
        // show of Modal
        function initializeModals() {
            // Select all modals and buttons
            var modals = document.querySelectorAll(".modal");
            var modalButtons = document.querySelectorAll("[data-bs-toggle='modal']");
            modalButtons.forEach(function(btn) {
                // Get the target modal ID from the button's data-bs-target attribute
                var targetModalId = btn.getAttribute("data-bs-target").substring(1);
                console.log(targetModalId);
                var modal = document.getElementById(targetModalId);
                // Get the close buttons within the modal
                var closeModalBtns = modal.querySelectorAll("[data-bs-dismiss='modal']");
                // Show the modal when the button is clicked
                btn.addEventListener("click", function() {
                    modal.style.display = "block";
                    setTimeout(function() {
                        modal.classList.add("show");
                    }, 10);
                });
                // Close the modal when any close button is clicked
                closeModalBtns.forEach(function(closeBtn) {
                    closeBtn.addEventListener("click", function() {
                        modal.classList.remove("show");
                        setTimeout(function() {
                            modal.style.display = "none";
                        }, 150);
                    });
                });
                // Prevent the modal from closing when clicking outside of it or pressing Escape
                modal.addEventListener("click", function(event) {
                    if (event.target === modal) {
                        modal.classList.add("modal-static");
                        setTimeout(function() {
                            modal.classList.remove("modal-static");
                        }, 180);
                    }
                });
            });
        }
        // Initialize all modals on the page
        initializeModals();
    });
</script>

</html>