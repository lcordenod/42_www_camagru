<?php
require_once "../config/connect.php";
require_once "debug.php";

$action = $_POST['action'];

function    countUserPicturesSaved($user_id) {
    $total_pictures = db_connect()->prepare("SELECT COUNT(*) FROM images WHERE `img_user`=:id_user");
    $total_pictures->bindParam(':id_user', $user_id);
    $total_pictures->execute();
    return ($total_pictures->fetchColumn());
}

function    countAllUsersPicturesSaved() {
    $total_pictures = db_connect()->prepare("SELECT COUNT(*) FROM images");
    $total_pictures->execute();
    return ($total_pictures->fetchColumn());
}

function    getUserImagesLimitByFrom($user_id, $offset) {
    $get_gallery = db_connect()->prepare("SELECT * FROM images WHERE `img_user`=:id_user ORDER BY img_time DESC LIMIT 5 OFFSET :offset_img");
    $get_gallery->bindParam(':id_user', $user_id);
    $get_gallery->bindParam(':offset_img', $offset, PDO::PARAM_INT);
    $get_gallery->execute();
    return ($get_gallery->fetchAll(PDO::FETCH_ASSOC));
}

function    getAllUsersImagesLimitByFrom($offset) {
    $get_gallery = db_connect()->prepare("SELECT * FROM images ORDER BY img_time DESC LIMIT 5 OFFSET :offset_img");
    $get_gallery->bindParam(':offset_img', $offset, PDO::PARAM_INT);
    $get_gallery->execute();
    return ($get_gallery->fetchAll(PDO::FETCH_ASSOC));
}

function    getImgComments($img_id) {
    $get_comments = db_connect()->prepare("SELECT user.user_name, comments.comment_txt FROM comments INNER JOIN user ON user.user_id=comments.comment_user WHERE comments.comment_img=:img_id ORDER BY comment_time");
    $get_comments->bindParam(':img_id', $img_id);
    $get_comments->execute();
    return ($get_comments->fetchAll());
}

function    getImgLikes($img_id) {
    $get_likes = db_connect()->prepare("SELECT count(*) FROM likes WHERE `like_img`=:img_id");
    $get_likes->bindParam(':img_id', $img_id);
    $get_likes->execute();
    return ($get_likes->fetchColumn());
}

?>