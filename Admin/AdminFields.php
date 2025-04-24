<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fields</title>
</head>

<body>
<div class="content">
    <header>
        <h1>Fields</h1>
    </header>

    <?php
    include("sidebar2.php");
    ?>

    <div>
        <a href="AdminCreateFieldPage.php">
            <button>Add New Field</button>
        </a>
    </div>

    <?php include("AdminViewFields.php"); ?>

</div>