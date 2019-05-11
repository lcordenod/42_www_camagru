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

?>