<?php
require_once "../controller/gallery-controller.php";
require_once "../config/connect.php";

$action = $_POST['action'];
$img_id = (int)$_POST['img_id'];

function    deleteImgLikes($img_id)
{
    $delete_img_likes = db_connect()->prepare("DELETE FROM likes WHERE `like_img` =:img_id");
    $delete_img_likes->bindParam(':img_id', $img_id);
    $delete_img_likes->execute();
}

function    deleteImgComments($img_id)
{
    $delete_img_comments = db_connect()->prepare("DELETE FROM comments WHERE `comment_img` =:img_id");
    $delete_img_comments->bindParam(':img_id', $img_id);
    $delete_img_comments->execute();
}

function    deleteImg($img_id)
{
    $delete_img = db_connect()->prepare("DELETE FROM images WHERE `img_id` =:img_id");
    $delete_img->bindParam(':img_id', $img_id);
    $delete_img->execute();
}

function    deleteImgData($img_id)
{
    if (getImage($img_id))
    {
        deleteImgLikes($img_id);
        deleteImgComments($img_id);
        deleteImg($img_id);
        return (true);
    }
    else
        return (false);
}

if (isset($action))
{
    if ($action === "delete-img" && isset($img_id))
    {
        if (deleteImgData($img_id))
            echo "Image deleted";
        else
            echo "Image deletion failed";
    }
}

?>