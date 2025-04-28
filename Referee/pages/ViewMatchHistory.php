<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}
?>
<?php
include "../db.php"; // adjust path if needed
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['match_id'])) {
    $match_id = $_GET['match_id'];

    // Fetch match results and team names
    $stmt = $pdo->prepare("
        SELECT 
            mr.*, 
            t.Team_name 
        FROM 
            Match_Stats mr
        JOIN 
            Team t ON mr.Team_ID = t.Team_ID
        WHERE 
            mr.Match_ID = :match_id
    ");
    
    $stmt->execute([':match_id' => $match_id]);
    $matchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the result (example format)
    // foreach ($matchResults as $result) {
    //     echo "<h3>Team: " . htmlspecialchars($result['Team_name']) . "</h3>";
    //     echo "<ul>";
    //     echo "<li>Goals: " . $result['Goals'] . "</li>";
    //     echo "<li>Yellow Cards: " . $result['Yellow_Cards'] . "</li>";
    //     echo "<li>Red Cards: " . $result['Red_Cards'] . "</li>";
    //     echo "<li>Penalties: " . $result['Penalties'] . "</li>";
    //     echo "<li>Free Kicks: " . $result['FreeKicks'] . "</li>";
    //     echo "<li>Corners: " . $result['Corners'] . "</li>";
    //     echo "<li>Fouls: " . $result['Fouls'] . "</li>";
    //     echo "</ul><hr>";
    // }
    // exit();
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Match History</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>View Match History</h1>
    </header>
    <div class="card-section">
        <div class="table-container">
            <table class="custom-table history-table">
                <thead>
                    <tr>
                        <th colspan="2"><?= htmlspecialchars($matchResults[0]['Team_name']) ?></th>
                        <th colspan="1"><?= htmlspecialchars($matchResults[0]['Goals']) ?></th>
                        <th colspan="2" class="VS"><div class="vs-background">VS</div></th>
                        <th colspan="2"><?= htmlspecialchars($matchResults[1]['Team_name']) ?></th>
                        <th colspan="1"><?= htmlspecialchars($matchResults[1]['Goals']) ?></th>
                    </tr>   
                    <!-- <tr class="sub-headings">
                        <th>Players</th>
                        <th>Goal</th>
                        <th>Time</th>
                        <th>Red/Yellow Card</th>

                        <th class="border-left-bold">Players</th>
                        <th>Goal</th>
                        <th>Time</th>
                        <th>Red/Yellow Card</th>
                    </tr> -->
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">Red Cards</td>
                        <td colspan="2"><b><?= htmlspecialchars($matchResults[0]['Red_Cards']) ?></b></td>
                        <td colspan="2" class="border-left-bold"></td>
                        <td>Red Cards</td>
                        <td><b><?= htmlspecialchars($matchResults[1]['Red_Cards']) ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">Yellow Cards</td>
                        <td colspan="2"><b><?= htmlspecialchars($matchResults[0]['Yellow_Cards']) ?></b></td>
                        <td colspan="2" class="border-left-bold"></td>
                        <td>Yellow Cards</td>
                        <td><b><?= htmlspecialchars($matchResults[1]['Yellow_Cards']) ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">Panelties</td>
                        <td colspan="2"><b><?= htmlspecialchars($matchResults[0]['Penalties']) ?></b></td>
                        <td colspan="2" class="border-left-bold"></td>
                        <td>Panelties</td>
                        <td><b><?= htmlspecialchars($matchResults[1]['Penalties']) ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">Free Kicks</td>
                        <td colspan="2"><b><?= htmlspecialchars($matchResults[0]['FreeKicks']) ?></b></td>
                        <td colspan="2" class="border-left-bold"></td>
                        <td>Free Kicks</td>
                        <td><b><?= htmlspecialchars($matchResults[1]['FreeKicks']) ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">Corners</td>
                        <td colspan="2"><b><?= htmlspecialchars($matchResults[0]['Corners']) ?></b></td>
                        <td colspan="2" class="border-left-bold"></td>
                        <td>Corners</td>
                        <td><b><?= htmlspecialchars($matchResults[1]['Corners']) ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">Fouls</td>
                        <td colspan="2"><b><?= htmlspecialchars($matchResults[0]['Fouls']) ?></b></td>
                        <td colspan="2" class="border-left-bold"></td>
                        <td>Fouls</td>
                        <td><b><?= htmlspecialchars($matchResults[1]['Fouls']) ?></b></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- <p>Welcome to the Match Management System. - View Match History</p> -->
</div>
</body>
</html>
