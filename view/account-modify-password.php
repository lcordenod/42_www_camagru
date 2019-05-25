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
    <body onload="disableSavePasswordButton()">
    <?php
    include('header.php')
    ?>
    <form action="" method="POST" id="register-form" onfocusout="disableSavePasswordButton()">
        <div class="register-container">
            <h1>Modify account password</h1>
            <p>Please enter the new password you want to use for your SnapCat account</p>
            <hr>
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
            <button type="submit" id="save-password-btn" value="OK">Register Now</button>
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