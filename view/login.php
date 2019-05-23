<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/login-controller.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body onload="disableLoginButton()">
    <?php
    include('header.php')
    ?>
    <form action="" method="POST" id="login-form">
        <div class="register-container">
            <h1>Log In</h1>
            <p>Please enter your account details in order to log in to SnapCat</p>
            <hr>
            <label for="email"><b>Username or Email</b></label>
            <input type="text" placeholder="Enter Username or Email" name="username-email" id="username-email" maxlength="50" onfocusout="checkUsernameEmailLogin();disableLoginButton()" required>
            <span id="error-username-email">Please enter a valid username or email</span>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password-login" id="password-login" maxlength="30" onkeyup="checkPasswordLogin();disableLoginButton()" required>
            <span id="error-password-login">Please enter a valid password</span>
            <hr>
            <button type="submit" id="login-btn" value="OK">Log In</button>
            <span class="invalid" id="error-backend" style="<?php echo $state ?>"><?php echo $error_backend ?></span>
        </div>
        <div class="register-signin-link">
            <p>Forgotten your password? <a href="forgot-password-reset.php">Retrieve it here</a>.</p>
        </div>
    </form>
    <?php
    include('footer.php')
    ?>
    <script type="text/javascript" src="../javascript/login-check-input.js"></script>
    </body>
</html>