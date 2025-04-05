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
<title>Incident Reports</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>Incident Reports</h1>
    </header>
    <p class="text-center">View Incident Report</p>
    <div class="card-section">
        <div class="table-container">
            <table class="custom-table history-table">
                <thead>
                    <tr>
                        <th>Player Name</th>
                        <th>Team</th>
                        <th>Time</th>
                        <th>Incident</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Messi</td>
                        <td>Argentina</td>
                        <td>45'</td>
                        <td>Dangerious tackle on an opponent</td>
                    </tr>
                    <tr>
                        <td>Ronaldo</td>
                        <td>Portugal</td>
                        <td>18'</td>
                        <td>Foul to stop a counter attack</td>
                    </tr>
                    <tr>
                        <td>Ronaldo</td>
                        <td>Portugal</td>
                        <td>18'</td>
                        <td>Foul to stop a counter attack</td>
                    </tr>
                    <tr>
                        <td>Ronaldo</td>
                        <td>Portugal</td>
                        <td>18'</td>
                        <td>Foul to stop a counter attack</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
