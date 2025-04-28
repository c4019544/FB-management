<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams</title>
</head>

<body>
<div class="content">
    <header>
        <h1>Teams</h1>
    </header>

    <?php
    include("sidebar2.php");
    ?>

    <div>
        <a href="AdminCreateTeamPage.php">
            <button>Add New Team</button>
        </a>
    </div>

    <?php include("AdminViewTeams.php"); ?>

</div>