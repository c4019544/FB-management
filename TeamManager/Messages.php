<?php
$database = new SQLite3('../fb_managment_system.db');

$query = "SELECT Message_ID, Sender_ID, Receiver_ID, Date_Time, Text_Message FROM Message ORDER BY Date_Time DESC";
$results = $database->query($query);

if (!$results) {
    die("Query failed: " . $database->lastErrorMsg());
}
?>


<!DOCTYPE html>
<html lang="en">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>


<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Messages</h1>
        </header>
        <h2>All Messages</h2>
        <table>
            <tr>
                <th>Message ID</th>
                <th>Sender ID</th>
                <th>Receiver ID</th>
                <th>Date & Time</th>
                <th>Message</th>
            </tr>
            <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['Message_ID']); ?></td>
                <td><?php echo htmlspecialchars($row['Sender_ID']); ?></td>
                <td><?php echo htmlspecialchars($row['Receiver_ID']); ?></td>
                <td><?php echo htmlspecialchars($row['Date_Time']); ?></td>
                <td><?php echo htmlspecialchars($row['Text_Message']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
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