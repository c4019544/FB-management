<?php
// if (!isset($_SESSION['email'])) {
//     header('Location: ../index.php');
//     exit();
// }

if (isset($_POST['booking_id']) && isset($_POST['booking_status'])) {
    $booking_id = $_POST['booking_id'];
    $booking_status = $_POST['booking_status'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $field_id = $_POST['field_id'];

    // echo "Booking ID: $booking_id\n";
    // echo "Booking Status: $booking_status\n";

    $db = new SQLite3('../fb_managment_system.db');
    
    $query = $db->prepare('
        SELECT COUNT(*) 
        FROM Field_Booking
        WHERE Field_ID = :field_id 
        AND Booking_Status = "Confirmed"
        AND Booking_Date = :date 
        AND Booking_Time = :time
        AND Booking_ID != :booking_id');
    $query->bindValue(':field_id', $field_id, SQLITE3_TEXT);
    $query->bindValue(':date', $booking_date, SQLITE3_TEXT);
    $query->bindValue(':time', $booking_time, SQLITE3_TEXT);
    $query->bindValue(':booking_id', $booking_id, SQLITE3_TEXT);

    $count_conflicts = $query->execute()->fetchArray(SQLITE3_ASSOC)['COUNT(*)'];

    if ($count_conflicts > 0) {
        echo "<script>
            alert('There is already a booking confirmed at this date and time for the field.');
            window.location.href = 'Bookings.php';
            </script>";
        exit();
    }

    $db = new SQLite3('../fb_managment_system.db');

    $stmt = $db->prepare('UPDATE Field_Booking SET Booking_Status = :status WHERE Booking_ID = :id');
    $stmt->bindValue(':status', $booking_status, SQLITE3_TEXT);
    $stmt->bindValue(':id', $booking_id, SQLITE3_TEXT);

    if ($stmt->execute()) {
        header('Location: Bookings.php');
        exit();
    } else {
        echo "Failed to update status.";
    }

    $db->close();
} else {
    echo "Missing booking id or status.";
}
?>
