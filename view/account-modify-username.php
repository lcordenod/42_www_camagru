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
    </head>
    <body onload="disableConfirmUsernameButton()">
    <?php
    include('header.php')
    ?>
    <form action="" method="POST" id="password-sendemail-form" onfocusout="disableConfirmUsernameButton()">
        <div class="register-container">
            <h1>Modify account username</h1>
            <p>Please enter the new username you want to use for your SnapCat account</p>
            <hr>
            <label for="username"><b>New Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" maxlength="30" onfocusout="checkUsername()" required>
            <span id="error-username">Please enter a valid username (only letters and numbers)</span>
            <hr>
            <button type="submit" id="confirm-username-btn" value="OK">Confirm username</button>
            <span class="invalid" id="error-backend" style="<?php echo $state ?>"><?php echo $error_backend ?></span>
            <button id="account-modify-btn" onclick="window.history.back();">Cancel</button>
        </div>
    </form>
    <?php
    include('footer.php')
    ?>
    <script type="text/javascript" src="../javascript/register-check-input.js"></script>
    <script type="text/javascript" src="../javascript/account-modify.js"></script>
    </body>
</html>
