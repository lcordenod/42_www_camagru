<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/verify-account-controller.php';

if (!($_SESSION['auth']))
    header("Location: /camagru/index.php");
if ($_SESSION['auth']->user_valid)
    $settings_buttons = '<button id="account-modify-btn" onclick="window.location.href = \'/camagru/view/account-modify.php\';">Modify account settings</button>';
else
    $settings_buttons = '<button id="account-modify-btn" onclick="sendVerifyEmail(\''.$_SESSION['auth']->user_email.'\');">Send verification email</button>';
$username = $_SESSION['auth']->user_name;
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
    <div class="register-container">
        <h1 id="title-account">Hi <?php echo $username ?> ;)</h1>
        <?php echo $settings_buttons ?>
    </div>
    <script type="text/javascript" src="../javascript/account-modify.js"></script>
    </body>
</html>