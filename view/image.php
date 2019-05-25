<?php
require_once "../controller/image-controller.php";
session_start();

if (!($_SESSION['auth']))
    header("Location: /camagru/index.php");
if (!($img_data = getImage($_GET["id"])))
    header("Location: /camagru/index.php");

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
    </div>
    <div class="register-container">
        <h1 id="title-image-username">Image review</h1>
        <div id="image-info">
            <span>You are reviewing this image as </span>
            <span id="image-info-username"><?php echo $_SESSION['auth']->user_name?></span>
            <span>- you can only delete this image if it's your own</span>
        </div>
        <div id="my-gallery-feed">
        </div>
        <?php
            if ($img_data[0]["img_user"] === $_SESSION["auth"]->user_id)
                echo '<button id="image-delete-btn" onclick="deleteImage('.$img_data[0]["img_id"].');">Delete image</button>';
        ?>
        <button id="account-modify-btn" onclick="window.history.back();">Go back</button>
    </div>
    <?php
    include('footer.php')
    ?>
    <script type="text/javascript" src="../javascript/social.js"></script>
    <script type="text/javascript" src="../javascript/gallery.js"></script>
    </body>
</html>