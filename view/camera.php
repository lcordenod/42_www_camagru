<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/create-montage-controller.php';
require_once '../controller/save-montage-controller.php';


if (!($_SESSION['auth']))
    header("Location: /camagru/index.php");
else if (!$_SESSION['auth']->user_valid)
    header("Location: /camagru/index.php");
$list_filters = preg_grep('/^([^.])/', scandir("../sources/filters"));
foreach ($list_filters as $filter)
        $filters .= '<li><img class="filters-img" title="filter" src="../sources/filters/'.$filter.'"></li>';
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
        <h1 id="title-filters">Please select a filter</h1>
        <div id="filter-selector">
            <ul>
                <?php echo $filters ?>
            </ul>
        </div>
        <div id="no-camera-box">
            <div id="error-no-camera">Your camera seems disabled, please make sure to enable it in order to use SnapCat</div>
            <img id="image-upload-preview">
            <button id="upload-confirm-btn" onclick="uploadToMontage()">Confirm</button>
            <input type="file" id="image-upload-input" accept="image/*" onchange="handleImage(this)">
            <label for="image-upload-input" id="image-upload-btn">Upload an image</label>
            <p id="or-buttons-no-camera">Or</p>
            <button id="no-camera-retry-btn" onclick="window.location.href = '/camagru/view/camera.php'">Retry</button>
        </div>
        <div class="camera-container">
            <div id="camera-view">
                <div id="camera-box">
                    <video id="camera-stream">Camera stream is not available.</video>
                    <img id="image-upload">
                    <img id="filter-img-active" src="../sources/filters/beer.png">
                </div>
                <img id="picture-taken" alt="The screen capture will appear in this box.">
                <button id="camera-snap-btn">Take picture</button>
                <button id="camera-save-btn">Save</button>
                <button id="camera-retry-btn">Retry</button>
            </div>
            <canvas id="canvas">
            </canvas>
            <div id="pictures-taken-view">
                <h3 id="title-pictures-taken">My pictures saved</h3>
                <div id="pictures-taken-box">
                <p id="message-no-pictures-taken-box">No pictures taken yet...<br/>Select a filter to start 😌</p>
                </div>
                <a id="link-pictures-taken-to-gallery" href="/camagru/view/account-my-gallery.php">See my gallery</a>
            </div>
        </div>
    </div>
    <?php
    include('footer.php')
    ?>
    <script type="text/javascript" src="../javascript/filters.js"></script>
    <script type="text/javascript" src="../javascript/post-data.js"></script>
    <script type="text/javascript" src="../javascript/montage-processing.js"></script>
    <script type="text/javascript" src="../javascript/camera.js"></script>
    <script type="text/javascript" src="../javascript/file-upload.js"></script>
    </body>
</html>