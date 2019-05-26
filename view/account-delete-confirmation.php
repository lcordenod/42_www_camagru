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
    <body onload="disableDeleteButton()">
    <?php
    include('header.php')
    ?>
    <form action="" method="POST" id="register-form">
        <div class="register-container">
            <h1>Delete your account</h1>
            <p>If you are sure you want to delete your account, please confirm by entering your password</p>
            <hr>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password-login" maxlength="30" onkeyup="checkPasswordDelete();disableDeleteButton()" required>
            <span id="error-password-login">Please enter a valid password</span>
            <hr>
            <button type="submit" id="delete-account-btn" value="DEL">Delete account</button>
            <span class="invalid" id="error-backend" style="<?php echo $state ?>"><?php echo $error_backend ?></span>
            <button id="account-modify-btn" onclick="location.href='/camagru/view/account.php'">Cancel</button>
        </div>
    </form>
    <?php
    include('footer.php')
    ?>
    <script type="text/javascript" src="../javascript/delete.js"></script>
    </body>
</html>