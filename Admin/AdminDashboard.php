<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
    <?php
        include("sidebar2.php");    
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
    </div>
    <div class="table-conatiner">
        <table>
            <tr>
                <th>Active Users</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars(string: $row['total_users']); ?></td>
            </tr>
        </table>
    </div>
    </body>

    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    height: 100vh;
    }

    .sidebar {
    width: 250px;
    background-color: #153C57;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    padding-top: 20px;
    padding-left: 10px;
    }

    .sidebar h2 {
    color: #ecf0f1;
    font-size: 24px;
    margin-bottom: 30px;
    }

    .sidebar ul {
    list-style: none;
    padding: 0;
    }

    .sidebar ul li {
    padding: 15px;
    text-align: left;
    margin: 10px 0;
    border-radius: 5px;
    cursor: pointer;
    }    

.sidebar ul li:hover {
    background-color: rgb(32, 88, 129);
}

.content {
    margin-left: 250px;
    padding: 20px;
    width: 100%;
}

.content header {
    background-color: #ecf0f1;
    padding: 20px;
    text-align: center;
    margin-bottom: 20px;
}

.content header h1 {
    margin: 0;
}

a {
    color: white;
    text-decoration: none;
}

.table-container {
    margin-left: 270px;
    padding: 20px;
    width: calc(100% - 270px);
}

table {
    width : 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
}
</style>
</html>
