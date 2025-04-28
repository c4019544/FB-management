<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];
$database = new SQLite3('../fb_managment_system.db');

// Handle AJAX for calendar events
if (isset($_GET['fetch_matches'])) {
    $teamQuery = $database->prepare('
        SELECT Team_ID FROM Team 
        WHERE Manager_ID = (
            SELECT User_ID FROM Users WHERE Email_Address = :email
        )');
    $teamQuery->bindValue(':email', $email, SQLITE3_TEXT);
    $teamResult = $teamQuery->execute();
    $teamData = $teamResult->fetchArray(SQLITE3_ASSOC);
    $team_id = $teamData['Team_ID'] ?? 0;

    $query = $database->prepare('
        SELECT 
            t1.Team_Name || " vs " || t2.Team_Name as title, 
            m.Match_Date as match_date
        FROM Match m
        INNER JOIN Team t1 ON m.TeamA_ID = t1.Team_ID
        INNER JOIN Team t2 ON m.TeamB_ID = t2.Team_ID
        WHERE (m.TeamA_ID = :team_id OR m.TeamB_ID = :team_id)');
    $query->bindValue(':team_id', (int)$team_id, SQLITE3_INTEGER);
    $results = $query->execute();

    $events = [];
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $events[] = [
            'title' => $row['title'],
            'start' => $row['match_date']
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($events);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Schedule</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <style>
        .content { 
            padding: 20px;
            margin-left: 250px;
        }
        
        #calendar {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 20px auto;
        }
        
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .form-container h3 {
            margin: 0 0 10px 0;
            font-size: 1.1em;
            color: #153C57;
        }
        
        .form-container input {
            padding: 6px 10px;
            margin: 5px;
            border-radius: 3px;
            border: 1px solid #ddd;
            font-size: 0.9em;
        }
        
        .form-container button {
            padding: 6px 12px;
            margin: 5px;
            border-radius: 3px;
            border: none;
            background-color: #153C57;
            color: white;
            cursor: pointer;
            font-size: 0.9em;
        }
        
        .form-container button:hover {
            background-color: #1a5276;
        }
        
        h1 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

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
            background-color:#1e3c42;
        }

        /* the background color of today's date */
        .fc-day-today {
            background-color: #61727a !important; 
        }

        .fc-day:hover {
            background-color: #ab5757; /* background on hover */
            color:#b9b5b5;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    
    <div class="content">
        <header>
            <h1>Training Schedule</h1>
        </header>
        
        <div id="calendar"></div>
        
        <div class="form-container">
            <h3>Add Training Session</h3>
            <input type="text" id="trainingTitle" placeholder="Session title" />
            <input type="date" id="trainingDate" />
            <button onclick="addTraining()">Add</button>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                events: 'TrainingSchedule.php?fetch_matches=1',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                }
            });
            
            calendar.render();
            
            window.addTraining = function () {
                const title = document.getElementById('trainingTitle').value;
                const date = document.getElementById('trainingDate').value;
                
                if (title && date) {
                    calendar.addEvent({
                        title: title,
                        start: date,
                        allDay: true,
                        color: '#27ae60'
                    });
                    
                    document.getElementById('trainingTitle').value = '';
                    document.getElementById('trainingDate').value = '';
                } else {
                    alert("Please enter both a title and date.");
                }
            };
        });
    </script>
</body>
</html>