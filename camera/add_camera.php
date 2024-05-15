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
        <h1>Camera</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <P>เพิ่มกล้องในอาคาร</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">อาคาร</label>
                        <form action="camera/add_camera.php" method="post" onsubmit="return validateForm2();">
                            <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->
                            <div class="form-floating mb-3">
                                <select class="form-select" name="building" id="building2" aria-label="Floating label select example">
                                    <option value="null" selected="">เลือกอาคาร</option>
                                    <option value="TC">TC - ?????????????????</option>
                                    <option value="EL">EL - ??????????????</option>
                                    <option value="ME">ME - ????????</option>
                                    <option value="Hgot_Natchapon">Hgot_Natchapon - got</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="room" class="form-label">ห้องเรียน</label>
                                <select class="form-select" name="room" id="room2" aria-label="Floating label select example">
                                    <option value="null" selected="">เลือกห้องเรียน</option>
                                </select>

                            </div>

                            <div class="form-floating mb-3">
                                <label class="form-label">ชื่อกล้อง</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="camera_name" name="camera_name" autocomplete="off" required="" placeholder="ตั้งชื่อกล้อง">
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="room" class="form-label">สถานะกล้อง</label>
                                <select class="form-select" name="room" id="room2" aria-label="Floating label select example">
                                    <option value="null" selected="">ปิด</option>
                                    <option value="1">เปิด</option>
                                </select>

                            </div>
                            <button type="submit" class="btn btn-danger">บันทึก</button>
                            <a type="button" href="../camera.php" class="btn btn-secondary ">กลับ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>