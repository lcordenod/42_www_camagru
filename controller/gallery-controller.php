<?php
require_once "../config/connect.php";

function    countUserPicturesSaved($user_id) {
    try
    {
        $total_pictures = db_connect()->prepare("SELECT COUNT(*) FROM images WHERE `img_user`=:id_user");
        $total_pictures->bindParam(':id_user', $user_id);
        $total_pictures->execute();
        return ($total_pictures->fetchColumn());
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    countAllUsersPicturesSaved() {
    try
    {
        $total_pictures = db_connect()->prepare("SELECT COUNT(*) FROM images");
        $total_pictures->execute();
        return ($total_pictures->fetchColumn());
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    getUserImagesLimitByFrom($user_id, $offset) {
    try
    {
        $get_gallery = db_connect()->prepare("SELECT * FROM images WHERE `img_user`=:id_user ORDER BY img_time DESC LIMIT 5 OFFSET :offset_img");
        $get_gallery->bindParam(':id_user', $user_id);
        $get_gallery->bindParam(':offset_img', $offset, PDO::PARAM_INT);
        $get_gallery->execute();
        return ($get_gallery->fetchAll(PDO::FETCH_ASSOC));
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    getAllUsersImagesLimitByFrom($offset) {
    try
    {
        $get_gallery = db_connect()->prepare("SELECT * FROM images ORDER BY img_time DESC LIMIT 5 OFFSET :offset_img");
        $get_gallery->bindParam(':offset_img', $offset, PDO::PARAM_INT);
        $get_gallery->execute();
        return ($get_gallery->fetchAll(PDO::FETCH_ASSOC));
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    getImage($img_id) {
    try
    {
        $get_image = db_connect()->prepare("SELECT * FROM images WHERE img_id=:img_id");
        $get_image->bindParam(':img_id', $img_id, PDO::PARAM_INT);
        $get_image->execute();
        return ($get_image->fetchAll(PDO::FETCH_ASSOC));
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    getImgComments($img_id) {
    try
    {
        $get_comments = db_connect()->prepare("SELECT user.user_name, comments.comment_txt FROM comments INNER JOIN user ON user.user_id=comments.comment_user WHERE comments.comment_img=:img_id ORDER BY comment_time");
        $get_comments->bindParam(':img_id', $img_id);
        $get_comments->execute();
        return ($get_comments->fetchAll());
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    getUsernameFromPicture($img_id) {
    try
    {
        $get_username = db_connect()->prepare("SELECT user.user_name FROM images INNER JOIN user ON user.user_id=images.img_user WHERE images.img_id=:img_id");
        $get_username->bindParam(':img_id', $img_id);
        $get_username->execute();
        return ($get_username->fetchColumn());
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    getImgLikes($img_id) {
    try
    {
        $get_likes = db_connect()->prepare("SELECT count(*) FROM likes WHERE `like_img`=:img_id");
        $get_likes->bindParam(':img_id', $img_id);
        $get_likes->execute();
        return ($get_likes->fetchColumn());
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

?>