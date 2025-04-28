<?php
// session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}
?>

<div class="sidebar">
    <h2>Referee</h2>
    <ul>
        <li><a href="../pages/Dashboard.php">Dashboard</a></li>

        <li><a href="../pages/MatchSchedule.php">Match Schedule</a></li>

        <li><a href="../pages/IncidentReports.php">Incident Reports</a></li>
        <li><a href="../pages/DisciplinaryAction.php">Disciplinary Action</a></li>
        
        <li><a href="../pages/UpcomingMatches.php">Upcoming Matches</a></li>
        <li><a href="../pages/SubmitResults.php">Submit Results</a></li>



        <!-- More sections -->
        <li class="has-submenu">
            <a href="#">Match Statistics <span class="dropdown-arrow">▶</span></a>
            <ul>
                <li><a href="../pages/ViewMatchHistoryList.php">View Match History</a></li>
                <li><a href="../pages/RefereePerformance.php">Referee Performance</a></li>

            </ul>
        </li>

        <li><a href="../pages/Settings.php">Settings</a></li>
        <li><a href="../Logout.php">Logout</a></li>
    </ul>
</div>

<script src="../assets/js/sidebar.js"></script> <!-- Link your JavaScript file -->

