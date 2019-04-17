<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
    <?php
    include('header.php')
    ?>
    <form action="" id="register-form">
        <div class="register-container">
            <h1>Log In</h1>
            <p>Please enter your account details in order to log in to SnapCat</p>
            <hr>
            <label for="email"><b>Username or Email</b></label>
            <input type="text" placeholder="Enter Username or Email" name="username-email" required>
            <label for="password"><b>Password</b></label>
            <input type="text" placeholder="Enter Password" name="password" required>
            <hr>
            <button type="submit" id="login-btn" value="OK">Log In</button>
        </div>
        <div class="register-signin-link">
            <p>Forgotten your password? <a href="forgot-password.php">Retrieve it here</a>.</p>
        </div>
    </form>
    </body>
</html>