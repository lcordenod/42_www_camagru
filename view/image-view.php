<?php
require_once "../controller/gallery-controller.php";
require_once "../controller/social-controller.php";
session_start();

$img_id = (int)$_POST['img_id'];
$image = getImage($img_id);
$comments = getImgComments($img_id);
$likes = getImgLikes($img_id);
$username = getUsernameFromPicture($img_id);
$content = Array($image[0]["img_path"], $comments, $likes, $username);

if ($_SESSION["auth"])
    $content[] = "logged in";
else
    $content[] = "logged out";

echo json_encode($content);

?>