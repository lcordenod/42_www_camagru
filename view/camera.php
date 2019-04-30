<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if (!($_SESSION['auth']))
    header("Location: /camagru/index.php");
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
        <div class="camera-container">
            <div class="camera-view">
                <div class="camera-box"><video id="camera-stream">Camera stream is not available.</video></div>
                <img id="picture-taken" alt="The screen capture will appear in this box.">
                <button id="camera-snap-btn">Take picture</button>
                <button id="camera-save-btn">Save</button>
                <button id="camera-retry-btn">Retry</button>
            </div>
            <canvas id="canvas">
            </canvas>
        </div>
    </div>
    <script type="text/javascript" src="../javascript/camera.js"></script>
    </body>
</html>