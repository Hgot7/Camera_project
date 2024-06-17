<?php
session_start();

include_once('./class/user.php');

// Initialize User class
$user = new User($conn);

if (isset($_POST['register'])) {
    // Retrieve form input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $fullname = trim($_POST['fullname']);
    $password = trim($_POST['password']);

    // Validate form input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header('Location: ./index.php');
        exit;
    }

    // Register the user
    if ($user->register($username, $password, '$email', '$fullname', 'admin')) {
        $_SESSION['success'] = "Registration successful! You can now login.";
        header('Location: ./index.php');
        exit;
    } else {
        $_SESSION['error'] = "Registration failed. Username or email might already be taken.";
        header('Location: ./index.php');
        exit;
    }
}
