<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Team</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include ("sidebar2.php");
    ?>
    <div> <h2 class="centered_header">Add New Team</h2></div>

    <div class="main">
        <form action="AdminCreateTeamRecord.php" method="post">
            <input type="number" id="teamID" name="teamID" placeholder="Team ID (EG: 6)" required> 
            <input type="text" id="teamName" name="teamName" placeholder="Team Name" required> 
            <input type="text" id="city" name="city" placeholder="City" required> 
            <input type="text" id="managerID" name="managerID" placeholder="Manager ID (EG: MNG006)" required> 

            <button type="submit">Add Team</button>
        </form>
    </div>
</body>
</html>