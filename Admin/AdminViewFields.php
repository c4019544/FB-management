<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Fields</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("sidebar2.php");
    ?>
    <div class="content">
        <h2 class="centered-header">All Fields</h2>
    

    <div>
        <?php
        $db = new SQLite3('../fb_managment_system.db');
        $select_query = "SELECT * FROM Field";
        $result = $db->query($select_query);

        echo "<table>";
        echo "<tr> <th>Field ID</th> <th>Field Name</th> <th>Field Owner ID</th> <th>Field Capacity</th> <th>Address Line 1</th> <th>City</th> <th>Country</th> <th>Postcode</th> <th>GLT</th> <th>VAR</th> <th>Viewing Screens</th> <th>Press Box</th> <th>Charge Per Hour</th> <th>Action</th> </tr>";

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $id = $row['Field_ID'];
            $fieldName = $row['Field_name'];
            $ownerID = $row['FieldOwner_ID'];
            $capacity = $row['Field_Capacity'];
            $address = $row['Address_Line1'];
            $city = $row['City'];
            $country = $row['Country'];
            $postcode = $row['Postcode'];
            $glt = $row['GLT'];
            $var = $row['VAR'];
            $viewScreens = $row['View_Screens'];
            $pressBox = $row['Press_Box'];
            $chg = $row['Chg_Hour'];

            echo "<tr>
                    <td>$id</td>
                    <td>$fieldName</td>
                    <td>$ownerID</td>
                    <td>$capacity</td>
                    <td>$address</td>
                    <td>$city</td>
                    <td>$country</td>
                    <td>$postcode</td>
                    <td>$glt</td>
                    <td>$var</td>
                    <td>$viewScreens</td>
                    <td>$pressBox</td>
                    <td>$chg</td>
                    <td> <a href='deleteField.php ? fieldID=$id'> Delete </a> </td>
                </tr>";
        }

        echo "</table>";
        $db->close();
        ?>
    </div>
</body>
</html>

