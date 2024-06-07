<?php
session_start();

require_once '../class/department.php';
$department = new Department($conn);
// Get department 
$departments = $department->getDepartments();

// add data subject in subject
if (isset($_POST['addsubject'])) {

    $department_id = htmlspecialchars($_POST['department_id']);
    $subject_name = htmlspecialchars($_POST['subject_name']);


    foreach ($departments as $value) {
        if ($department_id == $value['department_id']) {
            $department_name = $value['department_name'];
            break;
        }
    }
    if ($department->addSubject($department_id, $subject_name)) {
        $_SESSION['success'] = "Success to add subject " . $subject_name . " in department " . $department_name;
        header('location: ../subject.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to add subject";
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
                <!-- <h1>เพิ่มห้องเรียนในSubject</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../subject.php">subject</a></li>
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มห้องเรียนในSubject</li>
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
                        <P>เพิ่มข้อมูลหมวดวิชาในแผนก</P>
                    </div>
                    <div class="card1-body">
                        <label for="subject" class="form-label">ชื่อแผนก</label>
                        <form action="add_subject.php" method="post">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="department_id" id="department" aria-label="Floating label select example">
                                    <option value="0" selected>เลือกแผนก</option>
                                    <?php foreach ($departments as $department) : ?>
                                        <option value="<?php echo $department['department_id']; ?>">
                                            <?php echo htmlspecialchars($department['department_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <label for="subject" class="form-label">ตั้งชื่อหมวดวิชา</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="ชื่อหมวดวิชา" name="subject_name" autocomplete="off" required="">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="addsubject" class="btn btn-primary">บันทึก</button>
                            <a type="button" href="../subject.php" class="btn btn-secondary ">กลับ</a>
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