<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("sidebar2.php");
    ?>
    <div> <h2 class="centered_header">Create New User</h2></div>

    <div class="main">
        <form action="AdminCreateUserRecord.php" method="post">
            <input type="text" id="user_id" name="user_id" placeholder="User ID" required>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
            <input type="text" id="dob" name="dob" placeholder="Date Of Birth (EG:1990-05-22)" required>
            <input type="text" id="email" name="email" placeholder="Email Address" required>
            <input type="text" id="telNo" name="telNo" placeholder="Phone Number" required>
            <input type="text" id="role" name="role" placeholder="Role (Manager, Referee, Player, Field Owner)" required>
            <input type="text" id="gender" name="gender" placeholder="Gender" required>
            <input type="text" id="password" name="password" placeholder="Default Password" required>

            <button type="submit">Create User</button>
        </form>
    </div>
</body>
</html>