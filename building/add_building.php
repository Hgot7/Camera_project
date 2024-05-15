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
        <h1>Building</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <P>เพิ่มอาคาร</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">ตั้งชื่ออาคาร</label>
                        <form action="building/add_building.php" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="ตัวย่ออาคาร เช่น EL" name="name" autocomplete="off" required="">
                                <span class="input-group-text">-</span>
                                <input type="text" class="form-control" placeholder="ชื่ออาคาร" name="building_name" autocomplete="off" required="">
                            </div>
                            <button type="submit" class="btn btn-danger">บันทึก</button>
                            <a type="button" href="../building.php" class="btn btn-secondary ">กลับ</a>
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