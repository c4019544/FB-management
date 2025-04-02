<?php
$db = new PDO('sqlite:fb_management.db');
$query = 'SELECT Room_Status, COUNT(*) as count FROM Room GROUP BY Room_Status';
$stmt = $db->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($row['Room_Status'] == 'Occupied') {
        $occupiedRooms = $row['count'];
    } elseif ($row['Room_Status'] == 'Available' || $row['Room_Status'] == 'Maintenance') {
        $emptyRooms = $emptyRooms + $row['count'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Manager</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #chartContainer {
            width: 50%; 
            margin: 0 auto; 
            padding-top: 20px; 
        }

        #StatsChart a{
            width: 100% !important; 
            height: 400px;          
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #153C57;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding-top: 20px;
            padding-left: 10px;
        }

        .sidebar h2 {
            color: #ecf0f1;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
            text-align: left;
            margin: 10px 0;
            border-radius: 5px;
            cursor: pointer;
        }

        .sidebar ul li:hover {
            background-color: rgb(32, 88, 129);
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .content header {
            background-color: #ecf0f1;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .content header h1 {
            margin: 0;
        }

        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <header>
            <h1>Team Dashboard</h1>
        </header>
    </div>
    <div id="chartContainer">
        <canvas id="occupancyChart"></canvas>
    </div>

    <script>
        var occupiedRooms = <?php echo $occupiedRooms; ?>;
        var emptyRooms = <?php echo $emptyRooms; ?>;

        var ctx = document.getElementById('occupancyChart').getContext('2d');
        var occupancyChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Occupied Rooms', 'Empty Rooms'],
                datasets: [{
                    label: 'Room Occupancy',
                    data: [occupiedRooms, emptyRooms], 
                    backgroundColor: ['#ff9999', '#66b3ff'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false 
            }
        });
    </script>
</body>

</html>
