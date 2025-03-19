<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .sidebar {
            background-color: #333;
            overflow: hidden;
            padding: 10px;
            text-align: center;
        }
        .sidebar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            display: inline-block;
        }
        .sidebar a:hover {
            background-color: #ddd;
            color: black;
        }
        .chart-container {
            width: 50%;
            margin: auto;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <!-- Side Bar -->
    <div class="Sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="withdraw.php">Withdraw</a>
        <a href="deposit.php">Deposit</a>
        <a href="transfer.php">Transfer Money</a>
        <a href="exchangerates.php">Exchange Rates</a>

        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
            <a href="admin.php" style="color: yellow;">Admin</a>
        <?php endif; ?>

        <a href="../actions/logout.php" style="float:right;">Logout</a>
    </div>
</body>
</html>
