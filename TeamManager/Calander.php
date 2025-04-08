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

<!DOCTYPE html>s
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Calendar</title>
    <link rel="stylesheet" href="../styles/style.css">
    <!-- Link to Calendar API/ FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Match Calendar</h1>
        </header>
        <!-- calendar API -->
        <section id="calendar">
        </section>

        <section id="upcoming-matches-section">
            <h2>Upcoming Matches</h2>
            <table id="upcoming-match-table">
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
        <br>
    </div>

    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>
</body>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        events: '../TeamManager/GetMatches.php', // Path to your PHP endpoint
        eventColor: ' #f2f0b4',
        eventTextColor: ' #000000'
    });
    calendar.render();
});
</script>



<style>
#calendar{
    background-color: #a2b7c9;
    width: auto;
    height: auto;
    margin: 0 70px;
    border: 2px solid black;
    padding: 50px;
    position: relative;
}

/* the month/yr of the calendar */
.fc-toolbar h2 { 
    color:#363e4e; 
    padding-left: 10px;
}

 /* Color of the days of the week (Monday, Tuesday, etc.) */
.fc-day-header {
    font-weight: bold; 
    background-color: black !important;
    color: white;
}

/* Change the color of the dates */
.fc-day{
    background-color: #2d4458;
}

/* Change the background color of today's date */
.fc-day-today {
    background-color:#61727a !important; /* background for today's date */
}

.fc-day:hover {
    background-color: #ab5757; /* background on hover */
    color:rgb(185, 181, 181);
    cursor: pointer;
}


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


