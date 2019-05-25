<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/verify-account-controller.php';

if (!($_SESSION['auth']))
    header("Location: /camagru/index.php");
if ($_SESSION['auth']->user_valid)
{
    $account_gallery_btn = '<button id="account-gallery-btn" onclick="window.location.href = \'/camagru/view/account-my-gallery.php\';">See my gallery</button>';
}
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
        <link rel="shortcut icon" type="image/png" href="/camagru/sources/cat-img.png"/>
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
            <?php echo $account_gallery_btn ?>
        </div>
        <div id="notif-switch">
        <span id="notif-switch-text">Comment notifications</span>
        <label class="switch">
            <input type="checkbox">
            <span class="slider round"></span>
        </label>
        </div>
        <?php echo $settings_buttons ?>
        <?php 
        if ($_SESSION['auth']->user_valid)
            echo '<button id="account-modify-btn" onclick="window.location.href = \'/camagru/view/account-modify-username.php\';">Modify account username</button>
            <button id="account-modify-btn" onclick="window.location.href = \'/camagru/view/account-modify-password.php\';">Modify account password</button>'; 
        ?>
        <button id="account-modify-btn" onclick="window.location.href = '/camagru/view/account-modify-email.php'">Modify account email</button>
        <button id="account-modify-btn" onclick="window.location.href = '/camagru/view/logout.php'">Log Out</button>
        <button id="account-delete-btn" onclick="window.location.href = '/camagru/view/account-delete-confirmation.php'">Delete account</button>
    </div>
    <?php
    include('footer.php')
    ?>
    <script type="text/javascript" src="../javascript/post-data.js"></script>
    <script type="text/javascript" src="../javascript/account-modify.js"></script>
    </body>
</html>