<?php
// include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    echo "DB is not connected yet";
    $_SESSION["user_id"] = 1;
    $_SESSION["username"] = 'referee';
            
    header("Location: pages/Dashboard.php");
    // $query = "SELECT * FROM users WHERE username = ?";
    // $stmt = $conn->prepare($query);
    // $stmt->bind_param("s", $username);
    // $stmt->execute();
    // $result = $stmt->get_result();

    // if ($row = $result->fetch_assoc()) {
    //     if (password_verify($password, $row["password"])) {
    //         $_SESSION["user_id"] = $row["id"];
    //         $_SESSION["username"] = $row["username"];
    //         header("Location: pages/Dashboard.php");
    //     } else {
    //         echo "Invalid password.";
    //     }
    // } else {
    //     echo "No user found.";
    // }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #153C57;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

    </style>
</head>
<body>
    <form method="POST" class="login-signup">
        <h2>Login</h2>
        <label>Username:</label>
        <input type="text" name="username" placeholder="Username" required>
        <label>Password:</label>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</body>
</html>
