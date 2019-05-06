<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/verify-account-controller.php';

if (isset($_GET['email']) && isset($_GET['key']))
{ 
    if (!isUserValid($_GET['email']) && isUserKeyValid($_GET['email'], $_GET['key']))
    {
        makeUserValid($_GET['email']);
        unset($_SESSION['auth']);
        $message = "Your account is now active, you may now login";
    }
    else if (isUserValid($_GET['email']) && isUserKeyValid($_GET['email'], $_GET['key']))
    {
        unset($_SESSION['auth']);
        $message = "Your account is already active, you may now login";
    }
    else
        $message = "We cannot verify this account, please make sure link entered is correct or latest";
}
else
{
    header("Location: /camagru/index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
    <div class="register-container">
        <h1 id="title-account">Hi ;)</h1>
        <p><?php echo $message ?></p>
        <button id="verify-login" onclick="window.location.href = '/camagru/view/login.php';">log In</button>
    </div>
    </body>
</html>