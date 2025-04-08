<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Manager</title>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        .footer {
            position: fixed;
            left: 250px;
            bottom: 0;
            width: calc(100% - 250px);
            background-color: #153C57;
            color: white;
            text-align: center;
            padding: 15px 0;
            z-index: 99;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }

        .footer p {
            margin: 0;
            display: inline-block;
            margin-right: 15px;
        }

        .footer a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #4CAF50;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
                width: calc(100% - 200px);
            }

            .footer {
                left: 200px;
                width: calc(100% - 200px);
            }
        }

        main {
            margin: 20px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        form {
            background: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: inline-block;
            width: 120px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select, input[type="text"] {
            padding: 8px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .player-info {
            margin: 15px 0;
            padding: 15px;
            background: #e9e9e9;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
        }

        .success-message {
            color: green;
            background: #e8f5e9;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            border-left: 4px solid #2e7d32;
        }

        .error-message {
            color: #d32f2f;
            background: #ffebee;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            border-left: 4px solid #d32f2f;
        }

        .player-display {
            margin-top: 15px;
            padding: 10px;
            background: #e3f2fd;
            border-radius: 4px;
            border-left: 4px solid #1976d2;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <header>
            <h1>Player Management</h1>
        </header>

        <main>
            <?php
            $database = new SQLite3('../fb_managment_system.db');

            if (!$database) {
                die("Database connection failed: " . $database->lastErrorMsg());
            }

            $selectedPlayer = null;
            $currentPosition = '';

            if (isset($_POST['update'])) {
                $playerID = $_POST['playerID'];
                $position = SQLite3::escapeString($_POST['position']);

                
                $playerID = SQLite3::escapeString($playerID); 
                $updateQuery = "UPDATE Player SET Position = '$position' WHERE Player_ID = '$playerID'"; 
                $updateResult = $database->exec($updateQuery);

                if ($updateResult) {
                    echo "<div class='success-message'>Position updated successfully!</div>";

                    
                    $infoQuery = "SELECT Users.First_name, Users.Last_name, Player.Position
                                  FROM Player
                                  JOIN Users ON Player.Player_ID = Users.User_ID
                                  WHERE Player.Player_ID = '$playerID'"; 
                    $infoResult = $database->querySingle($infoQuery, true);

                    if ($infoResult) {
                        echo "<div class='player-display'>
                                <strong>Updated Player:</strong> 
                                {$infoResult['First_name']} {$infoResult['Last_name']} – 
                                Position: {$infoResult['Position']}
                              </div>";
                    }
                } else {
                    echo "<div class='error-message'>Error updating position: " . $database->lastErrorMsg() . "</div>";
                }
            }

            if (isset($_POST['playerID']) || isset($_GET['playerID'])) {
                $playerID = isset($_POST['playerID']) ? $_POST['playerID'] : $_GET['playerID'];

                $playerID = SQLite3::escapeString($playerID);

                $query = "SELECT Player.Player_ID, Users.First_name, Users.Last_name, Player.Position
                          FROM Player
                          JOIN Users ON Player.Player_ID = Users.User_ID
                          WHERE Player.Player_ID = '$playerID'";

                $selectedPlayer = $database->querySingle($query, true);

                if ($selectedPlayer) {
                    $currentPosition = $selectedPlayer['Position'];
                }
            }
            ?>

            <form method="POST" action="">
                <label for="player">Select Player:</label>
                <select name="playerID" id="player" required>
                    <option value="">-- Select a Player --</option>
                    <?php
                    $query = "SELECT Player.Player_ID, Users.First_name, Users.Last_name, Player.Position
                              FROM Player
                              JOIN Users ON Player.Player_ID = Users.User_ID
                              ORDER BY Users.Last_name, Users.First_name";

                    $result = $database->query($query);

                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        $selected = (isset($selectedPlayer) && $selectedPlayer['Player_ID'] == $row['Player_ID']) ? 'selected' : '';
                        echo "<option value='{$row['Player_ID']}' $selected>
                                {$row['First_name']} {$row['Last_name']}
                              </option>";
                    }
                    ?>
                </select><br><br>

                <?php if ($selectedPlayer): ?>
                <div class="player-info">
                    <p><strong>Current Player:</strong> <?= $selectedPlayer['First_name'] ?> <?= $selectedPlayer['Last_name'] ?></p>
                    <p><strong>Current Position:</strong> <?= $selectedPlayer['Position'] ?></p>
                </div>
                <?php endif; ?>

                <label for="position">Position:</label>
                <input type="text" name="position" id="position" 
                       value="<?= htmlspecialchars($currentPosition) ?>" 
                       required><br><br>

                <button type="submit" name="update">Update Position</button>
            </form>
        </main>
    </div>

    <footer class="footer">
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>
</body>
</html>
