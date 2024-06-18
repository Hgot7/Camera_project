<?php
session_start();
include_once('./class/user.php');

// Initialize User class
$user = new User($conn);

// Check if the remember me cookie is set and valid
if ($user->checkRememberMe()) {
    header('Location: dashboard.php');
    exit;
}
?>

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
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert" style="width: -webkit-fill-available;margin: initial;">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?></div>
        <?php  } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert" style="width: -webkit-fill-available;margin: initial;">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?></div>
        <?php  } ?>
        <form action="./login.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Please Login</h1>
            <div class="form-floating1">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating1 mt-2">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-check1 text-start my-3 mb-2">
                <input class="form-check-input1" type="checkbox" name="remember" id="flexCheckDefault">
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