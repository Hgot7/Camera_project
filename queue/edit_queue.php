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
                <!-- <h1>queue</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../queue.php">Queue</a></li>
                        <li class="breadcrumb-item active" aria-current="page">แก้ไขคิวถ่ายรูป</li>
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
                        <P>แก้ไขคิวถ่ายรูป</P>
                    </div>
                    <div class="card1-body">

                        <form action="queue/add_queue.php" method="post" onsubmit="return validateForm()">
                            <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->

                            <div class="form-floating mb-3">
                                <label for="department" class="form-label">แผนก</label>
                                <select class="form-select" name="department" id="department" aria-label="Floating label select example">
                                    <option value="null" selected="">เลือกแผนก</option>
                                    <option value="อุตสาหกรรม">อุตสาหกรรม</option>
                                    <option value="พาณิชยกรรม">พาณิชยกรรม</option>
                                    <option value="การประมง">การประมง</option>
                                    <option value="การบิน">การบิน</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="classroom" class="form-label">ชั้นเรียนในแผนก</label>
                                <select class="form-select" name="classroom" id="classroom" aria-label="Floating label select example">
                                    <option value="null" selected="">ชั้นเรียนในแผนก ถ้าแผนก != none ให้แสดงช่องนี้ js</option>
                                    <option value="12">ปวช 1 ห้อง 1 1/3</option>
                                </select>
                            </div>
                            <label for="building" class="form-label">ชื่ออาคาร/ห้องในอาคาร/กล้อง</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="building" id="building" aria-label="Floating label select example">
                                    <option value="null" selected="">อาคาร</option>
                                    <option value="TC">TC - ?????????????????</option>
                                    <option value="EL">EL - ??????????????</option>
                                    <option value="ME">ME - ????????</option>
                                    <option value="Hgot_Natchapon">Hgot_Natchapon - got</option>
                                </select>
                                <span class="input-group-text">-</span>
                                <select class="form-select" name="room" id="room" aria-label="Floating label select example">
                                    <option value="null" selected="">ห้อง</option>
                                </select>
                                <span class="input-group-text">-</span>
                                <select class="form-select" name="camera" id="camera" aria-label="Floating label select example">
                                    <option value="null" selected="">กล้อง</option>

                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <label for="day" class="form-label">วัน/เวลาถ่ายรูป</label>
                                <div class="input-group">
                                    <select class="form-select" name="day" id="day" aria-label="Floating label select example">
                                        <option value="null" selected="">เลือกวัน</option>
                                        <option value="1">จันทร์</option>
                                        <option value="2">อังคาร</option>
                                        <option value="3">พุธร</option>
                                        <option value="4">พฤหัสบดี</option>
                                        <option value="5">ศุกร์</option>
                                    </select>
                                    <span class="input-group-text">เลือกเวลาเริ่มถ่ายรูป</span>
                                    <input type="time" id="appt" name="time_start" required="">

                                    <span class="input-group-text">เลือกเวลาส่งถ่ายรูป</span>
                                    <input type="time" id="appt" name="time_stop" required="">
                                </div>

                            </div>
                            <button type="submit" class="btn btn-danger">บันทึก</button>
                            <a type="button" href="../queue.php" class="btn btn-secondary ">กลับ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>