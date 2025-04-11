<?php

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $db = new SQLite3('fb_managment_system.db');


    $stmt = $db->prepare('SELECT * FROM Users WHERE Email_Address = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();


    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user) {
        if ($password === $user['Password']) {

            $_SESSION['email'] = $email;
            $_SESSION['Role'] = $user['Role'];


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