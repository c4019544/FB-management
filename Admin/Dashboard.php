<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>


<div>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Admin Dashboard</h1>
        </header>
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
</html>