<?php
session_start();
require_once "debug.php";

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$image_src = $decoded['image_src'];
$image_width = $decoded['image_width'];
$filter_src = $decoded['filter_src'];
$filter_width = $decoded['filter_width'];
$filter_top = $decoded['filter_top'];
$filter_left = $decoded['filter_left'];
$montage_url = false;

function resizeImage($newWidth, $originalFile) {
        $info = getimagesize($originalFile);
        $mime = $info['mime'];

        switch ($mime) {
                case 'image/jpeg':
                        $image_create_func = 'imagecreatefromjpeg';
                        $image_save_func = 'imagejpeg';
                        $new_image_ext = 'jpg';
                        break;

                case 'image/png':
                        $image_create_func = 'imagecreatefrompng';
                        $image_save_func = 'imagepng';
                        $new_image_ext = 'png';
                        break;

                case 'image/gif':
                        $image_create_func = 'imagecreatefromgif';
                        $image_save_func = 'imagegif';
                        $new_image_ext = 'gif';
                        break;

                default: 
                        throw new Exception('Unknown image type.');
        }

        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);

        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        if ($mime === 'image/png' || $mime === 'image/gif')
        {
                imagealphablending( $tmp, false );
                imagesavealpha( $tmp, true );
        }
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        return ($tmp);
}

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

function createImageFromBaseSixtyFour($data, $name)
{
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
        file_put_contents('../sources/tmp/'.$name.'.png', $data);
        return ('../sources/tmp/'.$name.'.png');
}

function pngToJpg($original_file) {
        $image = imagecreatefrompng($original_file);
        $output_file = preg_replace('/.png/', '.jpg', $original_file);
        imagejpeg($image, $output_file, 100);
        imagedestroy($image);
        return ($output_file);
}

function createUserMontageTempDir($user_id)
{
        $dir_path = "user-".$user_id;
        @mkdir("../sources/tmp/".$dir_path);
        return ($dir_path);
}

function deleteFilesFromDir($dir_path)
{
        $files = glob($dir_path."/*");

        foreach($files as $file)
        {
                if (is_file($file))
                        unlink($file);
        }
}

if (isset($image_src))
{
        if (isset($image_src) && isset($image_width) && isset($filter_src) && isset($filter_width) && isset($filter_top) && isset($filter_left))
        {
                $dir_name = createUserMontageTempDir($_SESSION['auth']->user_id);
                $file_name = generateMontageFileName($_SESSION['auth']->user_id);
                $montage_url = '../sources/tmp/'.$dir_name."/".$file_name.'.png';
                echo $montage_url;
                echo "{\"status\": \"success\"}";
                $image_png = createImageFromBaseSixtyFour($image_src, $dir_name."/".generateTmpImageFileName($_SESSION['auth']->user_id));
                $image = pngToJpg($image_png);
                $image_resized = resizeImage($image_width, $image);
                unlink($image);
                unlink($image_png);
                $filter_resized = resizeImage($filter_width, $filter_src);
                $filter_x = imagesx($filter_resized);
                $filter_y = imagesy($filter_resized);
                deleteFilesFromDir('../sources/tmp/'.$dir_name);
                imagecopy($image_resized, $filter_resized, $filter_left, $filter_top, 0, 0, $filter_x, $filter_y);
                imagepng($image_resized, $montage_url);
                imagedestroy($image_resized);
                imagedestroy($filter_resized);
        }
        else
                echo "{\"status\": \"failed\"}";
}

?>