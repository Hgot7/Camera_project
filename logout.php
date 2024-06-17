<?php
session_start();

include_once('./class/user.php');
// Initialize User class
$user = new User($conn);

// If the user is logged in and has a remember token, clear it
if (isset($_SESSION['user_id'])) {
    $user->clearRememberToken($_SESSION['user_id']);
}

// Destroy the session
session_unset();
session_destroy();

// Clear the remember me cookie
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, "/"); // Expire the cookie
}

// Redirect to login page
header('Location: ./index.php');
exit;
