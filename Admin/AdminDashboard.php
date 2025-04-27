<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
<div class="content">
        <header>
            <h1>Dashboard</h1>
        </header>

    <?php
        include("sidebar2.php");    
    ?>

    <div class="active_users">
        <?php
        $db = new SQLite3('../fb_managment_system.db');
        $query = "SELECT COUNT (*) as total_users FROM Users";
        $result = $db->querySingle($query, true);
        
        if ($result) {
            echo "Active Users: " . $result['total_users'];
        } else {
            echo "error";
        }
        $db->close();
        ?>
    </div>

    <div>
        <?php
        $db2 = new SQLite3('../fb_managment_system.db');
        $query2 = "SELECT COUNT (*) as total_teams FROM Team";
        $result2 = $db2->querySingle($query2, true);

        if ($result2) {
            echo "Total Teams: " . $result2['total_teams'];
        } else {
            echo "error";
        }
        $db2->close();
        ?>
    </div>

    <div>
        <?php
        $db3 = new SQLite3('../fb_managment_system.db');
        $query3 = "SELECT t1.team_name AS home_team, t2.team_name AS away_team, f.date From Fixtures f
                            JOIN Team t1 ON f.home_team_id = t1.Team_ID
                            Join Team t2 ON f.away_team_id = t2.Team_ID
                            ORDER BY f.date ASC";
        $result3 = $db3->query($query3);

        if ($result3) {
            echo"<h2>Upcoming Fixtures</h2>";
            echo"<table border='1'>";
            echo"<tr><th>Teams</th><th>Match Date</th></tr>";

            while ($row = $result3->fetchArray(SQLITE3_ASSOC)) {
                $teams = $row['home_team'] . " vs " . $row['away_team'];

                echo"<tr>";
                echo"<td>" . $teams . "</td>";
                echo"<td>" . $row['date'] . "</td>";
                echo"</tr>";
            }

            echo"</table>";
        } else {
            echo"No Fixtures Found";
        }

        $db3->close();
        ?>
    </div>
    
    <div>
        <a href="AdminCreateUserPage.php">
            <button>Add New User</button>
        </a>
    </div>

    <div>
        <a href="AdminCreateFieldPage.php">
            <button>Add New Field</button>
        </a>
    </div>

    <div>
        <a href="AdminCreateTeamPage.php">
            <button>Add New Team</button>
        </a>
    </div>

</div>

