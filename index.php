<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <!-- นำเข้าไฟล์ CSS ของ Bootstrap Icons ผ่าน CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>RIETC</title>
    <script src="./script.js"></script>
</head>

<body>
    <div class="overlay"></div>
    <?php include_once("./assets/components/header.php"); ?>
    <?php include_once("./assets/components/sidebar.php"); ?>
    <?php include_once("./assets/components/sidebarResponsive.php"); ?>

    <div class="container">
        <h1 style=" margin-bottom: inherit; margin-top: inherit;">Dashboard</h1>
    </div>
    <div class="container">
        <div class="row row-cols-4">

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="card-item">
                            <div class="card-header">
                                <span class="">Building</span>
                            </div>
                            <div class="card-title">
                                <span class="card-text-number">36</span>
                                <span class="card-text"> Buildings</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                        <div class="card-item">
                            <div class="card-header">
                                <span class="">Camera</span>
                            </div>
                            <div class="card-title">
                                <span class="card-text-number">36</span>
                                <span class="card-text"> Devices</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="card-item">
                            <div class="card-header">
                                <span class="">Classroom</span>
                            </div>
                            <div class="card-title">
                                <span class="card-text-number">36</span>
                                <span class="card-text"> Total</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <div class="card-item">
                            <div class="card-header">
                                <span class="">Subject</span>
                            </div>
                            <div class="card-title">
                                <span class="card-text-number">36</span>
                                <span class="card-text"> Total</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h1 style="margin-bottom: inherit;padding-left: 10px;">Camera Active</h1>
            <div class="table-responsive">
                <table class="table text-center align-middle table-hover mb-0">
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
                            <td>ปิด</td>
                        </tr>
                        <tr class="table-active">
                            <td scope="row">001</td>
                            <td>อารามสงฆ์</td>
                            <td>102</td>
                            <td>ปิด</td>
                        </tr>
                        <tr class="table-active">
                            <td scope="row">001</td>
                            <td>อารามสงฆ์</td>
                            <td>102</td>
                            <td>ปิด</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="bg-secondary rounded h-100 p-4">
                    <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id numquam ab cum, a architecto laboriosam doloremque quidem cupiditate modi debitis rerum molestias enim, autem, iusto quis delectus corrupti. Tenetur, eaque.</P>
                    </div>
            </div>
            <div class="col">
                <div class="bg-secondary rounded h-100 p-4">
                    <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id numquam ab cum, a architecto laboriosam doloremque quidem cupiditate modi debitis rerum molestias enim, autem, iusto quis delectus corrupti. Tenetur, eaque.</P>
                    <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id numquam ab cum, a architecto laboriosam doloremque quidem cupiditate modi debitis rerum molestias enim, autem, iusto quis delectus corrupti. Tenetur, eaque.</P>
                </div>
            </div>
            <div class="col">
                <div class="bg-secondary rounded h-100 p-4">
                    <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id numquam ab cum, a architecto laboriosam doloremque quidem cupiditate modi debitis rerum molestias enim, autem, iusto quis delectus corrupti. Tenetur, eaque.</P>
                    <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id numquam ab cum, a architecto laboriosam doloremque quidem cupiditate modi debitis rerum molestias enim, autem, iusto quis delectus corrupti. Tenetur, eaque.</P>
                    <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id numquam ab cum, a architecto laboriosam doloremque quidem cupiditate modi debitis rerum molestias enim, autem, iusto quis delectus corrupti. Tenetur, eaque.</P>
                </div>
            </div>
        </div>
    </div>
</body>

</html>