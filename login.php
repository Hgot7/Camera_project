<?php
session_start();

include_once('./class/user.php');

// Initialize User class
$user = new User($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin'])) {
    // Retrieve form input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    // Validate form input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header('Location: ./index.php');
        exit;
    }

    // Authenticate the user
    if ($user->login($username, $password, $remember)) {
        $_SESSION['success'] = "Login successful!";
        header('Location: dashboard.php'); // Redirect to dashboard or any other page
        exit;
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header('Location: ./index.php');
        exit;
    }
}
