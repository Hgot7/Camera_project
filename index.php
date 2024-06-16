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

<body style="background-image: url(./assets/images/bg.jpg);" class="d-flex align-items-center">
    <div class="overlay"></div>
    </div>
    <main class="form-signin w-100 m-auto">
        <form action="signin.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Please Login</h1>
            <div class="form-floating1">
                <input type="text" name="inputusername" class="form-control" id="floatingInput" value="admin" placeholder="">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating1 mt-2">
                <input type="password" name="inputpassword" class="form-control" id="floatingPassword" value="admin_63" placeholder="">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-check1 text-start my-3 mb-2">
                <input class="form-check-input1" type="checkbox" name="remember" checked="" id="flexCheckDefault">
                <label class="form-check-label rememberme" for="flexCheckDefault">
                    Remember me
                </label>
            </div>

            <button class="btn btn-primary btn-width" name="signin" type="submit">Login</button>

            <p class="text-muted">©Rayong Technical</p>
        </form>
    </main>


</body>

</html>