<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Settings</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>Settings</h1>
    </header>
    <p>Welcome to the Football Management System. - Settings</p>
</div>
</body>
</html>
