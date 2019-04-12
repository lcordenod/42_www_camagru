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
            <h1>Register</h1>
            <p>Fill in this form to create your SnapCat account and make fun with amazing picture filters</p>
            <hr>
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>
            <label for="password"><b>Password</b></label>
            <input type="text" placeholder="Enter Password" name="password" required>
            <label for="password-rpt"><b>Repeat password</b></label>
            <input type="text" placeholder="Repeat Password" name="password-rpt" required>
            <hr>
            <button type="submit" class="register-btn">Register Now</button>
        </div>
        <div class="register-signin-link">
            <p>Already have an account? <a href="login.php">Log in here</a>.</p>
        </div>
    </form>
    </body>
</html>