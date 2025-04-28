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
// global function of recent activity to store

function logRecentActivity($pdo, $userId, $type, $description = null) {
    try {
        $stmt = $pdo->prepare("INSERT INTO Recent_activity (user_id, activity_type, activity_description) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $type, $description]);
    } catch (PDOException $e) {
        // Optional: Handle or log error
        error_log("Activity log failed: " . $e->getMessage());
    }
}

?>


<?php
// handle incident report form submission
$incidentMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['match_id'], $_POST['team_id'], $_POST['player_id'], $_POST['description'], $_POST['time'])) {
    try {
        $user_id = $_SESSION['user_id'];

        // Fetch last incident id
        $stmt = $pdo->query("SELECT Incident_ID FROM Incident ORDER BY Incident_ID DESC LIMIT 1");
        $lastIdRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($lastIdRow) {
            // Extract the number and increment
            // $lastNumber = (int) str_replace("INC_", "", $lastIdRow['Incident_ID']);
            $incident_id = (int) $lastIdRow['Incident_ID'] + 1;
            // $newNumber = $lastNumber + 1;
            // $incident_id = 'INC_' . str_pad($newNumber, 3, '0', STR_PAD_LEFT); // e.g., INC_005
        } else {
            $incident_id = '001'; // First record
        }

        $match_id = $_POST['match_id'];
        $player_id = $_POST['player_id'];
        $team_id = $_POST['team_id'];
        $description = $_POST['description'];
        $time = $_POST['time'];

        $stmt = $pdo->prepare("INSERT INTO Incident (Incident_ID, Player_ID, Match_ID, Description, Time) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$incident_id, $player_id, $match_id, $description, $time]);

        $incidentMessage = "Incident logged successfully!";
        logRecentActivity($pdo, $user_id, 'Incident Reported',   $incidentMessage );
    } catch (PDOException $e) {
        $incidentMessage = "Error: " . $e->getMessage();
    }
}

// Handle AJAX request for teams
if (isset($_GET['get_teams_by_match']) && isset($_GET['match_id'])) {
    $matchId = $_GET['match_id'];
    $stmt = $pdo->prepare("
        SELECT t.Team_ID, t.Team_name
        FROM Team t
        JOIN Match m ON t.Team_ID = m.TeamA_ID OR t.Team_ID = m.TeamB_ID
        WHERE m.Match_ID = ?
    ");
    $stmt->execute([$matchId]);
    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($teams);
    exit;
}

// Handle AJAX request for players
if (isset($_GET['get_players_by_team']) && isset($_GET['team_id'])) {
    $teamId = $_GET['team_id'];
    $stmt = $pdo->prepare("
        SELECT Users.User_ID, Users.First_name, Users.Last_name
        FROM Player 
        JOIN Users ON Player.Player_ID = Users.User_ID 
        WHERE Player.Team_ID = ?
    ");
    $stmt->execute([$teamId]);
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($players);
    exit;
}

$refereeId = $_SESSION['user_id'];
$matchesStmt = $pdo->prepare("SELECT Match_ID FROM Match WHERE Referee_ID = ?");
$matchesStmt->execute([$refereeId]);
$matches = $matchesStmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
// fetch recent activity associated with current user id
$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM Recent_activity WHERE user_id = ? ORDER BY activity_time DESC LIMIT 10");
$stmt->execute([$userId]);
$recentActivities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<?php
// get list of incident IDs
$stmt = $pdo->prepare("SELECT Incident_ID FROM Incident");
$stmt->execute();
$incident_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($incident_ids);
// exit();

?>
<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['incident_id'])) {
    $user_id = $_SESSION['user_id'];
    $incident_id = $_POST['incident_id'];
    $match_id = $_POST['D_match_id'];
    $player_id = $_POST['D_player_id'];
    $action_type = $_POST['disciplinary_action'];

    if ($incident_id && $match_id && $player_id && $action_type) {
        $stmt = $pdo->prepare("
            INSERT INTO Disciplinary_Action (Incident_ID, Match_ID, Player_ID, Disciplinary_action)
            VALUES (?, ?, ?, ?)
        ");
        $success = $stmt->execute([$incident_id, $match_id, $player_id, $action_type]);

        if ($success) {
            $message = "Disciplinary action recorded successfully.";
        } else {
            $message = "Failed to record disciplinary action.";
        }
        logRecentActivity($pdo, $user_id, 'Disciplinary Action',   $message );
    } else {
        $message = "All fields are required.";
    }
}
?>




<?php
// Handle AJAX request for incident values
if (isset($_GET['get_values_by_incident']) && isset($_GET['incident_id'])) {
    $incidentId = $_GET['incident_id'];
    $stmt = $pdo->prepare("
        SELECT Match_ID, Player_ID
        FROM Incident
        WHERE Incident_ID = ?
    ");
    $stmt->execute([$incidentId]);
    $incident = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($incident);
    exit;
}
?>


<?php
// hanlde upcomming matches

// current user id and refereeid
$refereeId = $_SESSION['user_id'];
// Set today's date
// $todays_date = date("2025-04-10");
$todays_date = date("Y-m-d");

// Fetch upcoming matches with team names with current referee user id
$matchesStmt = $pdo->prepare("
    SELECT 
        m.Match_ID,
        th.Team_name AS home_team,
        ta.Team_name AS away_team,
        m.Match_Date
    FROM Match m
    JOIN Team th ON m.TeamA_ID = th.Team_ID
    JOIN Team ta ON m.TeamB_ID = ta.Team_ID
    WHERE m.Match_Date >= ? AND m.Referee_ID = ?
    ORDER BY m.Match_Date ASC
    LIMIT 6
");
$matchesStmt->execute([$todays_date, $refereeId]);
$upcoming_matches = $matchesStmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/sidebar.php'; ?>

    <section class="content">
        <header>
            <h1>Dashboard</h1>
        </header>
        <!-- <p>Welcome to the Match Management System.</p> -->
        <div class="card-section">
            <div class="flex">
                <div class="upper-left-card">
                    <div class="card">
                        <h2>Match Overview Widget</h2>
                        <div class="table-container">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th colspan="3">Upcoming Matches</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($upcoming_matches)): ?>
                                        <?php foreach ($upcoming_matches as $match): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($match['home_team']) ?></td>
                                                <td>VS</td>
                                                <td><?= htmlspecialchars($match['away_team']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No upcoming matches found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <a class="custom-button" href="UpcomingMatches.php">View Match Details</a>
                    </div>
                </div>

                <div class="upper-right-card">
                    <div class="card">
                        <h2>Incident Reporting Form</h2>
                        <form method="POST" class="incident-form">
                            <label for="match_id">Match *</label>
                            <select name="match_id" id="match_id" required>
                                <option value="">Select Match</option>
                                <?php foreach ($matches as $match): ?>
                                    <option value="<?= $match['Match_ID'] ?>"><?= htmlspecialchars($match['Match_ID']) ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="team_id">Team *</label>
                            <select name="team_id" id="team_id" required>
                                <option value="">Select Team</option>
                                <?php foreach ($teams as $team): ?>
                                    <option value="<?= $team['Team_ID'] ?>"><?= htmlspecialchars($team['Team_name']) ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="player_id">Player *</label>
                            <select name="player_id" id="player_id" required>
                                <option value="">Select Player</option>
                                <?php foreach ($players as $player): ?>
                                    <option value="<?= $player['Player_ID'] ?>"><?= htmlspecialchars($player['First_name']) ?> <?= htmlspecialchars($player['Last_name']) ?></option>>
                                <?php endforeach; ?>
                            </select>

                            <label for="time">Description</label>
                            <input type="text" name="description" required>

                            <label for="time">Time (in minutes)</label>
                            <input type="number" name="time" required min="0">

                            <button class="custom-button">Submit</button>
                        </form>

                        <?php if ($incidentMessage): ?>
                            <p style="color: light-green;"><?= $incidentMessage ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
           
            <div class="flex">
                <div class="lower-left-card">
                    <div class="card">
                        <h2>Disciplinary Action and Match Results</h2>
                        <form method="POST" class="incident-form">

                            <!-- Incident Selection -->
                            <label for="incident_id">Incident *</label>
                            <select name="incident_id" id="incident_id" required>
                                <option value="">Select Incident ID</option>
                                <?php foreach ($incident_ids as $incident): ?>
                                    <option value="<?= $incident['Incident_ID'] ?>"><?= htmlspecialchars($incident['Incident_ID']) ?></option>
                                <?php endforeach; ?>
                            </select>

                            <!-- Match Selection -->
                            <label for="D_match_id">Match *</label>
                            <input type="text" id="D_match_id" name="D_match_id">

                            <!-- Player Selection -->
                            <label for="D_player_id">Player *</label>
                            <input type="text" id="D_player_id" name="D_player_id">

                            <!-- Disciplinary Action Dropdown -->
                            <label for="disciplinary_action">Disciplinary Action *</label>
                            <select name="disciplinary_action" id="disciplinary_action" required>
                                <option value="">Select Action</option>
                                <option value="yellow_card">Yellow Card</option>
                                <option value="red_card">Red Card</option>
                                <option value="verbal_warning">Verbal Warning</option>
                                <option value="suspension">Suspension</option>
                                <option value="fine">Fine</option>
                                <option value="ejection">Ejection from Match</option>
                                <option value="other">Other</option>
                            </select>

                    
                            <button class="custom-button">Submit</button>
                        </form>

                        <?php if ($message): ?>
                            <p style="color: green;"><?= $message ?></p>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="lower-right-card">
                    <div class="card">
                        <h2>Recent Activity Feed</h2>
                        <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Recent Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recentActivities)): ?>
                                    <?php foreach ($recentActivities as $activity): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($activity['activity_description']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td>No recent activities found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        
    </section>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- for disiplinary action form -->
    <script>
        $(document).ready(function () {
            // On change event for select box for incident_id
            $('#incident_id').on('change', function () {
                const incidentId = $(this).val();

                if (incidentId) {
                    $.getJSON(window.location.pathname + '?get_values_by_incident=1&incident_id=' + incidentId, function (data) {
                        console.log(data);

                        if (data && data[0].Match_ID) {
                            $('#D_match_id').val(data[0].Match_ID);
                            $('#D_player_id').val(data[0].Player_ID);
                        } else {
                            $('#D_match_id').val('Not found');
                            $('#D_player_id').val('Not found');
                        }
                    }).fail(function () {
                        console.error("Error fetching data");
                        $('#D_match_id').val('Error');
                        $('#D_player_id').val('Error');
                    });
                } else {
                    $('#D_match_id').val('');
                    $('#D_player_id').val('');
                }
            });
        });
    </script>



    <!-- for incident report form -->
    <script>
        
    $(document).ready(function () {

        // onchange event for select box for Matches
        $('#match_id').on('change', function () {
            const matchId = $(this).val();
            $('#team_id').html('<option value="">Loading...</option>');

            if (matchId) {
                $.get(window.location.pathname + '?get_teams_by_match=1&match_id=' + matchId, function (data) {
                    let options = '<option value="">Select Team</option>';
                    
                    data.forEach(function (team) {
                        options += `<option value="${team.Team_ID}">${team.Team_name}</option>`;
                    });
                    $('#team_id').html(options);
                });
            } else {
                $('#team_id').html('<option value="">Select Team</option>');
            }
        });
        // on chnage teams
        $('#team_id').on('change', function () {
            const teamId = $(this).val();
            $('#player_id').html('<option value="">Loading...</option>');

            if (teamId) {
                $.get(window.location.pathname + '?get_players_by_team=1&team_id=' + teamId, function (data) {
                    let options = '<option value="">Select Player</option>';
                    
                    data.forEach(function (player) {
                        options += `<option value="${player.User_ID}">${player.First_name} ${player.Last_name}</option>`;
                    });
                    $('#player_id').html(options);
                });
            } else {
                $('#player_id').html('<option value="">Select Player</option>');
            }
        });
    });
    </script>
</body>
<?php include '../includes/footer.php'; ?>
</html>
