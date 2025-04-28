<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['Role'] !== 'Manager') {
    header("Location: login.php");
    exit();
}

$manager_id = $_SESSION['user_id'] ?? '';
$database = new SQLite3('../fb_managment_system.db');

$team_id = $database->querySingle("SELECT Team_ID FROM Team WHERE Manager_ID = '".SQLite3::escapeString($manager_id)."'");

$players = [];
if ($team_id) {
    $stmt = $database->prepare("
        SELECT p.Player_ID, u.First_name, u.Last_name, p.Position 
        FROM Player p
        JOIN Users u ON p.Player_ID = u.User_ID
        WHERE p.Team_ID = :team_id
        ORDER BY u.Last_name ASC
    ");
    $stmt->bindValue(':team_id', $team_id, SQLITE3_TEXT);
    $result = $stmt->execute();

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $players[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Match Preparation</title>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        .content {
            padding: 20px;
        }

        .prep-section {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 5px solid #153C57;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #153C57;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0d2b3f;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <h1>Match Preparation</h1>
        <p>Select the starting lineup, choose tactics, and set formations for upcoming matches.</p>

        <form method="post" action="">
            <div class="prep-section">
                <h2>Starting Lineup</h2>
                <label for="lineup">Select Starting Players (Hold Ctrl/Cmd to select multiple):</label>
                <select name="lineup[]" id="lineup" multiple size="10" required>
                    <?php foreach ($players as $player): ?>
                        <option value="<?= htmlspecialchars($player['Player_ID']) ?>">
                            <?= htmlspecialchars($player['First_name'] . ' ' . $player['Last_name'] . ' (' . $player['Position'] . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="prep-section">
                <h2>Tactics</h2>
                <label for="tactics">Select Team Tactics:</label>
                <select name="tactics" id="tactics" required>
                    <option value="">-- Choose a tactic --</option>
                    <option value="Attacking">Attacking</option>
                    <option value="Defensive">Defensive</option>
                    <option value="Counter Attack">Counter Attack</option>
                    <option value="Possession">Possession Play</option>
                    <option value="High Press">High Press</option>
                </select>
            </div>

            <div class="prep-section">
                <h2>Formation</h2>
                <label for="formation">Choose Formation:</label>
                <select name="formation" id="formation" required>
                    <option value="">-- Select formation --</option>
                    <option value="4-4-2">4-4-2</option>
                    <option value="4-3-3">4-3-3</option>
                    <option value="3-5-2">3-5-2</option>
                    <option value="5-3-2">5-3-2</option>
                    <option value="4-2-3-1">4-2-3-1</option>
                </select>
            </div>

            <button type="submit">Save Match Settings</button>
        </form>
    </div>

    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>
</body>
</html>
