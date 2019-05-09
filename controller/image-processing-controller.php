<?php

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

function pngToJpg($original_file) {
        $image = imagecreatefrompng($original_file);
        $output_file = preg_replace('/.png/', '.jpg', $original_file);
        imagejpeg($image, $output_file, 100);
        imagedestroy($image);
        return ($output_file);
}

function checkImageDataFormat($data)
{
        $pos  = strpos($data, ';');
        $type = explode(':', substr($data, 0, $pos))[1];
        return ($type);
}

function createPngImageFromBaseSixtyFour($data, $file_path)
{
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
        file_put_contents($file_path.'.png', $data);
        return ($file_path.'.png');
}

function createJpgImageFromBaseSixtyFour($data, $file_path)
{
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
        file_put_contents($file_path.'.jpg', $data);
        return ($file_path.'.jpg');
}


?>