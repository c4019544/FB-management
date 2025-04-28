<?php
$fieldPlanner = [
  "Friday 7th March 2025",
  "Saturday 8th March 2025",
  "Sunday 9th March 2025",
  "Monday 10th March 2025",
  "Tuesday 11th March 2025",
  "Wednesday 12th March 2025",
  "Thursday 13th March 2025"
];

$bookings = array_fill(0, 5, "PENDING: Field 1 Booking 23/03/2025 - 6pm to 9pm");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Field Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
    <style>
            .dashboard {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 220px;
      background: #0c1a2c;
      color: #fff;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }
    .sidebar h1 {
      font-size: 18px;
      margin-bottom: 30px;
    }
    .menu {
      list-style: none;
      padding: 0;
    }
    .menu li {
      margin: 15px 0;
      cursor: pointer;
    }
    .menu li:hover {
      text-decoration: underline;
    }
    .main-content {
      flex: 1;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #0c1a2c;
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
    }
    .widgets {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      margin-top: 20px;
    }
    .widget {
      background: #06253a;
      color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .widget h3 {
      margin-top: 0;
    }
    .widget ul {
      list-style: none;
      padding: 0;
    }
    .widget li {
      margin: 10px 0;
      font-size: 14px;
    }
    button {
      margin-top: 10px;
      padding: 8px 16px;
      border: none;
      background: #3498db;
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #2980b9;
    }
    .footer {
      margin-top: auto;
      background: #0c1a2c;
      color: #ccc;
      text-align: center;
      padding: 10px;
      font-size: 13px;
      display: flex;
      justify-content: space-around;
    }
    canvas {
      background: #fff;
      border-radius: 5px;
      margin-top: 15px;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include 'Sidebar.php'; ?>

       
    <div class="content">
        <header>
            <h1>Field Owner Dashboard</h1>
        </header>

        <div class="dashboard">
            <main class="main-content">
                <header class="top-bar">
                <div>Main artboard</div>
                <div>👤 Username</div>
                </header>

                <div class="widgets">
                <!-- Field Planner -->
                <div class="widget">
                    <h3>🗓️ Field Planner</h3>
                    <ul>
                    <?php foreach ($fieldPlanner as $date): ?>
                        <li><?= htmlspecialchars($date) ?></li>
                    <?php endforeach; ?>
                    </ul>
                    <button>View Planner</button>
                </div>

                <!-- Booking Analytics -->
                <div class="widget">
                    <h3>📊 Booking Analytics</h3>
                    <canvas id="bookingChart" height="200"></canvas>
                </div>

                <!-- Recent Bookings -->
                <div class="widget">
                    <h3>📝 Recent Booking Requests</h3>
                    <ul>
                    <?php foreach ($bookings as $booking): ?>
                        <li><?= htmlspecialchars($booking) ?></li>
                    <?php endforeach; ?>
                    </ul>
                    <button>View Bookings</button>
                </div>

                <!-- Match Schedule -->
                <div class="widget">
                    <h3>🏆 Match Schedule</h3>
                    <p>No upcoming matches scheduled.</p>
                    <button>View Schedule</button>
                </div>

                <!-- Notifications -->
                <div class="widget">
                    <h3>🔔 Notifications</h3>
                    <p>No new notifications.</p>
                    <button>View Notifications</button>
                </div>
                </div>

                <footer class="footer">
                <span>Terms and Conditions</span>
                <span>Field Policies</span>
                <span>Customer Support</span>
                </footer>
            </main>
        </div>
    </div>
   
    <!-- <script>
        var mySidebar = document.querySelector('Sidebar')
        var sidebar = new coreui.Sidebar(mySidebar)
    </script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>