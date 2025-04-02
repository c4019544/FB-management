<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/match_management/assets/css/style.css">
</head>
<body>
    <?php include '../includes/sidebar.php'; ?>

    <section class="content">
        <header>
            <h1>Dashboard</h1>
        </header>
        <!-- <p>Welcome to the Match Management System.</p> -->
        <div class="card-section">
            <div class="flex">
                <div class="upper-left-card">
                    <div class="card">
                        <h2>Match Overview Widget</h2>
                        <div class="table-container">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th colspan="3">Upcoming Matches</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Manchester Unites</td>
                                        <td>VS</td>
                                        <td>Liverpool</td>
                                    </tr>
                                    <tr>
                                        <td>Arsenal Tigers</td>
                                        <td>VS</td>
                                        <td>Real Madrid</td>
                                    </tr>
                                    <tr>
                                        <td>Sheffield United</td>
                                        <td>VS</td>
                                        <td>Barcelona</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <a class="custom-button" href="/match_management/pages/ViewMatchHistory.php">View Match Details</a>
                    </div>
                </div>

                <div class="upper-right-card">
                    <div class="card">
                        <h2>Incident Reporting Form</h2>
                        <form action="#" class="incident-form">
                            <label for="player_name">Player Name</label>
                            <input type="text" name="player_name">
                            <label for="team">Team</label>
                            <input type="text" name="team">
                            <label for="time">Time</label>
                            <input type="time" name="time">
                            <button class="custom-button">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
           
            <div class="flex">
                <div class="lower-left-card">
                    <div class="card">
                        <h2>Disciplinary Action And Results</h2>
                        <form action="#" class="incident-form">
                            <label for="yellow_card">Yellow Card</label>
                            <input type="text" name="yellow_card">
                            <label for="red_card">Red Card</label>
                            <input type="text" name="red_card">
                            <label >Match Results</label>
                            <div class="flex">
                                <label>Team 1:</label>
                                <input type="text" name="team1">
                            </div>
                            <div class="flex">
                                <label>Team 2:</label>
                                <input type="text" name="team2">
                            </div>
                            
                            <button class="custom-button">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="lower-right-card">
                    <div class="card">
                        <h2>Recent Activity Feed</h2>
                        <div class="table-container">
                            <table class="custom-table">
                                <!-- <thead>
                                    <tr>
                                        <th colspan="3">Upcoming Matches</th>
                                    </tr>
                                </thead> -->
                                <tbody>
                                    <tr>
                                       <td>Subitted Match Results</td>
                                    </tr>
                                    <tr>
                                        <td>Recent Assignemts and Reports Field</td>
                                    </tr>
                                    <tr>
                                        <td>Reported an incident of foul</td>
                                    </tr>
                                    <tr>
                                        <td>Issues red card to xy player</td>
                                    </tr>
                                    <tr>
                                        <td>reported incident of other irregularities</td>
                                    </tr>
                                    <tr>
                                        <td>submitted match results</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        
    </section>
</body>
<?php include '../includes/footer.php'; ?>
</html>
