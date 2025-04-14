<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];

$database = new SQLite3('../fb_managment_system.db');

$stmt = $database->prepare('SELECT 
    t1.Team_Name AS team1, t2.Team_Name AS team2, m.Match_Date
    FROM Match m
    INNER JOIN Team t1 ON m.TeamA_ID = t1.Team_ID
    INNER JOIN Team t2 ON m.TeamB_ID = t2.Team_ID
    INNER JOIN Users u ON (t1.Manager_ID = u.User_ID OR t2.Manager_ID = u.User_ID)
    WHERE m.Match_Date >= DATE("now") AND u.Email_Address = :email
    ORDER BY m.Match_Date ASC');

$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$results = $stmt->execute();

if (!$results) {
    die("Query failed: " . $database->lastErrorMsg());
}

$events = [];

while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $events[] = [
        'title' => $row['team1'] . " vs " . $row['team2'],
        'start' => $row['Match_Date']
    ];
}

echo json_encode($events);
?>
