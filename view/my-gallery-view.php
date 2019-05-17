<?php
require_once "../controller/gallery-controller.php";
require_once "../controller/social-controller.php";
require_once "../controller/debug.php";
session_start();

$gallery = getUserImagesLimitByFrom($_SESSION['auth']->user_id, 0);

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
    $tab[] = $content;
}
echo json_encode($tab);

?>