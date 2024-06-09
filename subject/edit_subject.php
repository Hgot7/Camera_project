
<?php
session_start();
require_once '../class/department.php';
// Create instance
$department = new Department($conn);

if (isset($_GET['id'])) {
    $subject_id = $_GET['id']; // หรือใช้ POST แล้วแต่สถานการณ์
    $subject = $department->getSubjecBySujectId($subject_id);
}
if (isset($_POST['editsubject'])) {
    $subject_id = $_POST['subject_id']; // หรือใช้ GET แล้วแต่สถานการณ์
    $subject_name = $_POST['subject_name'];
    if ($department->updateSubject($subject_id, $subject_name)) {
        $_SESSION['success'] =  "Subject " . $subject_name . " updated successfully!";
        header('location: ../subject.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to update subject " . $subject_name;
        header('location: ../subject.php');
        exit;
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
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../subject.php">Subject</a></li>
                        <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลหมวดวิชาในแผนก</li>
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
                        <P>แก้ไขข้อมูลหมวดวิชาในแผนก::</P>
                    </div>
                    <div class="card1-body">
                        <label for="subject" class="form-label">ชื่อหมวดวิชา</label><code> *แก้ไขชื่อหมวดวิชาใหม่ได้</code>
                        <form action="./edit_subject.php" method="post">
                            <input type="hidden" name="subject_id" value="<?php echo htmlspecialchars($subject['subject_id']); ?>">
                            <input type="hidden" name="department_id" value="<?php echo htmlspecialchars($subject['department_id']); ?>">
                            <div class="form-floating mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="" name="subject_name" value="<?php echo htmlspecialchars($subject['subject_name']); ?>" autocomplete="off" required="">
                                </div>
                            </div>
                            <button type="submit" name="editsubject" class="btn btn-danger">บันทึก</button>
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
