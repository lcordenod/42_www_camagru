<?php
require_once 'debug.php';

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
        imagealphablending( $tmp, false );
        imagesavealpha( $tmp, true );
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        return ($tmp);
}

$filter = '../sources/filters/dancing-cat.gif';
/* New resize image is hardcoded as 200 but needs to be given by front end */
$filter_resized = resizeImage(200, $filter);
$image = imagecreatefromjpeg('https://jpeg.org/images/jpeg-home.jpg');

/* Margins of image are hardcoded but needs to be given by front end */
$marge_left = 50;
$marge_top = 50;
$filter_x = imagesx($filter_resized);
$filter_y = imagesy($filter_resized);

imagecopy($image, $filter_resized, $marge_left, $marge_top, 0, 0, $filter_x, $filter_y);

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>