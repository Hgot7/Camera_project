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
                <!-- <h1>Subject</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../subject.php">Subject</a></li>
                        <li class="breadcrumb-item active"><a href="../subject/subjectmanage.php">จัดการวิชาในหมวดวิชา</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ตั้งค่าวิชา</li>
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
                        <P>ตั้งค่าวิชา..หมวดวิชา..ในแผนก..</P>
                    </div>
                    <div class="card1-body">

                        <form action="queue/add_queue.php" method="post" onsubmit="return validateForm()">
                            <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->
                            <div class="form-floating mb-3">
                                <label for="subject" class="form-label">ชื่อวิชา</label><code> *แก้ไขชื่อวิชาได้</code>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="subject" value="ตกปลา">
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="classroom" class="form-label">ชื่อชั้นเรียนในแผนกนี้</label>
                                <select class="form-select" name="classroom" id="classroom" aria-label="Floating label select example">
                                    <option value="null" selected="">เลือกชั้นเรียน</option>
                                    <option value="12">ปวช 1 ห้อง 1 1/3</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="building" class="form-label">ชื่ออาคาร</label>
                                <select class="form-select" name="building" id="building" aria-label="Floating label select example">
                                    <option value="null" selected="">เลือกอาคาร</option>
                                    <option value="TC">TC - ?????????????????</option>
                                    <option value="EL">EL - ??????????????</option>
                                    <option value="ME">ME - ????????</option>
                                    <option value="Hgot_Natchapon">Hgot_Natchapon - got</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="building" class="form-label">ห้องในอาคาร</label>
                                <select class="form-select" name="building" id="building" aria-label="Floating label select example">
                                    <option value="null" selected="">เลือกห้องในอาคาร</option>
                                    <option value="TC">TC - ?????????????????</option>
                                    <option value="EL">EL - ??????????????</option>
                                    <option value="ME">ME - ????????</option>
                                    <option value="Hgot_Natchapon">Hgot_Natchapon - got</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">บันทึก</button>
                            <a type="button" href="../subject/subjectmanage.php" class="btn btn-secondary ">กลับ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>