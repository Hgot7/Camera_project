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
    <div class="overlay"></div>
    <?php include_once("./assets/components/header.php"); ?>
    <?php include_once("./assets/components/sidebar.php"); ?>
    <?php include_once("./assets/components/sidebarResponsive.php"); ?>

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
                            <button type="submit" class="btn btn-danger btn-width">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <P>ตั้งค่าตำแหน่งกล้อง</P>
                    </div>
                    <div class="card1-body">
                        <label for="building" class="form-label">อาคาร</label>
                        <form action="camera/setup_camera.php" method="post" onsubmit="return validateForm1();">
                            <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->
                            <div class="form-floating mb-3">
                                <select class="form-select" name="building" id="building" aria-label="Floating label select example">
                                    <option value="null" selected="">เลือกอาคาร</option>
                                    <option value="TC">TC - ?????????????????</option>
                                    <option value="EL">EL - ??????????????</option>
                                    <option value="ME">ME - ????????</option>
                                    <option value="Hgot_Natchapon">Hgot_Natchapon - got</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="room" class="form-label">ห้องเรียน</label>
                                <select class="form-select" name="room" id="room" aria-label="Floating label select example">
                                    <option value="null" selected="">เลือกห้องเรียน</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="camera" class="form-label">กล้อง</label>
                                <select class="form-select" name="camera" id="camera" aria-label="Floating label select example">
                                    <option value="null" selected="">เลือกกล้อง</option>
                                    <option value="1">001</option>
                                    <option value="2">002</option>
                                    <option value="5">005</option>
                                    <option value="7">008</option>
                                    <option value="9">009</option>
                                </select>
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
                        <P>ข้อมูลกล้อง</P>
                    </div>
                    <div class="card1-body">
                        <nav class="mb-2">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link text-success active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Active</button>
                                <button class="nav-link text-danger" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Non Active</button>
                            </div>
                        </nav>
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="table-responsive">
                                <table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                    <thead class="table-thead">
                                        <tr>
                                            <th scope="col">ชื่อกล้อง</th>
                                            <th scope="col">อาคาร</th>
                                            <th scope="col">ห้อง</th>
                                            <th scope="col">ปิดกล้อง</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table1-active">
                                            <td scope="row">001</td>
                                            <td>อารามสงฆ์</td>
                                            <td>102</td>
                                            <td>
                                                <a class="btn btn-sm btn-danger" href="">ปิด</a>
                                            </td>
                                        </tr>
                                        <tr class="table1-active">
                                            <td scope="row">001</td>
                                            <td>อารามสงฆ์</td>
                                            <td>102</td>
                                            <td>
                                                <a class="btn btn-sm btn-danger" href="">ปิด</a>
                                            </td>
                                        </tr>
                                        <tr class="table1-active">
                                            <td scope="row">001</td>
                                            <td>อารามสงฆ์</td>
                                            <td>102</td>
                                            <td>
                                                <a class="btn btn-sm btn-danger" href="">ปิด</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="table-responsive">
                                <table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                    <thead class="table-thead">
                                        <tr>
                                            <th scope="col">ชื่อกล้อง</th>
                                            <th scope="col">อาคาร</th>
                                            <th scope="col">ห้อง</th>
                                            <th scope="col">เปิดกล้อง</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table1-active">
                                            <td scope="row">001</td>
                                            <td>อารามสงฆ์</td>
                                            <td>102</td>
                                            <td>
                                                <a class="btn btn-sm btn-success" href="">เปิด</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-warning" href="">แก้ไข</a>
                                                <a class="btn btn-sm btn-danger" href="">ลบกล้อง</a>
                                            </td>
                                        </tr>
                                        <tr class="table1-active">
                                            <td scope="row">001</td>
                                            <td>อารามสงฆ์</td>
                                            <td>102</td>
                                            <td>
                                                <a class="btn btn-sm btn-success" href="">เปิด</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-warning" href="">แก้ไข</a>
                                                <a class="btn btn-sm btn-danger" href="">ลบกล้อง</a>
                                            </td>
                                        </tr>
                                        <tr class="table1-active">
                                            <td scope="row">001</td>
                                            <td>อารามสงฆ์</td>
                                            <td>102</td>
                                            <td>
                                                <a class="btn btn-sm btn-success" href="">เปิด</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-warning" href="">แก้ไข</a>
                                                <a class="btn btn-sm btn-danger" href="">ลบกล้อง</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-danger btn-width mt-2">ลบกล้องทั้งหมด</button>
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