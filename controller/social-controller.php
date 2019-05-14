<?php
require_once "../config/connect.php";
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

function    getUsernameFromId($user_id)
{
    $get_username = db_connect()->prepare("SELECT `user_name` FROM user WHERE `user_id` = :u_id");
    $get_username->bindParam(':u_id', $user_id);
    $get_username->execute();
    $get_username = $get_username->fetch(PDO::FETCH_OBJ)->user_name;
    return ($get_username);
}

function    saveCommentToDb($user_id, $comment_text, $img_file)
{
        $date = date('Y-m-d H:i:s');
        $get_img_id = db_connect()->prepare("SELECT img_id FROM images WHERE img_path LIKE :img_file");
        $img_file = "%$img_file%";
        $get_img_id->bindParam(':img_file', $img_file);
        $get_img_id->execute();
        $get_img_id = $get_img_id->fetch(PDO::FETCH_OBJ)->img_id;
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