<?php
session_start();
if (!isset($_SESSION['user_id'])) {
header("Location: ../login.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Match History</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<div class="content">
    <header>
        <h1>View Match History</h1>
    </header>
    <div class="card-section">
        <div class="table-container">
            <table class="custom-table history-table">
                <thead>
                    <tr>
                        <th colspan="2">England</th>
                        <th colspan="1">12</th>
                        <th colspan="2" class="VS"><div class="vs-background">VS</div></th>
                        <th colspan="2">Spain</th>
                        <th colspan="1">15</th>
                    </tr>
                    <tr class="sub-headings">
                        <th>Players</th>
                        <th>Goal</th>
                        <th>Time</th>
                        <th>Red/Yellow Card</th>

                        <th class="border-left-bold">Players</th>
                        <th>Goal</th>
                        <th>Time</th>
                        <th>Red/Yellow Card</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lionel Messi</td>
                        <td>2</td>
                        <td>13'</td>
                        <td class="flex">
                            <div class="yellow-card"></div>
                            <div class="white-card"></div>
                        </td>

                        <td class="border-left-bold">Pedri</td>
                        <td>1</td>
                        <td>11'</td>
                        <td class="flex">
                            <div class="red-card"></div>
                            <div class="white-card"></div>
                        </td>

                    </tr>
                    <tr>
                        <td>Lionel Messi</td>
                        <td>2</td>
                        <td>13'</td>
                        <td class="flex">
                            <div class="yellow-card"></div>
                            <div class="white-card"></div>
                        </td>

                        <td class="border-left-bold">Pedri</td>
                        <td>1</td>
                        <td>11'</td>
                        <td class="flex">
                            <div class="red-card"></div>
                            <div class="white-card"></div>
                        </td>

                    </tr>
                    <tr>
                        <td>Lionel Messi</td>
                        <td>2</td>
                        <td>13'</td>
                        <td class="flex">
                            <div class="yellow-card"></div>
                            <div class="white-card"></div>
                        </td>

                        <td class="border-left-bold">Pedri</td>
                        <td>1</td>
                        <td>11'</td>
                        <td class="flex">
                            <div class="red-card"></div>
                            <div class="white-card"></div>
                        </td>

                    </tr>
                    <tr>
                        <td>Lionel Messi</td>
                        <td>2</td>
                        <td>13'</td>
                        <td class="flex">
                            <div class="yellow-card"></div>
                            <div class="white-card"></div>
                        </td>

                        <td class="border-left-bold">Pedri</td>
                        <td>1</td>
                        <td>11'</td>
                        <td class="flex">
                            <div class="red-card"></div>
                            <div class="white-card"></div>
                        </td>

                    </tr>
                    <tr>
                        <td>Lionel Messi</td>
                        <td>2</td>
                        <td>13'</td>
                        <td class="flex">
                            <div class="yellow-card"></div>
                            <div class="white-card"></div>
                        </td>

                        <td class="border-left-bold">Pedri</td>
                        <td>1</td>
                        <td>11'</td>
                        <td class="flex">
                            <div class="red-card"></div>
                            <div class="white-card"></div>
                        </td>

                    </tr>
                    <tr>
                        <td>Lionel Messi</td>
                        <td>2</td>
                        <td>13'</td>
                        <td class="flex">
                            <div class="yellow-card"></div>
                            <div class="white-card"></div>
                        </td>

                        <td class="border-left-bold">Pedri</td>
                        <td>1</td>
                        <td>11'</td>
                        <td class="flex">
                            <div class="red-card"></div>
                            <div class="white-card"></div>
                        </td>

                    </tr>
                    <tr>
                        <td>Lionel Messi</td>
                        <td>2</td>
                        <td>13'</td>
                        <td class="flex">
                            <div class="yellow-card"></div>
                            <div class="white-card"></div>
                        </td>

                        <td class="border-left-bold">Pedri</td>
                        <td>1</td>
                        <td>11'</td>
                        <td class="flex">
                            <div class="red-card"></div>
                            <div class="white-card"></div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <p>Welcome to the Match Management System. - View Match History</p> -->
</div>
</body>
</html>
