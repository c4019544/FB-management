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
    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>

</body>
</html>