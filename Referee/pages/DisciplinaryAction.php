<?php
// session_start();
// if (!isset($_SESSION['user_id'])) {
// header("Location: ../login.php");
// exit();
// }
?>

<?php
$database = new SQLite3('C:\xampp\htdocs\FB-management\fb_managment_system.db');

$query = "SELECT Message_ID, Sender_ID, Receiver_ID, Date_Time, Text_Message FROM Message ORDER BY Date_Time DESC";
$results = $database->query($query);

if (!$results) {
    die("Query failed: " . $database->lastErrorMsg());
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Disciplinary Action</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>Disciplinary Action</h1>
    </header>
    <p>Welcome to the Football Management System. - Disciplinary Action</p>
</div>
</body>
</html>
