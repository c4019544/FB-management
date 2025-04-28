<?php
<<<<<<< HEAD
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
exit();
}
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
<title>Match Schedule</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>Match Schedule</h1>
    </header>
    <div class="card-section">
        <div class="card">
            <div class="table-container">
                <form action="#">
                    <table class="custom-table history-table" style="border:0px;">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center">Match Schedule</th>
                            </tr>
                        
                        </thead>
                        <tbody  class="submit-result">
                            <tr>
                                <th class="sub-headings">Team 1 Name</th>
                                <th><input type="text" name="team1" id="team1"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Team 2 Name</th>
                                <th><input type="text" name="team2" id="team2"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Location</th>
                                <th><input type="text" name="location" id="location"></th>
                            </tr>
                            <tr>
<<<<<<< HEAD
                                <th class="sub-headings">Date</th>
                                <th><input type="date" name="date" id="date"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Time</th>
                                <th><input type="text" name="time" id="time"></th>
                            </tr>
                            <tr>
                                <th class="sub-headings">Match Length</th>
                                <th><input type="number" name="Match_length" id="Match_length"></th>
                            </tr>
=======
                                <th class="sub-headings">Time</th>
                                <th><input type="text" name="time" id="time"></th>
                            </tr>
>>>>>>> jamie
                            
                            
                            
                        </tbody>
                    </table>
                    <button class="custom-button">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
