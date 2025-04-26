<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage User Roles</title>
  <link rel="stylesheet" href="style.css" />

  

  <body>
    <?php
    include("sidebar2.php");
    $db = new SQLite3('../fb_managment_system.db');
    $results = $db->query("SELECT User_ID, First_name, Last_name FROM Users");
    ?>

    <div class="role-container">
        <h2>Manage User Roles</h2>
        <form action="updateRole.php" method="post">
            <label for="user">User:</label><br>
            <select name="UserID" id="user">
                <?php
                while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                    echo "<option value='" . $row['User_ID'] . "'>" . $row['User_ID'] . " - " . $row['First_name'] . " " . $row['Last_name'] . "</option>";
                }
                $db->close();
                ?>
                </select><br>

                <label for="newRole">New Role:</label><br>
                <input type="text" name="newRole" id="newRole" placeholder="Enter New Role"><br>

                <button type="submit">Confirm</button>
        </form>
    </div>
</body>
</html>