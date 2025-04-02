<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
 
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }




        .sidebar {
            width: 250px;
            background-color: #153C57;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding-top: 20px;
            padding-left: 10px;
        }


        .sidebar h2 {
            color: #ecf0f1;
            font-size: 24px;
            margin-bottom: 30px;
        }


        .sidebar ul {
            list-style: none;
            padding: 0;
        }


        .sidebar ul li {
            padding: 15px;
            text-align: left;
            margin: 10px 0;
            border-radius: 5px;
            cursor: pointer;
        }


        .sidebar ul li:hover {
            background-color:rgb(32, 88, 129);
        }




        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }




        .content header {
            background-color: #ecf0f1;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }


        .content header h1 {
            margin: 0;
        }


    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li>Dashboard</li>
            <li>Users</li>
            <li>Teams</li>
            <li>Matches</li>
            <li>Reports</li>
            <li>Settings</li>
        </ul>
    </div>


    <div class="content">
        <header>
            <h1>Admin Dashboard
            </h1>
        </header>
    </div>
</body>
</html>
