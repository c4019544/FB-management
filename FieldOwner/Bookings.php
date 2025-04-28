<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings | Field Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <?php include 'Sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Bookings</h1>
        </header>
    

        <section class="col">
            <div class="bg-image h-100" style="background-color: #f5f7fa;">
                <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                    <div class="col">
                        <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive table-scroll field-table" data-mdb-perfect-scrollbar="true" style="position: relative;">

                            <?php
                                session_start();

                                if (!isset($_SESSION['email'])) {
                                    header("Location: ../index.php");
                                    exit();
                                }

                                $email = $_SESSION['email'];

                                $db = new SQLite3('../fb_managment_system.db');

                                $stmt = $db->prepare('
                                    SELECT
                                    Field_Booking.Field_ID,
                                    Field_Booking.Booking_ID,
                                    Field.Field_name AS field_name,
                                    Team.Manager_ID AS manager_id,
                                    Field_Booking.Booking_Date,
                                    Field_Booking.Booking_Time,
                                    Field_Booking.Booking_Duration,
                                    Field_Booking.Booking_Status
                                    FROM Field_Booking
                                    INNER JOIN Field ON Field_Booking.Field_ID = Field.Field_ID
                                    INNER JOIN Users ON Field.FieldOwner_ID = Users.User_ID
                                    INNER JOIN Team on Field_Booking.Manager_ID = Team.Manager_ID                                    
                                    WHERE Users.Email_Address = :email
                                ');

                                $stmt->bindValue(':email', $email, SQLITE3_TEXT);
                                $result = $stmt->execute();

                                

                                if (!$result) {
                                    echo "Error fetching data.";
                                } else {
                                    
                                    echo "<table class='table table-striped mb-0'>
                                <thead style='background-color: #002d72;'>
                                    <tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>Field</th>
                                        <th scope='col'>Team Manager</th>
                                        <th scope='col'>Date</th>
                                        <th scope='col'>Time</th>
                                        <th scope='col'>Duration</th>
                                        <th scope='col'>Status</th>
                                    </tr>
                                </thead>";

                                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                        echo "<tr>
                                                <td>" . htmlspecialchars($row['Booking_ID']) . "</td>
                                                <td>" . htmlspecialchars($row['field_name']) . "</td>
                                                <td>" . htmlspecialchars($row['manager_id']) . "</td>
                                                <td>" . htmlspecialchars($row['Booking_Date']) . "</td>
                                                <td>" . htmlspecialchars($row['Booking_Time']) . "</td>
                                                <td>" . htmlspecialchars($row['Booking_Duration']) . " hours</td>
                                                <td>
                                                    <form method='POST' action='UpdateBookingStatus.php' style='display: inline-block;'>
                                                        <input type='hidden' name='booking_id' value='" . htmlspecialchars($row['Booking_ID']) . "'>
                                                        <input type='hidden' name='field_id' value='" . htmlspecialchars($row['Field_ID']) . "'>
                                                        <input type='hidden' name='booking_date' value='" . htmlspecialchars($row['Booking_Date']) . "'>
                                                        <input type='hidden' name='booking_time' value='" . htmlspecialchars($row['Booking_Time']) . "'>
                                                        <select name='booking_status' required>
                                                            <option value='Pending' " . ($row['Booking_Status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                                            <option value='Confirmed' " . ($row['Booking_Status'] == 'Confirmed' ? 'selected' : '') . ">Confirmed</option>
                                                        </select>
                                                        <button type='submit' class='btn btn-sm btn-primary'>Update</button>
                                                    </form>
                                                </td>
                                            </tr>";
                                    }

                                    echo "</table>";
                                }

                                $db->close();
                            ?>


                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>