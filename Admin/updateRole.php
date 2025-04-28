<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_POST['UserID'];
    $newRole = $_POST['newRole'];
    
    if (!empty($userID) && !empty($newRole)) {
        $db = new SQLite3('../fb_managment_system.db');
        $stmt = $db->prepare("UPDATE Users SET Role = :newRole WHERE User_ID = :userID");
        $stmt->bindValue(':newRole', $newRole, SQLITE3_TEXT);
        $stmt->bindValue(':userID', $userID, SQLITE3_TEXT);
        $stmt->execute();
        $stmt->close();
        echo "Role Update Successfully!";
    } else {
        echo "Please Select A User And Enter A New Role";
    }
}
?>