<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}
include "../db.php";

// Fetch all incidents along with player name and team name
$query = "
    SELECT 
        i.Match_ID,
        t.Team_name AS team_name,
        u.First_name || ' ' || u.Last_name AS player_name,
        i.Time,
        i.Description
    FROM Incident i
    JOIN Player p ON i.Player_ID = p.Player_ID
    JOIN Team t ON p.Team_ID = t.Team_ID
    JOIN Users u ON p.Player_ID = u.User_ID
    ORDER BY i.Match_ID ASC
";


$stmt = $pdo->prepare($query);
$stmt->execute();
$incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Reports</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>Incident Reports</h1>
    </header>
    <p class="text-center">View Incident Report</p>

    <div class="card-section">
        <div class="table-container">
            <table class="custom-table history-table">
                <thead>
                    <tr>
                        <th>Match ID</th>
                        <th>Team Name</th>
                        <th>Player Name</th>
                        <th>Time</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incidents as $incident): ?>
                        <tr>
                            <td><?= htmlspecialchars($incident['Match_ID']) ?></td>
                            <td><?= htmlspecialchars($incident['team_name']) ?></td>
                            <td><?= htmlspecialchars($incident['player_name']) ?></td>
                            <td><?= htmlspecialchars($incident['Time']) ?></td>
                            <td><?= htmlspecialchars($incident['Description']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($incidents)): ?>
                        <tr><td colspan="5" class="text-center">No incidents found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
