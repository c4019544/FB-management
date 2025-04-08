<?php
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


