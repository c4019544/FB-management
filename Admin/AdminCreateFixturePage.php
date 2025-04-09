<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("sidebar2.php");
    ?>
    <div> <h2 class="centered_header">Create New Fixture</h2></div>

    <div class="main">
        <form action="AdminCreateFixtureRecord.php" method="post">
            <input type="text" id="fixtureDate" placeholder="Fixture Date" required>

            <?php $db = new SQLite3('../fb_managment_system.db');
            $query = "SELECT Team_name FROM Team";
            $result = $db->query($query);

            echo '<select name="team1Name" id="team1Name">';
            echo '<option value="">Team 1 Name</option>';

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                echo '<option>' . $row['Team_name'] . '</option>';
            }

            echo'</select>';
            $db->close();
            ?>

            <?php $db = new SQLite3('../fb_managment_system.db');
            $query = "SELECT Team_name FROM Team";
            $result = $db->query($query);

            echo '<select name="team2Name" id="team2Name">';
            echo '<option value="">Team 2 Name</option>';

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                echo '<option>' . $row['Team_name'] . '</option>';
            }

            echo'</select>';
            $db->close();
            ?>

            <button type="submit">Create Fixture</button>
        </form>
    </div>
</body>
</html>