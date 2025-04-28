<?php
<<<<<<< HEAD
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
$refereeId = $_SESSION['user_id'];
$matchesStmt = $pdo->prepare("SELECT Match_ID FROM Match WHERE Referee_ID = ?");
$matchesStmt->execute([$refereeId]);
$matches = $matchesStmt->fetchAll(PDO::FETCH_ASSOC);




?>

<?php
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
?>

<?php
$submitResultMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['match_id'])) {
    $user_id = $_SESSION['user_id'];

    // Get and sanitize inputs
    $match_id = $_POST['match_id'];
    $team1_id = $_POST['team1_id'];
    $team2_id = $_POST['team2_id'];

    $team1_goals = $_POST['team1_goals'] ?? 0;
    $team2_goals = $_POST['team2_goals'] ?? 0;

    $team1_yellow = $_POST['team1_yellow-card'] ?? 0;
    $team2_yellow = $_POST['team2_yellow-card'] ?? 0;

    $team1_red = $_POST['team1_red-card'] ?? 0;
    $team2_red = $_POST['team2_red-card'] ?? 0;

    $team1_penalties = $_POST['team1_penalties'] ?? 0;
    $team2_penalties = $_POST['team2_penalties'] ?? 0;

    $team1_freekicks = $_POST['team1_freekicks'] ?? 0;
    $team2_freekicks = $_POST['team2_freekicks'] ?? 0;

    $team1_corners = $_POST['team1_corners'] ?? 0;
    $team2_corners = $_POST['team2_corners'] ?? 0;

    $team1_fouls = $_POST['team1_fouls'] ?? 0;
    $team2_fouls = $_POST['team2_fouls'] ?? 0;

    // Insert  result for team 1
    // Check if team1 result already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Match_Stats WHERE Match_ID = :match_id AND Team_ID = :team1_id");
    $stmt->execute([
        ':match_id' => $match_id,
        ':team1_id' => $team1_id
    ]);

    if ($stmt->fetchColumn() == 0) {
        $stmt = $pdo->prepare("
            INSERT INTO Match_Stats (
                Match_ID, Team_ID,
                Goals,
                Yellow_Cards,
                Red_Cards,
                Penalties,
                FreeKicks,
                Corners,
                Fouls
            ) VALUES (
                :match_id, :team1_id,
                :team1_goals,
                :team1_yellow,
                :team1_red,
                :team1_penalties,
                :team1_freekicks,
                :team1_corners,
                :team1_fouls
            )
        ");

        $success = $stmt->execute([
            ':match_id' => $match_id,
            ':team1_id' => $team1_id,
            ':team1_goals' => $team1_goals,
            ':team1_yellow' => $team1_yellow,
            ':team1_red' => $team1_red,
            ':team1_penalties' => $team1_penalties,
            ':team1_freekicks' => $team1_freekicks,
            ':team1_corners' => $team1_corners,
            ':team1_fouls' => $team1_fouls
        ]);
    }



    // Insert  result for team 2
    // Check if team2 result already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Match_Stats WHERE Match_ID = :match_id AND Team_ID = :team2_id");
    $stmt->execute([
        ':match_id' => $match_id,
        ':team2_id' => $team2_id
    ]);

    if ($stmt->fetchColumn() == 0) {
        $stmt = $pdo->prepare("
            INSERT INTO Match_Stats (
                Match_ID, Team_ID,
                Goals,
                Yellow_Cards,
                Red_Cards,
                Penalties,
                FreeKicks,
                Corners,
                Fouls
            ) VALUES (
                :match_id, :team2_id,
                :team2_goals,
                :team2_yellow,
                :team2_red,
                :team2_penalties,
                :team2_freekicks,
                :team2_corners,
                :team2_fouls
            )
        ");

        $success = $stmt->execute([
            ':match_id' => $match_id,
            ':team2_id' => $team2_id,
            ':team2_goals' => $team2_goals,
            ':team2_yellow' => $team2_yellow,
            ':team2_red' => $team2_red,
            ':team2_penalties' => $team2_penalties,
            ':team2_freekicks' => $team2_freekicks,
            ':team2_corners' => $team2_corners,
            ':team2_fouls' => $team2_fouls
        ]);
    }


    if (isset($success) && $success) {
        $submitResultMessage = "Match results submitted successfully.";
    } else {
        $submitResultMessage = "Match results already exist or failed to insert.";
    }
    logRecentActivity($pdo, $user_id, 'Submit Match Results', $submitResultMessage);

}
?>

=======
// session_start();
// if (!isset($_SESSION['user_id'])) {
// header("Location: ../login.php");
// exit();
// }
?>
>>>>>>> jamie
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit Results</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>Submit Results</h1>
    </header>
    <div class="card-section">
        <div class="card">
            <div class="table-container">
<<<<<<< HEAD
                <form action="#" method="POST" class="incident-form">
=======
                <form action="#">
>>>>>>> jamie
                    <table class="custom-table history-table" style="border:0px;">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center">Results</th>
                            </tr>
<<<<<<< HEAD
                            <tr>
                                <th colspan="4" class="text-center">
                                    <label for="match_id">Select Match</label>
                                    <select name="match_id" id="match_id" required>
                                        <option value="">Select Match</option>
                                        <?php foreach ($matches as $match): ?>
                                            <option value="<?= $match['Match_ID'] ?>"><?= htmlspecialchars($match['Match_ID']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </th>
                            </tr>
=======
>>>>>>> jamie
                        
                        </thead>
                        <tbody  class="submit-result">
                            <tr>
                                <th class="sub-headings">Team 1 Name</th>
<<<<<<< HEAD
                                <th>
                                    <input type="text" name="team1_id" id="team1_id" hidden >
                                    <input type="text" name="team1" id="team1" readonly>
                                </th>

                                <th class="border-left-bold-white sub-headings">Team 2 Name</th>
                                <th>
                                    <input type="text" name="team2_id" id="team2_id" hidden >    
                                    <input type="text" name="team2" id="team2" readonly>
                                </th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Goals</th>
                                <th><input type="number" name="team1_goals" id="team1_goals"></th>

                                <th class="border-left-bold-white sub-headings">Goals</th>
                                <th><input type="number" name="team2_goals" id="team2_goals"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Yellow Cards</th>
                                <th><input type="number" name="team1_yellow-card" id="team1_yellow-card"></th>

                                <th class="border-left-bold-white sub-headings">Yellow Cards</th>
                                <th><input type="number" name="team2_yellow-card" id="team2_yellow-card"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Red Cards</th>
                                <th><input type="number" name="team1_red-card" id="team1_red-card"></th>
                                
                                <th class="border-left-bold-white sub-headings">Red Cards</th>
                                <th><input type="number" name="team2_red-card" id="team2_red-card"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Penalties</th>
                                <th><input type="number" name="team1_penalties" id="team1_penalties"></th>

                                <th class="border-left-bold-white sub-headings">Penalties</th>
                                <th><input type="number" name="team2_penalties" id="team2_penalties"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Free Kicks</th>
                                <th><input type="number" name="team1_freekicks" id="team1_freekicks"></th>

                                <th class="border-left-bold-white sub-headings">Free Kicks</th>
                                <th><input type="number" name="team2_freekicks" id="team2_freekicks"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Corners</th>
                                <th><input type="number" name="team1_corners" id="team1_corners"></th>

                                <th class="border-left-bold-white sub-headings">Corners</th>
                                <th><input type="number" name="team2_corners" id="team2_corners"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Fouls</th>
                                <th><input type="number" name="team1_fouls" id="team1_fouls"></th>

                                <th class="border-left-bold-white sub-headings">Fouls</th>
                                <th><input type="number" name="team2_fouls" id="team2_fouls"></th>
                            </tr>
                            <tr>
                                <th colspan=4>                            
                                    <button class="custom-button">Submit</button>
                                    <?php if ($submitResultMessage): ?>
                                        <p style="color: light-green;"><?= $submitResultMessage ?></p>
                                    <?php endif; ?>
                                </th>
=======
                                <th><input type="text" name="team1" id="team1"></th>

                                <th class="border-left-bold-white sub-headings">Team 2 Name</th>
                                <th><input type="text" name="team2" id="team2"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Goals</th>
                                <th><input type="text" name="goals" id="goals"></th>

                                <th class="border-left-bold-white sub-headings">Goals</th>
                                <th><input type="text" name="goals" id="goals"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Goals scored by:</th>
                                <td class="scored-by">
                                     <div class="flex">
                                        <p class="left heading">Player Name</p>
                                        <p class="right heading">Time</p> 
                                     </div>
                                     <div class="flex">
                                       <input type="text" name="player" id="player"></p>
                                        <input type="text" name="time"></p> 
                                     </div>
                                     <div class="flex">
                                       <input type="text" name="player" id="player"></p>
                                        <input type="text" name="time"></p> 
                                     </div>
                                     <div class="flex">
                                       <input type="text" name="player" id="player"></p>
                                        <input type="text" name="time"></p> 
                                     </div>

                                </td>
                                   
                                    

                                <th class="border-left-bold-white sub-headings">Goals scored by:</th>
                                <td class="scored-by">
                                     <div class="flex">
                                        <p class="left heading">Player Name</p>
                                        <p class="right heading">Time</p> 
                                     </div>
                                     <div class="flex">
                                       <input type="text" name="player" id="player"></p>
                                        <input type="text" name="time"></p> 
                                     </div>
                                     <div class="flex">
                                       <input type="text" name="player" id="player"></p>
                                        <input type="text" name="time"></p> 
                                     </div>
                                     <div class="flex">
                                       <input type="text" name="player" id="player"></p>
                                        <input type="text" name="time"></p> 
                                     </div>

                                </td>
                            </tr>
                            <tr>
                                <th class="sub-headings">Yellow Cards</th>
                                <th><input type="text" name="yellow-card" id="yellow-card"></th>

                                <th class="border-left-bold-white sub-headings">Yellow Cards</th>
                                <th><input type="text" name="yellow-card" id="yellow-card"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Red Cards</th>
                                <th><input type="text" name="red-card" id="red-card"></th>
                                
                                <th class="border-left-bold-white sub-headings">Red Cards</th>
                                <th><input type="text" name="red-card" id="red-card"></th>
>>>>>>> jamie
                            </tr>
                            
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- for disiplinary action form -->
    <script>
        $(document).ready(function () {
            // On change event for select box for match_id
            $('#match_id').on('change', function () {
                const incidentId = $(this).val();

                if (incidentId) {
                    $.getJSON(window.location.pathname + '?get_teams_by_match=1&match_id=' + incidentId, function (data) {
                        console.log(data);

                        if (data && data[0].Team_ID && data[1].Team_ID) {
                            $('#team1_id').val(data[0].Team_ID);
                            $('#team1').val(data[0].Team_name);

                            $('#team2_id').val(data[1].Team_ID);
                            $('#team2').val(data[1].Team_name);
                        } else {
                            $('#team1_id').val('Not found');
                            $('#team2_id').val('Not found');
                            $('#team1').val('Not found');
                            $('#team2').val('Not found');
                        }
                    }).fail(function () {
                        console.error("Error fetching data");
                        $('#team1_id').val('Error');
                        $('#team2_id').val('Error');
                        $('#team1').val('Error');
                        $('#team2').val('Error');
                    });
                } else {
                    $('#team1_id').val('');
                    $('#team2_id').val('');
                    $('#team1').val('');
                    $('#team2').val('');
                }
            });
        });
    </script>
=======
>>>>>>> jamie
</body>
</html>
