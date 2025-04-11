<?php

include ("sidebar2.php");

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $field_id = $_POST['field_id'];
    $fieldName = $_POST['fieldName'];
    $fieldOwner_ID = $_POST['fieldOwner_ID'];
    $capacity = $_POST['capacity'];
    $addressLine1 = $_POST['addressLine1'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $postcode = $_POST['postcode'];
    $glt = $_POST['glt'];
    $var = $_POST['var'];
    $viewScreens = $_POST['viewScreens'];
    $pressBox = $_POST['pressBox'];
    $chgHour = $_POST['chgHour'];

    $db = new SQLite3('../fb_managment_system.db');

    $db->exec("CREATE TABLE IF NOT EXISTS Field(
        Field_ID TEXT NOT NULL PRIMARY KEY,
        Field_name TEXT NOT NULL,
        FieldOwner_ID TEXT NOT NULL,
        Field_Capacity INTEGER NOT NULL,
        Address_Line1 TEXT NOT NULL,
        City TEXT NOT NULL,
        Country TEXT NOT NULL,
        Postcode TEXT NOT NULL,
        GLT TEXT NOT NULL,
        VAR TEXT NOT NULL,
        View_Screens INTEGER NOT NULL,
        Press_Box TEXT,
        Chg_Hour REAL(2) NOT NULL,
        FOREIGN KEY (FieldOwner_ID) REFERENCES User(User_ID)
        );");

$stmt = $db->prepare("INSERT OR REPLACE INTO Field (Field_ID, Field_name, FieldOwner_ID, Field_Capacity, Address_Line1, City, Country, Postcode, GLT, VAR, View_Screens, Press_Box, Chg_Hour)
VALUES (:field_id, :fieldName, :fieldOwner_ID, :capacity, :addressLine1, :city, :country, :postcode, :glt, :var, :viewScreens, :pressBox, :chgHour)");
$stmt->bindValue(':field_id', $field_id, SQLITE3_TEXT);
$stmt->bindValue(':fieldName', $fieldName, SQLITE3_TEXT);
$stmt->bindValue(':fieldOwner_ID', $fieldOwner_ID, SQLITE3_TEXT);
$stmt->bindValue(':capacity', $capacity, SQLITE3_INTEGER);
$stmt->bindValue(':addressLine1', $addressLine1, SQLITE3_TEXT);
$stmt->bindValue(':city', $city, SQLITE3_TEXT);
$stmt->bindValue(':country', $country, SQLITE3_TEXT);
$stmt->bindValue(':postcode', $postcode, SQLITE3_TEXT);
$stmt->bindValue(':glt', $glt, SQLITE3_TEXT);
$stmt->bindValue(':var', $var, SQLITE3_TEXT);
$stmt->bindValue(':viewScreens', $viewScreens, SQLITE3_INTEGER);
$stmt->bindValue(':pressBox', $pressBox, SQLITE3_TEXT);
$stmt->bindValue(':chgHour', $chgHour, SQLITE3_FLOAT);

if ($stmt->execute()) {
    echo"Field Added Successfully";
} else{
    echo"Failed To Add New Field";
}

$select_query = "SELECT * FROM Field";
$result = $db->query($select_query);
echo'<div class="user-output">';
echo"All Fields <br>";
echo"----------------------------------------------------------------------------------------------------<br>";

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo $row['Field_ID'] . " " . $row['Field_name'] . " " . $row['FieldOwner_ID'] . " " . $row['Field_Capacity'] . " " . $row['Address_Line1'] . " " . $row['City'] . " " . $row['Country'] . " " . $row['Postcode'] . " " . $row['GLT']. " " . $row['VAR']. " " . $row['View_Screens']. " " . $row['Press_Box']. " " . $row['Chg_Hour']."<br>";
}
echo"----------------------------------------------------------------------------------------------------<br>";
echo'</div>';
}
$db->close();
?>