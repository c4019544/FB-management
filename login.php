<?php

session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Connect to SQLite database
    $db = new SQLite3('fb_managment_system.db');

    // Prepare the SQL query to fetch user data
    $stmt = $db->prepare('SELECT * FROM Users WHERE Email_Address = :email');
    $stmt->bindValue(':email', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Check if the user exists
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user) {
        // User found, verify the password
        if ($password === $user['Password']) {
            // Password is correct, store staff info
            $_SESSION['username'] = $username;
            $_SESSION['Role'] = $user['Role']; // Store the user type in session

            // Redirect based on user type
            if ($user['Role'] === 'Admin') {
                header('Location: Admin/AdminDashboard.php');
            } elseif ($user['Role'] === 'Manager') {
                header('Location: TeamManager/TeamManager.php');
            } elseif ($user['Role'] === 'Referee') {
                header('Location: Referee/pages/Dashboard.php');
            } elseif ($user['Role'] === 'Field Owner') {
                header('Location: FieldOwner/FOwnerDashboard.php');
            } elseif ($user['Role'] === 'Player') {
                echo "<h2>Player page under development</h2>";
            }
            exit();
        } else {
            echo 'Incorrect password.';
        }
    } else {
        echo 'User not found.';
    }
}
?>