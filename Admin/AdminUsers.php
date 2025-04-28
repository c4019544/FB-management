<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | Admin</title>
</head>

<body>
<div class="content">
    <header>
        <h1>Users</h1>
    </header>
    
    <?php
        include("sidebar2.php");    
    ?>

    <div>
        <a href="AdminCreateUserPage.php">
            <button>Add New User</button>
        </a>
    </div>

    <?php include("AdminManageUserRole.php"); ?>

    <div>
        <a href="AdminViewUsers.php">
            <button>View All Users</button>
        </a>
    </div>
</div>