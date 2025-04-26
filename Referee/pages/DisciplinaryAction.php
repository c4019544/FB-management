<?php
<<<<<<< HEAD
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}
include "../db.php";

// Fetch all disciplinary actions along with player name and team name
$query = "
    SELECT 
        d.Match_ID,
        t.Team_name AS team_name,
        u.First_name || ' ' || u.Last_name AS player_name,
        d.Disciplinary_action,
        d.Incident_ID,
        d.Action_ID
    FROM Disciplinary_action d
    JOIN Player p ON d.Player_ID = p.Player_ID
    JOIN Team t ON p.Team_ID = t.Team_ID
    JOIN Users u ON p.Player_ID = u.User_ID
    ORDER BY d.Match_ID ASC
";


$stmt = $pdo->prepare($query);
$stmt->execute();
$actions = $stmt->fetchAll(PDO::FETCH_ASSOC);
=======
// session_start();
// if (!isset($_SESSION['user_id'])) {
// header("Location: ../login.php");
// exit();
// }
>>>>>>> jamie
?>
<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinary Action</title>
    <link rel="stylesheet" href="../assets/css/style.css">
=======
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Disciplinary Action</title>
<link rel="stylesheet" href="../assets/css/style.css">
>>>>>>> jamie
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>Disciplinary Action</h1>
    </header>
<<<<<<< HEAD
    <p class="text-center">View Disciplinary Action</p>

    <div class="card-section">
        <div class="table-container">
            <table class="custom-table history-table">
                <thead>
                    <tr>
                        <th>Action ID</th>
                        <th>Match ID</th>
                        <th>Incident ID</th>
                        <th>Team Name</th>
                        <th>Player Name</th>
                        <th>Disciplinary Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actions as $action): ?>
                        <tr>
                            <td><?= htmlspecialchars($action['Action_ID']) ?></td>
                            <td><?= htmlspecialchars($action['Match_ID']) ?></td>
                            <td><?= htmlspecialchars($action['Incident_ID']) ?></td>
                            <td><?= htmlspecialchars($action['team_name']) ?></td>
                            <td><?= htmlspecialchars($action['player_name']) ?></td>
                            <td><?= htmlspecialchars($action['Disciplinary_action']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($actions)): ?>
                        <tr><td colspan="5" class="text-center">No actions found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
=======
    <p>Welcome to the Football Management System. - Disciplinary Action</p>
>>>>>>> jamie
</div>
</body>
</html>
