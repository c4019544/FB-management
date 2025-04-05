<?php
// session_start();
// if (!isset($_SESSION['user_id'])) {
// header("Location: ../login.php");
// exit();
// }
?>
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
                <form action="#">
                    <table class="custom-table history-table" style="border:0px;">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center">Results</th>
                            </tr>
                        
                        </thead>
                        <tbody  class="submit-result">
                            <tr>
                                <th class="sub-headings">Team 1 Name</th>
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
                            </tr>
                            
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
