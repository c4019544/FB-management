<div>
<action="../actions/login_user.php" method="post">
    <img src="/images/Logo.png" alt="Logo">
    <br><br>
    <input type="email" name="email" placeholder="Email" required>
    <br><br>
    <input type="password" name="password" placeholder="Password" required>
    <br><br>
    <button type="submit" value="submit">Login</button>
    <br>
    <button type="submit" value="submit">Sign up</button>
</form>
</div>
<style>
        form {
    font-family: Arial, sans-serif;
    text-align: center;
}

img {
    display: block;
    margin: 0 auto;
}

input {
    width: 100%;
    padding: 20px;
    width: 700px;
    border: 2px solid black;
    border-radius: 10px;
}

button {
    display: block;  
    font-family: Arial, sans-serif;
    text-align: center;
    margin: 0 auto;         
    padding: 10px 40px;
    background: #ccc;
    background-color: white;
    border: 0 none;
    cursor: pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    border-color: solid black;
}

body,
html {
    height: 100%;
    margin: 0;
    display: grid;
    place-items: center;
    background-color: #153C57;
}

.img-container {
    place-content: center;
    padding: 40px;
    border: 2px solid #ccc;
}

.form-container {
    padding: 40px;
    border: 2px solid #ccc;
    background-color: #f9f9f9;
}

.button-container {
    place-items: center;
    padding: 40px;
    border: 2px solid #ccc;
}

</style>
