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
        <h1>Building</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <P>ข้อมูลห้องเรียนในอาคาร</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">ห้องเรียนในอาคาร</label>
                        <div class="col mb-2">
                            <select class="form-select" name="building" id="building" aria-label="Floating label select example">
                                <option value="null" selected="">เลือกอาคาร</option>
                                <option value="TC">TC - ?????????????????</option>
                                <option value="EL">EL - ??????????????</option>
                                <option value="ME">ME - ????????</option>
                                <option value="Hgot_Natchapon">Hgot_Natchapon - got</option>
                            </select>
                            <div class="form-floating" style="display:flex;flex-direction:row;margin-top:initial">
                                <a href="./building/buildingmanage.php" class="btn btn-primary">จัดการอาคาร</a>
                                <a href="./building/add_room.php" class="btn btn-success" style="margin-right:1px;">เพิ่มห้องเรียนในอาคาร</a>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col">เลขห้อง</th>
                                        <th scope="col">ชื่อห้อง</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table1-active">
                                        <td scope="row">001</td>
                                        <td>อารามสงฆ์</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="">แก้ไข</a>
                                            <a class="btn btn-sm btn-danger" href="">ลบ</a>
                                        </td>
                                    </tr>
                                    <tr class="table1-active">
                                        <td scope="row">001</td>
                                        <td>อารามสงฆ์</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="">แก้ไข</a>
                                            <a class="btn btn-sm btn-danger" href="">ลบ</a>
                                        </td>
                                    </tr>
                                    <tr class="table1-active">
                                        <td scope="row">001</td>
                                        <td>อารามสงฆ์</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="">แก้ไข</a>
                                            <a class="btn btn-sm btn-danger" href="">ลบ</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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