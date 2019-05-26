<?php
require_once "../controller/gallery-controller.php";
require_once "../config/connect.php";

$action = $_POST['action'];
$img_id = (int)$_POST['img_id'];

function    deleteImgLikes($img_id)
{
    try
    {
        $delete_img_likes = db_connect()->prepare("DELETE FROM likes WHERE `like_img` =:img_id");
        $delete_img_likes->bindParam(':img_id', $img_id);
        $delete_img_likes->execute();
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    deleteImgComments($img_id)
{
    try
    {
        $delete_img_comments = db_connect()->prepare("DELETE FROM comments WHERE `comment_img` =:img_id");
        $delete_img_comments->bindParam(':img_id', $img_id);
        $delete_img_comments->execute();
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    deleteImg($img_id)
{
    try
    {
        $delete_img = db_connect()->prepare("DELETE FROM images WHERE `img_id` =:img_id");
        $delete_img->bindParam(':img_id', $img_id);
        $delete_img->execute();
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    deleteImgData($img_id)
{
    try
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
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
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