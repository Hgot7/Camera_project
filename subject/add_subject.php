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
        <h1>Subject</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <P>เพิ่มวิชาในหมวดวิชา</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">หมวดวิชา</label>
                        <form action="building/add_room.php" method="post" onsubmit="return validateForm2();">
                            <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->
                            <div class="form-floating mb-3">
                                <select class="form-select" name="group" id="" aria-label="Floating label select example">
                                    <option value="" selected="">เลือกหมวดวิชา</option>
                                    <option value="วิชาอุตสาหกรรม">วิชาอุตสาหกรรม</option>
                                    <option value="วิชาอุตสาหกรรม">วิชาสามัญ</option>
                                    <option value="วิชาพาณิชยกรรม">วิชาพาณิชยกรรม</option>
                                    <option value="วิชาศิลปกรรม">วิชาศิลปกรรม</option>
                                    <option value="วิชาคหกรรม">วิชาคหกรรม</option>
                                    <option value="วิชาเกษตรกรรม">วิชาเกษตรกรรม</option>
                                    <option value="วิชาประมง">วิชาประมง</option>
                                    <option value="วิชาอุตสาหกรรมท่องเที่ยว">วิชาอุตสาหกรรมท่องเที่ยว</option>
                                    <option value="อุตสาหกรรมสิ่งทอ">อุตสาหกรรมสิ่งทอ</option>
                                    <option value="วิชาเทคโนโลยีสารสนเทศและการสื่อสาร">
                                        วิชาเทคโนโลยีสารสนเทศและการสื่อสาร</option>
                                    <option value="วิชาอุตสาหกรรมบันเทิงและดนตรี">วิชาอุตสาหกรรมบันเทิงและดนตรี
                                    </option>
                                    <option value="วิชาเกษตรกรรม">วิชาเกษตรกรรม</option>
                                </select>
                            </div>
                            <label for="building" class="form-label">ตั้งชื่อวิชา</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="ชื่อวิชา" name="room_number" autocomplete="off" required="">
                            </div>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
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