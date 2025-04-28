<?php

include ("sidebar2.php");

$userIDParam=isset($_GET['teamID']) ? $_GET['teamID'] :'';

$db = new SQLite3('../fb_managment_system.db');

$stmt = $db->prepare("DELETE FROM Team WHERE Team_ID = :teamID");
$stmt->bindValue(':teamID', $userIDParam, SQLITE3_INTEGER);
if ($stmt->execute()) {
    echo "Team Deleted";
} else {
    echo "Failed To Delete Team";
}
$db->close();
?>