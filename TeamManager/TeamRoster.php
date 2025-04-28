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
    $query = $database->prepare("
        SELECT p.Player_ID, u.First_name, u.Last_name, p.Position 
        FROM Player p
        JOIN Users u ON p.Player_ID = u.User_ID
        WHERE p.Team_ID = :team_id
        ORDER BY u.Last_name, u.First_name
    ");
    $query->bindValue(':team_id', $team_id, SQLITE3_TEXT);
    $result = $query->execute();
    
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $players[] = $row;
    }
}

$selectedPlayer = null;
$currentPosition = '';
$successMessage = '';
$errorMessage = '';

if (isset($_POST['update'])) {
    $playerID = $_POST['playerID'] ?? '';
    $position = $_POST['position'] ?? '';

    if (!empty($playerID) && !empty($position)) {
        $verifyStmt = $database->prepare("
            SELECT COUNT(*) as count 
            FROM Player p
            JOIN Team t ON p.Team_ID = t.Team_ID
            WHERE p.Player_ID = :playerID 
            AND t.Manager_ID = :manager_id
        ");
        $verifyStmt->bindValue(':playerID', $playerID, SQLITE3_TEXT);
        $verifyStmt->bindValue(':manager_id', $manager_id, SQLITE3_TEXT);
        $verifyResult = $verifyStmt->execute()->fetchArray(SQLITE3_ASSOC);
        
        if ($verifyResult['count'] > 0) {
            $updateStmt = $database->prepare("UPDATE Player SET Position = :position WHERE Player_ID = :playerID");
            $updateStmt->bindValue(':position', $position, SQLITE3_TEXT);
            $updateStmt->bindValue(':playerID', $playerID, SQLITE3_TEXT);
            
            if ($updateStmt->execute()) {
                $successMessage = "Position updated successfully!";
                foreach ($players as &$player) {
                    if ($player['Player_ID'] == $playerID) {
                        $player['Position'] = $position;
                        $currentPosition = $position;
                        break;
                    }
                }
            } else {
                $errorMessage = "Error updating position: " . $database->lastErrorMsg();
            }
        } else {
            $errorMessage = "You are not authorized to update this player's position.";
        }
    }
}

if (isset($_POST['remove_player'])) {
    $playerID = $_POST['player_id'] ?? '';
    
    if (!empty($playerID)) {
        $verifyStmt = $database->prepare("
            SELECT COUNT(*) as count 
            FROM Player p
            JOIN Team t ON p.Team_ID = t.Team_ID
            WHERE p.Player_ID = :playerID 
            AND t.Manager_ID = :manager_id
        ");
        $verifyStmt->bindValue(':playerID', $playerID, SQLITE3_TEXT);
        $verifyStmt->bindValue(':manager_id', $manager_id, SQLITE3_TEXT);
        $verifyResult = $verifyStmt->execute()->fetchArray(SQLITE3_ASSOC);
        
        if ($verifyResult['count'] > 0) {
            $deleteStmt = $database->prepare("DELETE FROM Player WHERE Player_ID = :playerID");
            $deleteStmt->bindValue(':playerID', $playerID, SQLITE3_TEXT);
            
            if ($deleteStmt->execute()) {
                foreach ($players as $key => $player) {
                    if ($player['Player_ID'] == $playerID) {
                        unset($players[$key]);
                        break;
                    }
                }
                $successMessage = "Player removed successfully!";
            }
        }
    }
}

if (isset($_POST['playerID']) || isset($_GET['playerID'])) {
    $playerID = $_POST['playerID'] ?? $_GET['playerID'] ?? '';
    
    foreach ($players as $player) {
        if ($player['Player_ID'] == $playerID) {
            $selectedPlayer = $player;
            $currentPosition = $player['Position'];
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Management</title>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        .content {
            padding: 20px;
        }
        
        .management-section {
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        select, input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .update-btn {
            background: #4CAF50;
            color: white;
        }
        
        .update-btn:hover {
            background: #45a049;
        }
        
        .remove-btn {
            background: #f44336;
            color: white;
        }
        
        .remove-btn:hover {
            background: #d32f2f;
        }
        
        .roster-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .roster-table th, .roster-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        .roster-table th {
            background-color: #153C57;
            color: white;
        }
        
        .roster-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        .roster-table tr:hover {
            background-color: #e6f7ff;
        }
        
        .player-info {
            background: #e9e9e9;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
            margin: 15px 0;
        }
        
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        
        .success {
            background: #e8f5e9;
            border-left: 4px solid #2e7d32;
            color: green;
        }
        
        .error {
            background: #ffebee;
            border-left: 4px solid #d32f2f;
            color: #d32f2f;
        }
        
        .no-players {
            margin: 20px;
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
            <h1>Team Management</h1>
        </header>

        <main>
            <div class="management-section">
                <h2>Player Position Management</h2>
                
                <?php if (!empty($successMessage)): ?>
                    <div class="message success"><?= htmlspecialchars($successMessage) ?></div>
                <?php endif; ?>
                
                <?php if (!empty($errorMessage)): ?>
                    <div class="message error"><?= htmlspecialchars($errorMessage) ?></div>
                <?php endif; ?>

                <div class="form-container">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="player">Select Player:</label>
                            <select name="playerID" id="player" required>
                                <option value="">-- Select a Player --</option>
                                <?php foreach ($players as $player): ?>
                                    <option value="<?= htmlspecialchars($player['Player_ID']) ?>"
                                        <?= (isset($selectedPlayer) && $selectedPlayer['Player_ID'] == $player['Player_ID']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($player['First_name'] . ' ' . $player['Last_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <?php if (isset($selectedPlayer)): ?>
                        <div class="player-info">
                            <p><strong>Current Player:</strong> <?= htmlspecialchars($selectedPlayer['First_name'] . ' ' . $selectedPlayer['Last_name']) ?></p>
                            <p><strong>Current Position:</strong> <?= htmlspecialchars($selectedPlayer['Position']) ?></p>
                        </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="position">Position:</label>
                            <input type="text" name="position" id="position" 
                                   value="<?= htmlspecialchars($currentPosition) ?>" 
                                   required>
                        </div>

                        <button type="submit" name="update" class="update-btn">Update Position</button>
                    </form>
                </div>
            </div>
            <div class="management-section">
                <h2>Team Roster</h2>
                
                <?php if (empty($players)): ?>
                    <div class="no-players">
                        <p>No players currently on your team roster.</p>
                    </div>
                <?php else: ?>
                    <table class="roster-table">
                        <thead>
                            <tr>
                                <th>Player ID</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($players as $player): ?>
                            <tr>
                                <td><?= htmlspecialchars($player['Player_ID']) ?></td>
                                <td><?= htmlspecialchars($player['First_name'].' '.$player['Last_name']) ?></td>
                                <td><?= htmlspecialchars($player['Position']) ?></td>
                                <td>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="player_id" value="<?= htmlspecialchars($player['Player_ID']) ?>">
                                        <button type="submit" name="remove_player" class="remove-btn" 
                                            onclick="return confirm('Are you sure you want to remove this player from the team?')">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>
</body>
</html>