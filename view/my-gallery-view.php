<?php
require_once "../controller/gallery-controller.php";
require_once "../controller/social-controller.php";
require_once "../controller/debug.php";
session_start();

/* $action = $_POST['action'];
$gallery_count = $_POST['gallery-count'];
$offset = $_POST['offset'];


if ($action === "init")
    $pictures = getUserPicturesLimitBy($_SESSION['auth']->user_id, $gallery_count);
else if ($action === "check")
    $pictures = getUserPicturesLimitByFromOffset($_SESSION['auth']->user_id, $gallery_count, $offset);

foreach($pictures as $picture)
{
    $comments_array = getImageComments($picture["img_id"]);

    foreach ($comments_array as $comment)
    {
        $comments .= '<p class="single-comment"><span class="username-comment">'.getUsernameFromId($comment["comment_user"]).'</span><span> - </span><span class="user-comment">'.$comment["comment_txt"].'</span></p>';
    }
    $icons = '<div class="gallery-social-icons"><span class="like-count">'.count(getImageLikes($picture["img_id"])).'</span><span class="social-like-icon">👍</span> <span class="comment-count">'.count(getImageComments($picture["img_id"])).'</span> 💬</div>';
    $comments_container = '<div class="gallery-social-comments">'.$comments.'</div>';
    $comment_input = '<div class="gallery-social-comment">
                    <textarea placeholder="Write a comment..." name="comment" class="comment-text-box"></textarea>
                    <button class="comment-post-btn" disabled>Post</button>
                </div>';
    $comment_length = '<div class="comment-length"></div>';
    $comment_length_error = '<div class="comment-length-error">Comment is too long, must be less than 150 characters</div>';
    $comment_format_error = '<div class="comment-format-error">Comment format is incorrect</div>';
    $social = '<form action="" method="POST" class="gallery-social-block">'.$icons.$comments_container.$comment_input.$comment_format_error.$comment_length.$comment_length_error.' </form>';

    $gallery .= '<div class="pictures-gallery-box">
    <img class="pictures-gallery" src="'.$picture["img_path"].'">
    '.$social.'
    </div>';
    $comments = "";
}
echo $gallery; */


$gallery = getUserImagesLimitByFrom($_SESSION['auth']->user_id, 0);

foreach ($gallery as $value) {
    $user_img_count = getUserTotalPictures($_SESSION['auth']->user_id);
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