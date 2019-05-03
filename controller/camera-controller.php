<?php

$filter = imagecreatefrompng('../filters/beer.png');
$image = imagecreatefromjpeg('https://jpeg.org/images/jpeg-home.jpg');

list($width, $height) = getimagesize('https://jpeg.org/images/jpeg-home.jpg');
list($newwidth, $newheight) = getimagesize('../filters/beer.png');
$out = imagecreatetruecolor($newwidth, $newheight);
imagecopyresampled($out, $jpeg, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
imagecopyresampled($out, $png, 0, 0, 0, 0, $newwidth, $newheight, $newwidth, $newheight);
imagejpeg($out, 'out.jpg', 100);

?>