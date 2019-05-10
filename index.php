<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if (!($_SESSION['auth']))
{
    $body_background = ' style="background-image: url(https://images.pexels.com/photos/122458/pexels-photo-122458.jpeg); "';
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
    </head>
    <body <?php echo $body_background ?>>
    <?php
    include('view/header.php')
    ?>
    <div class="register-container">
        <div id="index-loggedin-box" <?php echo $loggedin_display ?>>
            User is logged in
        </div>
        <div id="index-loggedout-box" <?php echo $loggedout_display ?>>
            <h1 class="title-index">Welcome to SnapCat ;)</h1>
            <span id="index-intro">Take pictures and add filters to create and share great montages</span>
        </div>   
    </div>
    </body>
</html>