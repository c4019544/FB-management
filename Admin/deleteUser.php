<?php

include ("sidebar2.php");

$userIDParam=isset($_GET['userID']) ? $_GET['userID'] :'';

$db = new SQLite3('../fb_managment_system.db');

$stmt = $db->prepare("DELETE FROM Users WHERE User_ID = :userID");
$stmt->bindValue(':userID', $userIDParam, SQLITE3_TEXT);
if ($stmt->execute()) {
    echo "User Deleted";
} else {
    echo "Failed To Delete User";
}
$db->close();
?>