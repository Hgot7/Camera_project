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
        <h1>Camera</h1>
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
                            <a href="./camera/add_camera.php" class="btn btn-success">เพิ่มกล้องในอาคาร</a>
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
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
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
                                                <a class="btn btn-sm btn-warning" href="./camera/edit_camera.php">ตั้งค่า</a>
                                                <a class="btn btn-sm btn-danger" href="">ลบ</a>
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
                                                <a class="btn btn-sm btn-warning" href="">ตั้งค่า</a>
                                                <a class="btn btn-sm btn-danger" href="">ลบ</a>
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
                                                <a class="btn btn-sm btn-warning" href="">ตั้งค่า</a>
                                                <a class="btn btn-sm btn-danger" href="">ลบ</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-danger btn-width mt-2">ลบทั้งหมด</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container"></div>
</body>

</html>