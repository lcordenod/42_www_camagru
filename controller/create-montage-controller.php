<?php
require_once "image-processing-controller.php";
require_once "files-directories-management-controller.php";
require_once "debug.php";
session_start();

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$image_src = $decoded['image_src'];
$image_width = $decoded['image_width'];
$filter_src = $decoded['filter_src'];
$filter_width = $decoded['filter_width'];
$filter_top = $decoded['filter_top'];
$filter_left = $decoded['filter_left'];
$montage_url = false;

function generateMontageFileName($user_id)
{
        $file_name = "montage-user-".$user_id."-".uniqid();
        return ($file_name);
}

function generateTmpImageFileName($user_id)
{
        $file_name = "tmp-image-user-".$user_id."-".uniqid();
        return ($file_name);
}

function createImageFromBaseSixtyFour($data, $file_path)
{
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
        file_put_contents($file_path.'.png', $data);
        return ($file_path.'.png');
}

function createUserMontageTempDir($user_id)
{
        $dir_path = "../sources/tmp/user-".$user_id;
        @mkdir($dir_path);
        return ($dir_path);
}

if (isset($image_src))
{
        if (isset($image_src) && isset($image_width) && isset($filter_src) && isset($filter_width) && isset($filter_top) && isset($filter_left))
        {
                $dir_path = createUserMontageTempDir($_SESSION['auth']->user_id);
                $file_name = generateMontageFileName($_SESSION['auth']->user_id);
                $montage_url = $dir_path."/".$file_name.'.png';
                echo $montage_url;
                echo "{\"status\": \"success\"}";
                $image_png = createImageFromBaseSixtyFour($image_src, $dir_path."/".generateTmpImageFileName($_SESSION['auth']->user_id));
                $image = pngToJpg($image_png);
                $image_resized = resizeImage($image_width, $image);
                unlink($image);
                unlink($image_png);
                $filter_resized = resizeImage($filter_width, $filter_src);
                $filter_x = imagesx($filter_resized);
                $filter_y = imagesy($filter_resized);
                deleteFilesFromDir($dir_path);
                imagecopy($image_resized, $filter_resized, $filter_left, $filter_top, 0, 0, $filter_x, $filter_y);
                imagepng($image_resized, $montage_url);
                imagedestroy($image_resized);
                imagedestroy($filter_resized);
        }
        else
                echo "{\"status\": \"failed\"}";
}

?>