<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if (!($_SESSION['auth']))
{
    $body_background = ' style="background:
    linear-gradient(red, transparent),
    linear-gradient(to top left, lime, transparent),
    linear-gradient(to top right, blue, transparent);
    background-blend-mode: screen;"';
    $loggedin_display = ' style="display: none;" ';
    $loggedout_display = ' style="display: block;" ';
}
else
{
    $body_background = "";
    $loggedin_display = ' style="display: block;" ';
    $loggedout_display = ' style="display: none;" ';
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" type="image/png" href="/camagru/sources/cat-img.png"/>
    </head>
    <body <?php echo $body_background ?>>
    <?php
    include('view/header.php')
    ?>
    <div class="register-container">
        <div id="index-loggedin-box" <?php echo $loggedin_display ?>>
            <h1 id="title-index-username">Welcome <?php echo $_SESSION['auth']->user_name ?> ;)</h1>
            <span id="index-intro">SnapCat Feed</span>
        </div>
        <div id="index-loggedout-box" <?php echo $loggedout_display ?>>
            <h1 id="title-index">Welcome to SnapCat ;)</h1>
            <span id="index-intro">Take pictures and add filters to create and share great montages</span>
            <img id="screenshot-index" src="/camagru/sources/screenshot.png">
            <img id="screenshot-mobile-index" src="/camagru/sources/screenshot-mobile.png">
        </div>
        <?php 
            if (!($_SESSION['auth']))
                echo '<h1 id="title-feed">Browse SnapCat Feed to find inspiration</h1>
                <div id="index-loggedout-feed-box">
                <div id="my-gallery-feed">
                </div>
            </div>';
            else
                echo '<div id="my-gallery-feed">
                </div>';
        ?>
    </div>
    <?php
    include('view/footer.php')
    ?>
    <script type="text/javascript" src="javascript/social.js"></script>
    <script type="text/javascript" src="javascript/gallery.js"></script>
    </body>
</html>