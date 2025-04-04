<?php
$database = new SQLite3('C:\xampp\htdocs\Group\FB-management\FB-management-1\fb_managment_system.db');

$query = "SELECT  t1.team_name AS team1, t2.team_name AS team2, m.Match_Date 
          FROM match m
          JOIN team t1 ON m.TeamA_ID = t1.team_id
          JOIN team t2 ON m.TeamB_ID = t2.team_id
          WHERE m.Match_Date >= DATE('now') 
          ORDER BY m.Match_Date ASC";
$results = $database->query($query);

if (!$results) {
    die("Query failed: " . $database->lastErrorMsg());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Calendar</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #153C57;
            color: white;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Match Calendar</h1>
        </header>
        <h2>Upcoming Matches</h2>
        <table>
            <tr>
                <th>Teams</th>
                <th>Date</th>
            </tr>
            <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['team1']) . " vs " . htmlspecialchars($row['team2']); ?></td>
                <td><?php echo htmlspecialchars($row['Match_Date']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>