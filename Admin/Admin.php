<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
    <?php
        include("sidebar.php");    
    ?>
    <div>
        <h2 class="centered-header">Admin Dashboard</h2>
    </div>

    <div>
        <?php
        $db = new SQLite3('C:\Users\jamie\OneDrive\Documents\xampp\htdocs\FB-management\fb_managment_system.db');
        $query = "SELECT COUNT (*) as total_users FROM Users";
        $result = $db->querySingle($query, true);
        
        if ($result) {
            echo "Total Users: " . $result['total_users'];
        } else {
            echo "error";
        }
        $db->close();
        ?>