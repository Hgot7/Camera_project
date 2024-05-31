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
        <h1>Queue</h1>
    </div>
    <div class="container ">
        <div class="row">
            <div class="col">
                <div class="card1">
                    <div class="card1-header">
                        <div class="col mb-0">
                            <p style="align-content: center;margin: 0px 0px 0px 0px;">รายการคิวถ่ายรูป</p>
                            <div class="form-floating" style="display:flex;flex-direction:row;margin-top:10px">
                                <a href="./queue/add_queue.php" class="btn btn-success" style="margin-right:1px;">เพิ่มคิวถ่ายรูป</a>
                            </div>
                        </div>
                    </div>
                    <div class="card1-body">
                        <div class="table-responsive">
                            <table class="table text-center align-middle table-hover mb-0" style="padding: 0px; table-layout: auto !important;">
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">หมวด</th>
                                        <th scope="col">วิชา</th>
                                        <th scope="col">วัน</th>
                                        <th scope="col">เริ่มถ่าย</th>
                                        <th scope="col">ส่งรูป</th>
                                        <th scope="col">อาคาร</th>
                                        <th scope="col">ห้อง</th>
                                        <th scope="col">กล้อง</th>
                                        <th scope="col">แผนก</th>
                                        <th scope="col">ห้อง</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table1-active">
                                        <td>22</td>
                                        <td>?????????</td>
                                        <td>??????</td>
                                        <td>5</td>
                                        <td>13:37:00</td>
                                        <td>15:41:00</td>
                                        <td>TC</td>
                                        <td>102</td>
                                        <td>001</td>
                                        <td>??????</td>
                                        <td>11</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="./queue/edit_queue.php">แก้ไข</a>
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