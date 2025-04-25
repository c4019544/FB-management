<?php
session_start();

$dbPath = __DIR__ . '/../fb_managment_system.db';

if (!file_exists($dbPath)) {
    die("Database file not found at: $dbPath");
}

try {
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in.");
}

$user_id = $_SESSION['user_id'];

// Get users for dropdown
$stmt = $db->prepare("SELECT User_ID, First_name, Last_name FROM Users WHERE User_ID != ?");
$stmt->execute([$user_id]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'], $_POST['receiver_id'])) {
    $stmt = $db->prepare("INSERT INTO Message (Sender_ID, Receiver_ID, Text_Message, Date_Time) VALUES (?, ?, ?, datetime('now'))");
    $stmt->execute([$user_id, $_POST['receiver_id'], $_POST['message']]);
}

// Get all messages involving this user
$stmt = $db->prepare("SELECT * FROM Message WHERE Sender_ID = ? OR Receiver_ID = ? ORDER BY Date_Time DESC");
$stmt->execute([$user_id, $user_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Messages</title>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        /* same CSS styles as before */
        .content { padding: 20px; }
        .message-form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #153C57;
        }
        .message-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .message-form select,
        .message-form textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .message-form button {
            background-color: #153C57;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .message-form button:hover {
            background-color: #0d2b3f;
        }
        .message-list {
            list-style-type: none;
            padding: 0;
        }
        .message-item {
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: white;
            border-left: 4px solid #153C57;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .message-item.sent {
            border-left-color: #2e7d32;
            background-color: #e8f5e9;
        }
        .message-item.received {
            border-left-color: #1565c0;
            background-color: #e3f2fd;
        }
        .message-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .message-time {
            color: #666;
            font-size: 0.9em;
        }
        .no-messages {
            padding: 20px;
            background-color: #f8f9fa;
            border-left: 4px solid #ffc107;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Messages</h1>
        </header>

        <div class="message-form">
            <h2>Send a Message</h2>
            <form method="post">
                <label for="receiver_id">Send To:</label>
                <select name="receiver_id" required>
                    <option value="">-- Select User --</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= htmlspecialchars($user['User_ID']) ?>">
                            <?= htmlspecialchars($user['First_name'] . ' ' . $user['Last_name']) ?> (ID: <?= htmlspecialchars($user['User_ID']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="message">Message:</label>
                <textarea name="message" placeholder="Type your message..." rows="4" required></textarea>

                <button type="submit">Send</button>
            </form>
        </div>

        <h2>Message History</h2>
        
        <?php if (empty($messages)): ?>
            <div class="no-messages">
                <p>No messages found.</p>
            </div>
        <?php else: ?>
            <ul class="message-list">
                <?php foreach ($messages as $msg): ?>
                    <li class="message-item <?= $msg['Sender_ID'] == $user_id ? 'sent' : 'received' ?>">
                        <div class="message-header">
                            <span>
                                <?php if ($msg['Sender_ID'] == $user_id): ?>
                                    You <small>(to User <?= htmlspecialchars($msg['Receiver_ID']) ?>)</small>
                                <?php else: ?>
                                    User <?= htmlspecialchars($msg['Sender_ID']) ?> <small>(sent to You)</small>
                                <?php endif; ?>
                            </span>
                            <span class="message-time"><?= htmlspecialchars($msg['Date_Time']) ?></span>
                        </div>
                        <div class="message-content"><?= htmlspecialchars($msg['Text_Message']) ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>
</body>
</html>
