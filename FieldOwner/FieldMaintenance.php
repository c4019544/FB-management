<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Maintenance | Field Owner</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, button { width: 100%; padding: 10px; box-sizing: border-box; font-size: 1em; border-radius: 5px; border: 1px solid #ddd; margin-bottom: 10px; }
        button { background-color: #0056b3; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .form-group input, .form-group select { font-size: 1em; }
        .form-group input[type="date"] { padding: 9px; }
    </style>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <?php include 'Sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Field Maintenance</h1>
        </header>

        <div class="container">
            <form action="../actions/register_user.php" method="post">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input type="text" name="surname" placeholder="Surname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" placeholder="Address" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="currency">Preferred Currency:</label>
                    <select name="currency" required>
                        <option value="USD">USD - US Dollar</option>
                        <option value="EUR">EUR - Euro</option>
                        <option value="GBP">GBP - British Pound</option>
                        <option value="JPY">JPY - Japanese Yen</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>
</html>