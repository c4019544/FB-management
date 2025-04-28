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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upcoming Matches</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<<<<<<< HEAD
<?php
// hanlde upcomming matches

// current user id and refereeid
$refereeId = $_SESSION['user_id'];
// Set today's date
$todays_date = date("Y-m-d");
// $todays_date = date("2025-04-10");

// Fetch upcoming matches with team names with current referee user id
$matchesStmt = $pdo->prepare("
    SELECT 
        m.Match_ID,
        th.Team_name AS home_team,
        ta.Team_name AS away_team,
        m.Match_Date,
        f.Field_name AS location,
        f.Address_Line1,
        f.City
    FROM Match m
    JOIN Team th ON m.TeamA_ID = th.Team_ID
    JOIN Team ta ON m.TeamB_ID = ta.Team_ID
    JOIN Field_Booking b ON m.Booking_ID = b.Booking_ID
    JOIN Field f ON b.Field_ID = f.Field_ID
    WHERE m.Match_Date >= ? AND m.Referee_ID = ?
    ORDER BY m.Match_Date ASC
");
$matchesStmt->execute([$todays_date, $refereeId]);
$upcoming_matches = $matchesStmt->fetchAll(PDO::FETCH_ASSOC);

?>
=======
>>>>>>> jamie
<div class="content">
    <header>
        <h1>Upcoming Matches</h1>
    </header>
    <div class="card-section">
        <div class="card">
            <div class="table-container">
                <table class="custom-table history-table">
                    <thead>
                        <tr class="sub-headings">
                            <th>Team</th>
<<<<<<< HEAD
                            <th>VS</th>
                            <th>Team</th>
                            <th>Date</th>
=======
                            <th>Time</th>
>>>>>>> jamie
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
<<<<<<< HEAD
                        <?php foreach ($upcoming_matches as $match): ?>
                            <tr>
                                <td><?= htmlspecialchars($match['home_team']) ?></td>
                                <td>VS</td>
                                <td><?= htmlspecialchars($match['away_team']) ?></td>
                                <td><?= htmlspecialchars($match['Match_Date']) ?></td>
                                <td><?= htmlspecialchars($match['location']) ?>, <?= htmlspecialchars($match['Address_Line1']) ?>, <?= htmlspecialchars($match['City']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

=======
                        <tr>
                            <td>Manchester United</td>
                            <td>19:00</td>
                            <td>Old Trafford</td>
                        </tr>
                        <tr>
                            <td>Manchester United</td>
                            <td>19:00</td>
                            <td>Old Trafford</td>
                        </tr>
                        <tr>
                            <td>Manchester United</td>
                            <td>19:00</td>
                            <td>Old Trafford</td>
                        </tr>
                    </tbody>
>>>>>>> jamie
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
