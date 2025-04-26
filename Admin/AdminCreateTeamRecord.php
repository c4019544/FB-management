<?php

include("sidebar2.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamID = $_POST['teamID'];
    $teamName = $_POST['teamName'];
    $city = $_POST['city'];
    $managerID = $_POST['managerID'];

    $db = new SQLite3('../fb_managment_system.db');

    $db->exec("CREATE TABLE IF NOT EXISTS Team (
        Team_ID INTEGER PRIMARY KEY,
        Team_name TEXT NOT NULL,
        City TEXT NOT NULL,
        Manager_ID TEXT NOT NULL,
        FOREIGN KEY (Manager_ID) REFERENCES User(User_ID)
        );");

        $stmt = $db->prepare("INSERT INTO Team (Team_ID, Team_name, City, Manager_ID)
                            VALUES (:teamID, :teamName, :city, :managerID)");
        
        $stmt -> bindValue(':teamID', $teamID, SQLITE3_INTEGER);
        $stmt -> bindValue(':teamName', $teamName, SQLITE3_TEXT);
        $stmt -> bindValue(':city', $city, SQLITE3_TEXT);
        $stmt -> bindValue(':managerID', $managerID, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo "Team Added Successfully";
        } else {
            echo "Failed To Add New Team";
        }

        $db->close();
}
?>