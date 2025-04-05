<?php
// session_start();

// // If user is logged in, redirect to dashboard
// if (isset($_SESSION["user_id"])) {
//     header("Location: dashboard.php");
//     exit();
// } else {
//     // Redirect to login page if not logged in
//     header("Location: login.php");
//     exit();
// }
?>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">  <!-- External CSS -->
    
</head>
<body>
    <div class="match-home">
        <header>
            <h1>Welcome to the Match Management System</h1>
        </header>
        
        <main>
            <?php if (isset($_SESSION["user_id"])): ?>
                <p>You are logged in as <strong><?php echo $_SESSION["username"]; ?></strong></p>
                <a href="pages/Dashboard.php">Go to Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <p>Manage your matches, players, and teams easily.</p>
                <a href="login.php">Login</a>
                <a href="register.php">Sign Up</a>
            <?php endif; ?>
        </main>

        <footer>
            <p>&copy; <?php echo date("Y"); ?> Match Management System</p>
        </footer>
    </div>
</body>
</html>
