<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['Role'] !== 'Manager') {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];
$database = new SQLite3('../fb_managment_system.db');

$teamQuery = $database->prepare('
    SELECT Team_ID, Team_Name 
    FROM Team 
    WHERE Manager_ID = (
        SELECT User_ID FROM Users WHERE Email_Address = :email
    )');
$teamQuery->bindValue(':email', $email, SQLITE3_TEXT);
$teamResult = $teamQuery->execute();

$teamData = $teamResult->fetchArray(SQLITE3_ASSOC);
$team_id = $teamData['Team_ID'] ?? 0;
$team_name = $teamData['Team_Name'] ?? 'Unknown Team';

$countQuery = $database->prepare('
    SELECT COUNT(*) as match_count 
    FROM Match 
    WHERE (TeamA_ID = :team_id OR TeamB_ID = :team_id)
    AND DATE(Match_Date) >= DATE("now")');
$countQuery->bindValue(':team_id', (int)$team_id, SQLITE3_INTEGER);
$countResult = $countQuery->execute();
$matchCount = $countResult->fetchArray(SQLITE3_ASSOC)['match_count'] ?? 0;

$matchQuery = $database->prepare('
    SELECT 
        t1.Team_Name AS team1, 
        t2.Team_Name AS team2, 
        m.Match_Date,
        CASE 
            WHEN m.TeamA_ID = :team_id THEN "Home" 
            ELSE "Away" 
        END AS match_type
    FROM Match m
    INNER JOIN Team t1 ON m.TeamA_ID = t1.Team_ID
    INNER JOIN Team t2 ON m.TeamB_ID = t2.Team_ID
    WHERE (m.TeamA_ID = :team_id OR m.TeamB_ID = :team_id)
    AND DATE(m.Match_Date) >= DATE("now")
    ORDER BY m.Match_Date ASC');
$matchQuery->bindValue(':team_id', (int)$team_id, SQLITE3_INTEGER);
$results = $matchQuery->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Matches</title>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        .content { padding: 20px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #153C57;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .home-match { background-color: #e8f5e9; }
        .away-match { background-color: #e3f2fd; }
        .match-type { font-weight: bold; }
        .home-match .match-type { color: #2e7d32; }
        .away-match .match-type { color: #1565c0; }
        .no-matches {
            padding: 20px;
            background-color: #f8f9fa;
            border-left: 4px solid #ffc107;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Upcoming Matches</h1>
        </header>

        <h2>Schedule</h2>

        <?php if ($matchCount == 0): ?>
            <div class="no-matches">
                <p>No upcoming matches scheduled for your team.</p>
            </div>
        <?php else: ?>
            <table>
                <tr>
                    <th>Matchup</th>
                    <th>Date</th>
                    <th>Type</th>
                </tr>
                <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): 
                    $isHome = $row['match_type'] == 'Home';
                    $yourTeam = $isHome ? $row['team1'] : $row['team2'];
                    $opponent = $isHome ? $row['team2'] : $row['team1'];
                    $rowClass = $isHome ? 'home-match' : 'away-match';
                ?>
                <tr class="<?= $rowClass ?>">
                    <td><?= htmlspecialchars($yourTeam) ?> vs <?= htmlspecialchars($opponent) ?></td>
                    <td><?= htmlspecialchars($row['Match_Date']) ?></td>
                    <td><span class="match-type"><?= htmlspecialchars($row['match_type']) ?></span></td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>
    </div>
    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>
</body>
</html>
