<!-- Dashboard for Team Manager -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Manager</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../styles/style.css">
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

<footer class="footer">
    <p>goikontech@gmail.com</p>
    <a href="#">Terms of use</a>
    <a href="#">Support</a>
    <a href="#">Policies</a>
  </footer>

</body>
<style>

.footer {
    position: fixed;
    left: 250px;
    bottom: 0;
    width: calc(100% - 250px);
    background-color: #153C57;
    color: white;
    text-align: center;
    padding: 15px 0;
    z-index: 99;
    box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
}

.footer p {
    margin: 0;
    display: inline-block;
    margin-right: 15px;
}

.footer a {
    color: white;
    text-decoration: none;
    margin: 0 10px;
    transition: color 0.3s;
}

.footer a:hover {
    color: #4CAF50;
}

@media (max-width: 768px) {
    .sidebar {
        width: 200px;
    }
    
    .content {
        margin-left: 200px;
        width: calc(100% - 200px);
    }
    
    .footer {
        left: 200px;
        width: calc(100% - 200px);
    }
}


</style>
</body>

</html>
