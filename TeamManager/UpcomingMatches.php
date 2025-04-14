<?php
// select the correct email and user from the sign-in process
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];
//

$database = new SQLite3('../fb_managment_system.db');

$stmt = $database->prepare('SELECT 
    t1.Team_Name AS team1, t2.Team_Name AS team2, m.Match_Date
    FROM Match m
    INNER JOIN Team t1 ON m.TeamA_ID = t1.Team_ID
    INNER JOIN Team t2 ON m.TeamB_ID = t2.Team_ID
    INNER JOIN Users u ON (t1.Manager_ID = u.User_ID OR t2.Manager_ID = u.User_ID)
    WHERE m.Match_Date >= DATE("now") AND u.Email_Address = :email
    ORDER BY m.Match_Date ASC');

$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$results = $stmt->execute();

if (!$results) {
    die("Query failed: " . $database->lastErrorMsg());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Calendar</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>


<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Upcoming Matches</h1>
        </header>
        <h2>Upcoming Matches</h2>
        <table>
            <tr>
                <th>Teams</th>
                <th>Date</th>
            </tr>
            <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['team1']) . " vs " . htmlspecialchars($row['team2']); ?></td>
                <td><?php echo htmlspecialchars($row['Match_Date']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>

</body>
</html>


