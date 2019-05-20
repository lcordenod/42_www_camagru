<?php
require_once "../controller/gallery-controller.php";
require_once "../controller/social-controller.php";
require_once "../controller/debug.php";
session_start();

$offset = (int)$_POST['offset'];
$gallery = getUserImagesLimitByFrom($_SESSION['auth']->user_id, $offset);

foreach ($gallery as $value) {
    $user_img_count = countUserPicturesSaved($_SESSION['auth']->user_id);
    $comments = getImgComments($value["img_id"]);
    $likes = getImgLikes($value["img_id"]);
    $content = Array($user_img_count, $value["img_id"], $value["img_path"]);

    if (!empty($comments))
        $content[] = $comments;
    else
        $content[] = 0;
    if (!empty($likes))
        $content[] = $likes;
    else
        $content[] = 0;
    if ($_SESSION["auth"])
        $content[] = "logged in";
    else
        $content[] = "logged out";
    $tab[] = $content;
}
echo json_encode($tab);

?>