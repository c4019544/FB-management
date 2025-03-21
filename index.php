<form action="../actions/login_user.php" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" value="submit">Login</button>
</form>
<style>
        form { font-family: Arial, sans-serif; text-align: center; }
        input{
            width: 100%;
            padding: 12px;
            margin: 20px 0;
            border: 2px solid black;
            border-radius: 10px;
        }
        button {
            padding:5px 15px; 
            background:#ccc; 
            border:0 none;
            cursor:pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }
    </style>
