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
<title>Referee Performance</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>Referee Performance Report</h1>
    </header>
    <div class="card-section">
        <form action="#" class="referee-performance">
            <h2 class="heading">Match Details</h2>
            <div class="flex justify-space-around">
                <div class="match-details">
                    <label for="date" >Date: </label>
                    <input type="date" name="date" id="date" style="margin-left:61px;">
                    <br>
                    <label for="referee_name">Referee Name: </label>
                    <input type="text" name="referee_name" id="referee_name">
                </div>
                <div class="flex">
                    <p>Teams: England VS Spain</p>
                </div>
            </div>
            <br>
            <h2 class="heading">Referee Assessment Criteria</h2>
            <div class="table-container">
                <table class="custom-table history-table" style="border:0px;">
                    <tbody>
                        <tr>
                            <th rowspan="2">Decision Making</th>
                            <td>Panelty Decision</td>
                            <td>Foul and Free Kicks</td>
                            <td>Offside Calls</td>
                        </tr>
                        <tr>
                            <td>Good</td>
                            <td>Average</td>
                            <td>Poor</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <th rowspan="2">Game Management and Control</th>
                            <td>Disipline</td>
                            <td>Advantage Rule</td>
                            <td>Managing Player</td>
                        </tr>
                        <tr>
                            <td>Good</td>
                            <td>Average</td>
                            <td>Poor</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>   
                        <tr>
                            <th rowspan="2">Disciplinary Actions</th>
                            <td>Correct Issuance of Yellow Cards <div class="yellow-card"></div></td>
                            <td>Correct Issuance of Red Cards <div class="red-card"></div></td>
                        </tr>
                        <tr>
                            <td>Good</td>
                            <td>Average</td>
                            <td>Poor</td>
                        </tr>
                    </tbody>
            
                </table>
        </form>
    </div>
</div>
</body>
</html>
