<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/verify-account-controller.php';

if (!($_SESSION['auth']))
    header("Location: /camagru/index.php");
if ($_SESSION['auth']->user_valid)
    $settings_buttons = '<button id="account-modify-btn" onclick="window.location.href = \'/camagru/view/account-modify-username.php\';">Modify account username</button>
    <button id="account-modify-btn" onclick="window.location.href = \'/camagru/view/account-modify-password.php\';">Modify account password</button>';
else
    $settings_buttons = '<button id="account-modify-btn" onclick="sendVerifyEmail(\''.$_SESSION['auth']->user_email.'\');">Send verification email</button>';
$username = $_SESSION['auth']->user_name;
$email = $_SESSION['auth']->user_email;
$user_valid = $_SESSION['auth']->user_valid;
if ($user_valid)
    $status = '<span style="color:green;">Verified ✔</span>';
else
    $status = '<span style="color:red;">Unverified ✖</span>';
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
        <div class="settings-container">
            <p><span class="title-settings">Username:</span> <?php echo $username ?></p>
            <p><span class="title-settings">Email:</span> <?php echo $email ?></p>
            <p><span class="title-settings">Status:</span> <?php echo $status ?></p>
        </div>
        <button id="account-modify-btn" onclick="window.location.href = '/camagru/view/account-modify-email.php'">Modify account email</button>
        <?php echo $settings_buttons ?>
        <button id="account-modify-btn" onclick="window.location.href = '/camagru/view/logout.php'">Log Out</button>
    </div>
    <script type="text/javascript" src="../javascript/post-data.js"></script>
    <script type="text/javascript" src="../javascript/account-modify.js"></script>
    </body>
</html>