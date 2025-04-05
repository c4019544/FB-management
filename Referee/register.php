<?php
// include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];

    echo "Registration successful! <a href='/login.php'>Login here</a>";
    echo "DB is not connected yet";

    // $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    // $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    // $stmt = $conn->prepare($query);
    // $stmt->bind_param("sss", $username, $email, $password);
    
    // if ($stmt->execute()) {
    //     echo "Registration successful! <a href='/login.php'>Login here</a>";
    // } else {
    //     echo "Error: " . $stmt->error;
    // }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
        <h2>Register</h2>
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Email:</label>
        <input type="email" name="email" placeholder="Email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>
