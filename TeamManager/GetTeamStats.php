<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];
$database = new SQLite3('../fb_managment_system.db');

$stmt = $database->prepare("SELECT
        SUM(ms.Goals) AS Goals,
        SUM(ms.Yellow_Cards) AS YellowCards,
        SUM(ms.Red_Cards) AS RedCards,
        SUM(ms.Penalties) AS Penalties,
        SUM(ms.Freekicks) AS Freekicks,
        SUM(ms.Corners) AS Corners
    FROM Match_Stats ms
    INNER JOIN Match m ON ms.Match_ID = m.Match_ID
    INNER JOIN Team t ON ms.Team_ID = t.Team_ID
    INNER JOIN Users u ON t.Manager_ID = u.User_ID
    WHERE u.Email_Address = :email
");

$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$results = $stmt->execute();

if (!$results) {
    die("Query failed: " . $database->lastErrorMsg());
}

$row = $results->fetchArray(SQLITE3_ASSOC);

header('Content-Type: application/json');
echo json_encode($row);
?>