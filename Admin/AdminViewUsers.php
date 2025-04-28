<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("sidebar2.php");
    ?>
    <div class="content">
        <h2 class="centered-header">All Users</h2>
    

    <div>
        <?php
        $db = new SQLite3('../fb_managment_system.db');
        $select_query = "SELECT * FROM Users";
        $result = $db->query($select_query);

        echo "<table>";
        echo "<tr> <th>User ID</th> <th>First Name</th> <th>Last Name</th> <th>DOB</th> <th>Email Address</th> <th>TelNo</th> <th>Role</th> <th>Gender</th> <th>Default Passsword</th> <th>Action</th> </tr>";

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $id = $row['User_ID'];
            $fname = $row['First_name'];
            $lname = $row['Last_name'];
            $dob = $row['Dob'];
            $email = $row['Email_Address'];
            $telno = $row['TelNo'];
            $role = $row['Role'];
            $gender = $row['Gender'];
            $password = $row['Password'];

            echo "<tr>
                    <td>$id</td>
                    <td>$fname</td>
                    <td>$lname</td>
                    <td>$dob</td>
                    <td>$email</td>
                    <td>$telno</td>
                    <td>$role</td>
                    <td>$gender</td>
                    <td>$password</td>
                    <td> <a href='deleteUser.php ? userID=$id'> Delete </a> </td>
                </tr>";
        }

        echo "</table>";
        $db->close();
        ?>
    </div>
</body>
</html>

