<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/account-modify-controller.php';

if (!($_SESSION['auth']))
{
    header("Location: /camagru/index.php");
    return;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="shortcut icon" type="image/png" href="/camagru/sources/cat-img.png"/>
    </head>
    <body onload="disableResetPasswordButton()">
    <?php
    include('header.php')
    ?>
    <form action="" method="POST" id="password-sendemail-form">
        <div class="register-container">
            <h1>Modify account email</h1>
            <p>Please enter the new email you want to use for your SnapCat account</p>
            <hr>
            <label for="email"><b>New Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" maxlength="50" onkeyup="checkEmail();disableResetPasswordButton()" required>
            <span id="error-email">Please enter a valid email (example@email.com)</span>
            <hr>
            <button type="submit" id="reset-password-btn" value="OK">Confirm email</button>
            <span class="invalid" id="error-backend" style="<?php echo $state ?>"><?php echo $error_backend ?></span>
            <button id="account-modify-btn" onclick="window.history.back();">Cancel</button>
        </div>
    </form>
    <?php
    include('footer.php')
    ?>
    <script type="text/javascript" src="../javascript/register-check-input.js"></script>
    <script type="text/javascript" src="../javascript/forgot-password.js"></script>
    </body>
</html>
