<?php
session_start();


$valid_username = "admin";
$valid_password = "1234";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


if ($username === $valid_username && $password === $valid_password) {

    $_SESSION['username'] = $username;

    // Redirect to the welcome page
    header("Location: welcome.php");
    exit();
} else {
    
    $error = urlencode("Invalid username or password.");
    header("Location: signin_form.html?error=$error");
    exit();
}

