<?php

include("sidebar2.php");

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $telNo = $_POST['telNo'];
    $role = $_POST['role'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    $db = new SQLite3('../fb_managment_system.db');

    $db->exec("CREATE TABLE IF NOT EXISTS Users (
        User_ID TEXT NOT NULL PRIMARY KEY,
        First_name TEXT NOT NULL,
        Last_name TEXT NOT NULL,
        Dob TEXT NOT NULL,
        Email_Address TEXT NOT NULL,
        TelNo TEXT NOT NULL,
        Role TEXT NOT NULL,
        Gender TEXT NOT NULL,
        Password TEXT NOT NULL
        )");

$stmt = $db->prepare("INSERT OR REPLACE INTO Users (User_ID, First_name, Last_name, Dob, Email_Address, TelNo, Role, Gender, Password)
VALUES (:user_id, :firstName, :lastName, :dob, :email, :telNo, :role, :gender, :password)");
$stmt->bindValue(':user_id', $user_id, SQLITE3_TEXT);
$stmt->bindValue(':firstName', $firstName, SQLITE3_TEXT);
$stmt->bindValue(':lastName', $lastName, SQLITE3_TEXT);
$stmt->bindValue(':dob', $dob, SQLITE3_TEXT);
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$stmt->bindValue(':telNo', $telNo, SQLITE3_TEXT);
$stmt->bindValue(':role', $role, SQLITE3_TEXT);
$stmt->bindValue(':gender', $gender, SQLITE3_TEXT);
$stmt->bindValue(':password', $password, SQLITE3_TEXT);

if ($stmt->execute()) {
    echo"User Created Successfully";
} else{
    echo"Failed To Create New User";
}

$select_query = "SELECT * FROM Users";
$result = $db->query($select_query);
echo'<div class="user-output">';
echo"All Users <br>";
echo"----------------------------------------------------------------------------------------------------<br>";

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo $row['User_ID'] . " " . $row['First_name'] . " " . $row['Last_name'] . " " . $row['Dob'] . " " . $row['Email_Address'] . " " . $row['TelNo'] . " " . $row['Role'] . " " . $row['Gender'] . " " . $row['Password']."<br>";
}
echo"----------------------------------------------------------------------------------------------------<br>";
echo'</div>';
}
$db->close();
?>
