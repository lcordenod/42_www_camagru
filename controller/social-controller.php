<?php
require_once "../config/connect.php";
require_once "debug.php";
session_start();

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$comment_text = $decoded['comment_text'];
$img_file = $decoded['img_file'];
$user_id = $decoded['user_id'];

/* function    getUserTotalLikes() {

}

function    getUserTotalComments() {
    
} */

function        saveCommentToDb($user_id, $comment_text, $img_file)
{
        $date = date('Y-m-d H:i:s');
        $get_img_id = db_connect()->prepare("SELECT img_id FROM images WHERE img_path LIKE :img_file");
        $img_file = "%$img_file%";
        $get_img_id->bindParam(':img_file', $img_file);
        $get_img_id->execute();
        $get_img_id = $get_img_id->fetch(PDO::FETCH_OBJ)->img_id;
        console_log($user_id);
        console_log($comment_text);
        $save = db_connect()->prepare("INSERT INTO comments (comment_user, comment_img, comment_txt, comment_time)
        VALUES ('$user_id', '$get_img_id', '$comment_text', '$date')");
        $save->execute();
}

if (isset($comment_text))
{
    if (isset($comment_text) && isset($img_file) && isset($user_id))
    {
        saveCommentToDb($user_id, $comment_text, $img_file);
        echo "{\"status\": \"success\"}";
    }
    else
        echo "{\"status\": \"failed\"}";
}

?>