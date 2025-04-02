<?php
session_start();
if (!isset($_SESSION['user_id'])) {
header("Location: ../login.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Disciplinary Action</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>Disciplinary Action</h1>
    </header>
    <p>Welcome to the FB Management System. - Disciplinary Action</p>
</div>
</body>
</html>
