<?php
require_once "../config/connect.php";
session_start();

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$comment_text = $decoded['comment_text'];
$img_file = $decoded['img_file'];
$user_id = $_SESSION['auth']->user_id;

function    getUsernameFromId($user_id)
{
    $get_username = db_connect()->prepare("SELECT `user_name` FROM user WHERE `user_id` = :u_id");
    $get_username->bindParam(':u_id', $user_id);
    $get_username->execute();
    $get_username = $get_username->fetch(PDO::FETCH_OBJ)->user_name;
    return ($get_username);
}

function    checkImageFile($img_file)
{
    $check_img = db_connect()->prepare("SELECT img_id FROM images WHERE img_path LIKE :img_file");
    $img_file = "%$img_file%";
    $check_img->bindParam(':img_file', $img_file);
    $check_img->execute();

    if (!$check_img->rowCount())
    return false;
else 
    return true;
}

function    checkComment($user_id, $comment_text, $img_file)
{
    $check_user = db_connect()->prepare("SELECT `user_id` FROM user WHERE `user_id` = :u_id");
    $check_user->bindParam(':u_id', $user_id);
    $check_user->execute();

    if (!$check_user->rowCount() || !checkImageFile($img_file) || $comment_text === '')
        return false;
    else 
        return true;
}

function    saveCommentToDb($user_id, $comment_text, $img_file)
{
    $comment_text = trim(str_replace(array("\r", "\n"), '', $comment_text));
    $comment_text = preg_replace('/\s+/', ' ', $comment_text);
    $date = date('Y-m-d H:i:s');
    $get_img_id = db_connect()->prepare("SELECT img_id FROM images WHERE img_path LIKE :img_file");
    $img_file = "%$img_file%";
    $get_img_id->bindParam(':img_file', $img_file);
    $get_img_id->execute();
    $get_img_id = $get_img_id->fetch(PDO::FETCH_OBJ)->img_id;
    $save = db_connect()->prepare("INSERT INTO comments (comment_user, comment_img, comment_txt, comment_time)
    VALUES ('$user_id', '$get_img_id', :comment_txt, '$date')");
    $save->bindParam(':comment_txt', $comment_text);
    $save->execute();
}

function    likeOrDislikeAction($user_id, $img_file)
{
    $get_img_id = db_connect()->prepare("SELECT img_id FROM images WHERE img_path LIKE :img_file");
    $img_file = "%$img_file%";
    $get_img_id->bindParam(':img_file', $img_file);
    $get_img_id->execute();
    $get_img_id = $get_img_id->fetch(PDO::FETCH_OBJ)->img_id;
    $check = db_connect()->prepare("SELECT * FROM likes WHERE like_user = :u_id AND like_img = :img_id");
    $check->bindParam(':u_id', $user_id);
    $check->bindParam(':img_id', $get_img_id);
    $check->execute();
    if ($check->rowCount())
    {
        removeLikeFromDb($user_id, $get_img_id);
        echo "like removed";
    }
    else
    {
        saveLikeToDb($user_id, $get_img_id);
        echo "like added";
    }
}

function    saveLikeToDb($user_id, $img_id)
{
    $save = db_connect()->prepare("INSERT INTO likes (like_user, like_img)
    VALUES ('$user_id', '$img_id')");
    $save->execute();
}

function    removeLikeFromDb($user_id, $img_id)
{
    $save = db_connect()->prepare("DELETE FROM likes WHERE like_user = :u_id AND like_img = :img_id");
    $save->bindParam(':u_id', $user_id);
    $save->bindParam(':img_id', $img_id);
    $save->execute();
}

if (isset($comment_text))
{
    if (isset($comment_text) && isset($img_file) && isset($user_id))
    {
        if (checkComment($user_id, $comment_text, $img_file))
        {
            saveCommentToDb($user_id, $comment_text, $img_file);
            echo "comment success";
        }
        else
            echo "comment fail";
    }
    else
        echo "comment fail";
}
else if (isset($img_file))
{
    if (isset($img_file) && isset($user_id))
    {
        if (checkImageFile($img_file))
            likeOrDislikeAction($user_id, $img_file);
        else
            echo "like fail";
    }
    else
        echo "like fail";
}

?>