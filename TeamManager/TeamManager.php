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
<<<<<<< HEAD

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

=======
>>>>>>> 66ad8da488ecad90cd3939de0324a682031dc610
</body>

</html>
