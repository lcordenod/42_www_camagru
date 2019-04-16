<?php

require_once '../config/connect.php';

header('Content-Type: text/html; charset=utf-8');
session_start();

if ($_POST['username'] !== '' && $_POST['email'] !== '' && $_POST['password'] !== '' && $_POST['password-rpt'] !== '' && $_POST['submit'] !== "OK")
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password']);
    $password_rpt = password_hash($_POST['password-rpt']);

/*     $username_check = $DB_con->exec("SELECT username FROM user WHERE username='$username'");
    $email_check = $DB_con->exec("SELECT email FROM user WHERE email='$email'");
    
    if ($username_check !== '' && $email_check !== '')
    {
        $DB_con->exec("INSERT INTO user
                    SET username = '$username'
                    ");
    }
    else
        return (false); */
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body onload="disableSubmitButton()">
    <?php
    include('header.php')
    ?>
    <form action="" method="POST" id="register-form" onfocusout="disableSubmitButton()">
        <div class="register-container">
            <h1>Register</h1>
            <p>Fill in this form to create your SnapCat account and make fun with amazing picture filters</p>
            <hr>
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" onfocusout="checkUsername()" required>
            <span id="error-username">Please enter a username</span>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" onfocusout="checkEmail()" required>
            <span id="error-email">Please enter a valid email (example@email.com)</span>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" onfocusout="checkPassword()" required>
            <span id="error-password">Please enter a valid password</span>
            <div id="password-message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <label for="password-rpt"><b>Repeat password</b></label>
            <input type="password" placeholder="Repeat Password" name="password-rpt" id="password-rpt" onfocusout="checkRepeatPassword()" required>
            <span id="error-password-rpt">Please enter a password repeat that matches password</span>
            <hr>
            <button type="submit" id="register-btn" value="OK">Register Now</button>
        </div>
        <div class="register-signin-link">
            <p>Already have an account? <a href="login.php">Log in here</a>.</p>
        </div>
    </form>
    <script type="text/javascript" src="../controller/register-check-input.js"></script>
    </body>
</html>