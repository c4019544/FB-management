<?php
session_start();
if (!isset($_SESSION['user_id'])) {
header("Location: ../login.php");
exit();
}
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
                            <th>Time</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
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
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
