<?php
session_start();

if (!isset($_SESSION['email'])) {
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


// Fetch Team ID for the logged in manager
$teamStmt = $database->prepare("SELECT Team_ID FROM Team 
    WHERE Manager_ID = (SELECT User_ID FROM Users WHERE Email_Address = :email)
");

$teamStmt->bindValue(':email', $email, SQLITE3_TEXT);
$teamResult = $teamStmt->execute();
$teamRow = $teamResult->fetchArray(SQLITE3_ASSOC);

$teamID = $teamRow['Team_ID'] ?? 0;
 
$recentStmt = $database->prepare(" SELECT 
        m.Match_ID,
        ta.Team_Name AS TeamA,
        tb.Team_Name AS TeamB,
        sa.Goals AS TeamA_Goals,
        sb.Goals AS TeamB_Goals,
        m.Match_Date,
        ta.Team_ID as TeamA_ID,
        tb.Team_ID as TeamB_ID
    FROM Match m
    INNER JOIN Team ta ON m.TeamA_ID = ta.Team_ID
    INNER JOIN Team tb ON m.TeamB_ID = tb.Team_ID
    INNER JOIN Match_Stats sa ON sa.Match_ID = m.Match_ID AND sa.Team_ID = ta.Team_ID
    INNER JOIN Match_Stats sb ON sb.Match_ID = m.Match_ID AND sb.Team_ID = tb.Team_ID
    WHERE (m.TeamA_ID = :team_id OR m.TeamB_ID = :team_id)
    AND DATE(m.Match_Date) <= DATE('now')
    ORDER BY m.Match_Date DESC
    LIMIT 5
");
$recentStmt->bindValue(':team_id', $teamID, SQLITE3_INTEGER);
$recentMatches = $recentStmt->execute();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Team Manager</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../TeamManager/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <style>
        .card-section {
            position: relative;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .card {
            background-color: rgb(193, 211, 222);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            min-height: 400px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .first-row card{
            max-height: 500px;
        }
        .upper-left-card {
            padding: 10px;
            margin: 10px;
            min-width: 30%;
        }

        .upper-right-card {
            padding: 10px;
            margin: 10px;
            min-width: 50%;
        }

        .right-card{
            background-color:rgb(52, 93, 121);
            color: white;
        }

        .lower-left-card {
            padding: 10px;
            margin: 10px;
            min-width: 90%;
        }

        .dashboard-chart {
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #team-stats-chart {
            width: 350px !important;
            height: 350px !important;
        }

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

        .recent-matches {
            list-style: none;
            padding: 0;
            margin-top: 10px;
        }

        .recent-matches li {
            background-color: #e0e0e0;
            border-radius: 5px;
            padding: 8px 10px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: black;
        }

        .recent-matches li.win {
            background-color:rgb(180, 225, 190);
        }

        .recent-matches li.loss {
            background-color:rgb(247, 167, 174);
        }

        .recent-matches li.draw {
            background-color: #fff3cd;
        }

        .result-tag {
            font-weight: bold;
            margin-left: 10px;
        }


    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <header>
            <h1>Team Dashboard</h1>
        </header>

        <div class="card-section">
            <div class="row first-row">
                <div class="upper-left-card">
                    <div class="dashboard-chart card">
                        <h2>Team Statistics</h2>
                        <canvas id="team-stats-chart"></canvas>
                    </div>
                </div>

                <div class="upper-right-card">
                    <div class="card right-card">
                        <h2>Recent Match Results</h2>
                        <ul class="recent-matches">
                            <?php while ($match = $recentMatches->fetchArray(SQLITE3_ASSOC)): ?>
                                <?php
                                    $teamA = htmlspecialchars($match['TeamA']);
                                    $teamB = htmlspecialchars($match['TeamB']);
                                    $goalsA = $match['TeamA_Goals'];
                                    $goalsB = $match['TeamB_Goals'];

                                    $isTeamA = ($teamID == $match['TeamA_ID']);
                                    $yourGoals = $isTeamA ? $goalsA : $goalsB;
                                    $opponentGoals = $isTeamA ? $goalsB : $goalsA;

                                    if ($yourGoals > $opponentGoals) {
                                        $resultClass = "win";
                                        $resultText = "Win";
                                    } elseif ($yourGoals < $opponentGoals) {
                                        $resultClass = "loss";
                                        $resultText = "Loss ";
                                    } else {
                                        $resultClass = "draw";
                                        $resultText = "Draw ";
                                    }
                                ?>
                                <li class="<?= $resultClass ?>">
                                    <?= $teamA ?> <?= $goalsA ?> - <?= $goalsB ?> <?= $teamB ?>
                                    <span class="result-tag"><?= $resultText ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>


                </div>
            </div>

            <div class="row">
                <div class="lower-left-card">
                    <div class="dashboard-chart card">
                        <h2>Upcoming Matches</h2>

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
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('../TeamManager/GetTeamStats.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error fetching stats:', data.error);
                    return;
                }

                const ctx = document.getElementById('team-stats-chart').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Goals', 'Yellow Cards', 'Red Cards', 'Penalties', 'Freekicks', 'Corners'],
                        datasets: [{
                            data: [
                                data.Goals,
                                data.YellowCards,
                                data.RedCards,
                                data.Penalties,
                                data.Freekicks,
                                data.Corners
                            ],
                            backgroundColor: [
                                '#00bfff',
                                '#f0e130',
                                '#ff4c4c',
                                '#4caf50',
                                '#ff9800',
                                '#9c27b0'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        }
                    }
                });
            })
            .catch(err => {
                console.error('Fetch error:', err);
            });
    });
    </script>
</body>
</html>
