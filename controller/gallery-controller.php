<?php
require_once "../config/connect.php";
require_once "debug.php";

function    getUserTotalPictures($user_id) {
    $total_pictures = db_connect()->prepare("SELECT COUNT(*) `img_id` FROM images WHERE `img_user`=:id_user");
    $total_pictures->bindParam(':id_user', $user_id);
    $total_pictures->execute();
    return ($total_pictures->fetchColumn());
}

function    getUserPictures($user_id) {
    $get_pictures = db_connect()->prepare("SELECT * FROM images WHERE `img_user`=:id_user ORDER BY img_time DESC");
    $get_pictures->bindParam(':id_user', $user_id);
    $get_pictures->execute();
    return ($get_pictures->fetchAll());
}

function    getUserPicturesLimitBy($user_id, $limit_by) {
    $limit_by = (int)$limit_by;
    $get_pictures = db_connect()->prepare("SELECT * FROM images WHERE `img_user`=:id_user ORDER BY img_time DESC LIMIT :limit_by");
    $get_pictures->bindParam(':id_user', $user_id);
    $get_pictures->bindParam(':limit_by', $limit_by, PDO::PARAM_INT);
    $get_pictures->execute();
    return ($get_pictures->fetchAll());
}

function    getImageComments($image_id)
{
    $get_img_comments = db_connect()->prepare("SELECT * FROM comments WHERE comment_img = :img_id ORDER BY comment_time ASC");
    $get_img_comments->bindParam(':img_id', $image_id);
    $get_img_comments->execute();
    return ($get_img_comments->fetchAll());
}

function    getImageLikes($image_id)
{
    $get_img_likes = db_connect()->prepare("SELECT * FROM likes WHERE like_img = :img_id");
    $get_img_likes->bindParam(':img_id', $image_id);
    $get_img_likes->execute();
    return ($get_img_likes->fetchAll());
}

?>