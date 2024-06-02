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
                <!-- <h1>Classroom</h1> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../classroom.php">Classroom</a></li>
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มชั้นเรียน</li>
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
                        <P>เพิ่มชั้นเรียน</P>
                    </div>
                    <div class="card1-body">
                        <label class="form-label" for="building">แผนก</label>
                        <form action="classroom/add_classroom.php" method="post">
                            <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->
                            <div class="form-floating mb-3">
                                <select class="form-select" name="department" id="" aria-label="Floating label select example">
                                    <option value="null" selected="">แผนก</option>
                                    <option value="??????">?????? </option>
                                    <option value="??????????????????">?????????????????? </option>
                                    <option value="??????">?????? </option>
                                    <option value="การบิน">การบิน </option>
                                </select>
                            </div>
                            <label class="form-label" for="building">รายละเอียดชั้นปี</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="level" id="level" aria-label="Floating label select example">
                                    <option value="ปวช" selected="">ปวช.</option>
                                    <option value="ปวส">ปวส.</option>
                                </select>
                                <span class="input-group-text">-</span>
                                <select class="form-select" name="sublevel" id="level" aria-label="Floating label select example">
                                    <option value="1" selected="">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <span class="input-group-text">-</span>
                                <input type="text" class="form-control" placeholder="ห้องเช่น 1 1/3 ห้องดอกไม้" name="class" autocomplete="off" required="">

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
                            <label class="form-label" for="building">Line Token</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="line token" name="line_token" autocomplete="off" required="">
                            </div>
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <a type="button" href="../classroom.php" class="btn btn-secondary">กลับ</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="container ">
    </div>
</body>

</html>