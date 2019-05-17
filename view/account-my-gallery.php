<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if (!($_SESSION['auth']))
    header("Location: /camagru/index.php");
else if ($_SESSION['auth']->user_valid === 0)
    header("Location: /camagru/index.php");
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
        <h1 id="title-account">Your gallery</h1>
        <div class="settings-container">
            <p><span class="title-settings">Username:</span> <?php echo $username ?></p>
            <p><span class="title-settings">Number of pictures: </span><span id="my-gallery-pictures-count">0</span></p>
            <button id="account-gallery-btn" onclick="window.location.href = '/camagru/view/camera.php'">Add a picture</button>
        </div>
        <div id="my-gallery-feed">
        </div>
        <div id ="my-gallery-empty-box">
            <div id="my-gallery-empty-message">
                <span class="empty-gallery-text">No picture available yet</span>
                <img id="empty-gallery-img" src="/camagru/sources/crying-cat.png">
                <span class="empty-gallery-text">But don't worry, you can fix this by taking one</span>
            </div>
            <button id="account-modify-btn" onclick="window.location.href = '/camagru/view/camera.php'">Take a picture 📸</button>
        </div>
    </div>
    <?php
    include('footer.php')
    ?>
    <script type="text/javascript" src="../javascript/post-data.js"></script>
    <script type="text/javascript" src="../javascript/social.js"></script>
    <script type="text/javascript" src="../javascript/gallery.js"></script>
    </body>
</html>