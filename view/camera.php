<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/create-montage-controller.php';

if (!($_SESSION['auth']))
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
        <div class="filter-selector">
            <ul>
                <?php echo $filters ?>
            </ul>
        </div>
        <div class="camera-container">
            <div class="camera-view">
                <div id="camera-box">
                    <video id="camera-stream">Camera stream is not available.</video>
                    <img id="filter-img-active" src="../sources/filters/beer.png">
                </div>
                <img id="picture-taken" alt="The screen capture will appear in this box.">
                <button id="camera-snap-btn">Take picture</button>
                <button id="camera-save-btn">Save</button>
                <button id="camera-retry-btn">Retry</button>
            </div>
            <canvas id="canvas">
            </canvas>
        </div>
    </div>
    <script type="text/javascript" src="../javascript/filters.js"></script>
    <script type="text/javascript" src="../javascript/camera.js"></script>
    </body>
</html>