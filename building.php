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
    <script src="./script.js"></script>
</head>

<body>
    <div class="overlay"></div>
    <?php include_once("./assets/components/header.php"); ?>
    <?php include_once("./assets/components/sidebar.php"); ?>
    <?php include_once("./assets/components/sidebarResponsive.php"); ?>

    <div class="container">
        <h1 style=" margin-bottom: inherit; margin-top: inherit;">Building</h1>
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
                            <button type="submit" class="btn btn-danger btn-width">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <P>เพิ่มห้องในอาคาร</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">ตั้งชื่อห้องในอาคาร</label>
                        <form action="building/add_room.php" method="post" onsubmit="return validateForm2();">
                            <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->
                            <div class="form-floating mb-3">
                                <select class="form-select" name="building" id="" aria-label="Floating label select example">
                                    <option value="null" selected="">อาคาร</option>
                                    <option value="TC">TC - ?????????????????</option>
                                    <option value="EL">EL - ??????????????</option>
                                    <option value="ME">ME - ????????</option>
                                    <option value="Hgot_Natchapon">Hgot_Natchapon - got</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="เลขห้อง เช่น 101" name="room_number" autocomplete="off" required="">
                                <span class="input-group-text">-</span>
                                <input type="text" class="form-control" placeholder="ชื่อห้อง" name="room_name" autocomplete="off" required="">
                            </div>
                            <button type="submit" class="btn btn-danger btn-width">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <P>ข้อมูลห้อง</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">เลือกอาคาร</label>
                        <select class="form-select mb-3" name="building" id="building" aria-label="Floating label select example">
                            <option value="null" selected="">อาคาร</option>
                            <option value="TC">TC - ?????????????????</option>
                            <option value="EL">EL - ??????????????</option>
                            <option value="ME">ME - ????????</option>
                            <option value="Hgot_Natchapon">Hgot_Natchapon - got</option>
                        </select>
                        <div class="table-responsive">
                            <table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">อาคาร</th>
                                        <th scope="col">ห้อง</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-active">
                                        <td scope="row">001</td>
                                        <td>อารามสงฆ์</td>
                                        <td>102</td>
                                        <td>
                                            <a class="btn btn-sm btn-danger" href="">ลบ</a>
                                        </td>
                                    </tr>
                                    <tr class="table-active">
                                        <td scope="row">001</td>
                                        <td>อารามสงฆ์</td>
                                        <td>102</td>
                                        <td>
                                            <a class="btn btn-sm btn-danger" href="">ลบ</a>
                                        </td>
                                    </tr>
                                    <tr class="table-active">
                                        <td scope="row">001</td>
                                        <td>อารามสงฆ์</td>
                                        <td>102</td>
                                        <td>
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
</body>

</html>