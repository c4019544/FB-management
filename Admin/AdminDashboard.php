<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
<div class="content">
        <header>
            <h1>Dashboard</h1>
        </header>
    </div>
    <?php
        include("sidebar2.php");    
    ?>

    <div>
        <?php
        $db = new SQLite3('C:\Users\jamie\OneDrive\Documents\xampp\htdocs\FB-management\fb_managment_system.db');
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
        $db2 = new SQLite3('C:\Users\jamie\OneDrive\Documents\xampp\htdocs\FB-management\fb_managment_system.db');
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
