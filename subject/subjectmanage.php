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
                        <div class="col mb-0">
                            <p style="align-content: center;margin: 0px 0px 0px 0px;">จัดการหมวดวิชา</p>
                            <div class="form-floating" style="display:flex;flex-direction:row;margin-top:10px">
                                <!-- <a href="./classroom/add_classroom.php" class="btn btn-primary" style="margin-right: 0 !important;">เพิ่มแผนก</a> -->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-right: 1px !important;">
                                    เพิ่มหมวดวิชา
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title" id="staticBackdropLabel">ตั้งชื่อหมวดวิชา</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="classroom/add_department.php" method="post" onsubmit="return validateForm2();">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="ชื่อหมวดวิชา" name="name" autocomplete="off" required="">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" style="margin-right: 5px;">บันทึก</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card1-body">
                        <div class="table-responsive">
                            <table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col">ชื่อหมวดวิชา</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table1-active">
                                        <td scope="row">วิชาประมง</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="">แก้ไข</a>
                                            <a class="btn btn-sm btn-danger" href="">ลบ</a>
                                        </td>
                                    </tr>
                                    <tr class="table1-active">
                                        <td scope="row">วิชาประมง</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="">แก้ไข</a>
                                            <a class="btn btn-sm btn-danger" href="">ลบ</a>
                                        </td>
                                    </tr>
                                    <tr class="table1-active">
                                        <td scope="row">วิชาประมง</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="">แก้ไข</a>
                                            <a class="btn btn-sm btn-danger" href="">ลบ</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="card1">
            <div class="card1-body">
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a type="button" href="../subject.php" class="btn btn-secondary ">กลับ</a>
            </div>
        </div>

    </div>
</body>

</html>