<?php

include ("sidebar2.php");

$userIDParam=isset($_GET['fieldID']) ? $_GET['fieldID'] :'';

$db = new SQLite3('../fb_managment_system.db');

$stmt = $db->prepare("DELETE FROM Field WHERE Field_ID = :fieldID");
$stmt->bindValue(':fieldID', $userIDParam, SQLITE3_TEXT);
if ($stmt->execute()) {
    echo "Field Deleted";
} else {
    echo "Failed To Delete Field";
}
$db->close();
?>