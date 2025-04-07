<?php
$database = new SQLite3('../fb_managment_system.db');

$query = "SELECT  t1.team_name AS team1, t2.team_name AS team2, m.Match_Date 
          FROM match m
          JOIN team t1 ON m.TeamA_ID = t1.team_id
          JOIN team t2 ON m.TeamB_ID = t2.team_id
          WHERE m.Match_Date >= DATE('now') 
          ORDER BY m.Match_Date ASC";
$results = $database->query($query);

if (!$results) {
    die("Query failed: " . $database->lastErrorMsg());
}
?>

<?php
// get_matches.php
header('Content-Type: application/json');

$database = new SQLite3('../fb_managment_system.db');

$query = "SELECT t1.team_name AS team1, t2.team_name AS team2, m.Match_Date 
          FROM match m
          JOIN team t1 ON m.TeamA_ID = t1.team_id
          JOIN team t2 ON m.TeamB_ID = t2.team_id
          WHERE m.Match_Date >= DATE('now')";

$results = $database->query($query);

$events = [];

while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $events[] = [
        'title' => $row['team1'] . " vs " . $row['team2'],
        'start' => $row['Match_Date']
    ];
}

echo json_encode($events);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Calendar</title>
    <link rel="stylesheet" href="../styles/style.css">
    <!-- Link to Calendar API/ FullCalendar -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.js'></script>
</head>
<style>
<<<<<<< Updated upstream
#upcoming-matches-section{
    margin-left: 20px;
}

#upcoming-match-table{
    border: 2px solid black;
    border-collapse: separate;
}

#upcoming-match-table tr th{
    color: white;
    background-color:#2d4458;
    padding: 10px 20px;
}

#upcoming-match-table tr td{
    padding: 10px 20px;
=======
.matches-section{
    margin: 20px;
}

#match-calendar-table{
    border: 1px solid black;
    border-radius: 15%;
    border-collapse: collapse;
}

#match-calendar-table tr th{
    color:#ffffff;
    background-color:rgb(48, 60, 86);
    padding: 10px 40px;
}

#match-calendar-table tr td{
    border: 1px solid black;
    padding: 10px 40px;
>>>>>>> Stashed changes
}
</style>


<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Match Calendar</h1>
        </header>

<<<<<<< Updated upstream
        <section id="upcoming-matches-section">
            <h2>Upcoming Matches</h2>
            <table id="upcoming-match-table">
=======
        <section class="matches-section">
            <h2>Upcoming Matches</h2>
            <table id="match-calendar-table">
>>>>>>> Stashed changes
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
        </section>
        
<<<<<<< Updated upstream

        <section id="calendar-section">
            <div id='calendar'></div>
        </section>
=======
>>>>>>> Stashed changes
    </div>

</body>
</html>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 'auto',
            events: '../TeamManager/get_matches.php', // Path to your PHP endpoint
            eventColor: '#30405a',
            eventTextColor: '#fff'
        });
        calendar.render();
    });
</script>