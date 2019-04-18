<?php

require_once '../config/connect.php';

header('Content-Type: text/html; charset=utf-8');
session_start();

// DEBUGGING PHP
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-rpt']) && $_POST['submit'] !== "OK")
{
    $DB_con = db_connect();
    // GET INPUT
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('whirlpool', $_POST["password"]);
    $password_rpt = hash('whirlpool', $_POST["password-rpt"]);

    // CHECK INPUT INITIALISATION
    $username_check = $DB_con->prepare("SELECT COUNT(`user_name`) FROM user WHERE `user_name`=:username");
    $username_check->bindParam(':username', $username);
    $username_check->execute();
    $username_check = $username_check->fetchColumn();
    $email_check = $DB_con->prepare("SELECT COUNT(`user_email`) FROM user WHERE `user_email`=:email");
    $email_check->bindParam(':email', $email);
    $email_check->execute();
    $email_check = $email_check->fetchColumn();
    $password_diff = strcmp($password, $password_rpt);

    // ERROR MESSAGES
    $state = "display:none";
    $username_error = "Username already exists, please enter another one";
    $username_toolong = "Please make sure username is equal or less than 30 characters";
    $email_error = "Email is already used, please enter another one or connect with that one";
    $email_toolong = "Please make sure email is equal or less than 50 characters";
    $password_error = "Password entered isn't valid";
    $password_toolong = "Please make sure password is equal or less than 50 characters";

    // CHECK BEFORE SUBMIT
    if ($username_check)
    {
        $state = "display:block";
        $error_backend = $username_error;
        $myvar = array($state, $error_backend);
        console_log( $myvar );
    }
    else if ($email_check)
    {
        $state = "display:block";
        $error_backend = $email_error;
    }
    else if ($password_diff)
    {
        $state = "display:block";
        $error_backend = $password_error;
    }
    else if (strlen($username) > 30)
    {
        $state = "display:block";
        $error_backend = $username_toolong;
    }
    else if (strlen($email) > 50)
    {
        $state = "display:block";
        $error_backend = $email_toolong;
    }
    else if (strlen($_POST["password"]) > 30)
    {
        $state = "display:block";
        $error_backend = $password_toolong;
    }
    else
    {
        $submit = $DB_con->prepare("INSERT INTO user (`user_name`, user_email, user_pwd)
                            VALUES ('$username', '$email', '$password')");
        $submit->execute();
    }
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
            <input type="text" placeholder="Enter Username" name="username" id="username" maxlength="30" onfocusout="checkUsername()" required>
            <span id="error-username">Please enter a username</span>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" maxlength="50" onfocusout="checkEmail()" required>
            <span id="error-email">Please enter a valid email (example@email.com)</span>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" maxlength="30" onfocusout="checkPassword()" required>
            <span id="error-password">Please enter a valid password</span>
            <div id="password-message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <label for="password-rpt"><b>Repeat password</b></label>
            <input type="password" placeholder="Repeat Password" name="password-rpt" id="password-rpt" maxlength="30" onfocusout="checkRepeatPassword()" required>
            <span id="error-password-rpt">Please enter a password repeat that matches password</span>
            <hr>
            <button type="submit" id="register-btn" value="OK">Register Now</button>
            <span class="invalid" id="error-backend" style="<?php echo $state ?>"><?php echo $error_backend ?></span>
        </div>
        <div class="register-signin-link">
            <p>Already have an account? <a href="login.php">Log in here</a>.</p>
        </div>
    </form>
    <script type="text/javascript" src="../controller/register-check-input.js"></script>
    </body>
</html>