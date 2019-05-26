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
    try
    {
        $get_username = db_connect()->prepare("SELECT `user_name` FROM user WHERE `user_id` = :u_id");
        $get_username->bindParam(':u_id', $user_id);
        $get_username->execute();
        $get_username = $get_username->fetch(PDO::FETCH_OBJ)->user_name;
        return ($get_username);
    }
    catch(Exception $e)
    {
    exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    checkImageFile($img_file)
{
    try
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
    catch(Exception $e)
    {
    exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    checkComment($user_id, $comment_text, $img_file)
{
    try
    {
        $check_user = db_connect()->prepare("SELECT `user_id` FROM user WHERE `user_id` = :u_id");
        $check_user->bindParam(':u_id', $user_id);
        $check_user->execute();

        if (!$check_user->rowCount() || !checkImageFile($img_file) || $comment_text === '')
            return false;
        else 
            return true;
    }
    catch(Exception $e)
    {
    exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    saveCommentToDb($user_id, $comment_text, $img_file)
{
    try
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
    catch(Exception $e)
    {
    exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    likeOrDislikeAction($user_id, $img_file)
{
    try
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
    catch(Exception $e)
    {
    exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    saveLikeToDb($user_id, $img_id)
{
    try
    {
        $save = db_connect()->prepare("INSERT INTO likes (like_user, like_img)
        VALUES ('$user_id', '$img_id')");
        $save->execute();
    }
    catch(Exception $e)
    {
    exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    removeLikeFromDb($user_id, $img_id)
{
    try
    {
        $save = db_connect()->prepare("DELETE FROM likes WHERE like_user = :u_id AND like_img = :img_id");
        $save->bindParam(':u_id', $user_id);
        $save->bindParam(':img_id', $img_id);
        $save->execute();
    }
    catch(Exception $e)
    {
    exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

// SEND EMAIL TO NOTIFY USER ON NEW COMMENT (EXCLUDING HIMSELF COMMENTS ON HIS OWN PICS)
function    sendNewCommentNotifEmail($user_who_commented, $img_file){
    try
    {
        $get_img_id = db_connect()->prepare("SELECT img_id FROM images WHERE img_path LIKE :img_file");
        $img_file = "%$img_file%";
        $get_img_id->bindParam(':img_file', $img_file);
        $get_img_id->execute();
        $get_img_id = $get_img_id->fetch(PDO::FETCH_OBJ)->img_id;
        $user_id = db_connect()->prepare("SELECT `img_user` FROM images WHERE `img_id`=:img_id");
        $user_id->bindParam(':img_id', $get_img_id);
        $user_id->execute();
        $user_id = $user_id->fetch(PDO::FETCH_OBJ);
        $user_id = $user_id->img_user;
        $username = db_connect()->prepare("SELECT * FROM user WHERE `user_id`=:u_id");
        $username->bindParam(':u_id', $user_id);
        $username->execute();
        $username = $username->fetch(PDO::FETCH_OBJ);
        $user_sub = $username->comment_sub;
        $email = $username->user_email;
        $username = $username->user_name;
        if ($user_who_commented !== $user_id && $user_sub === "1")
        {
            $username_who_commented = db_connect()->prepare("SELECT * FROM user WHERE `user_id`=:u_id");
            $username_who_commented->bindParam(':u_id', $user_who_commented);
            $username_who_commented->execute();
            $username_who_commented = $username_who_commented->fetch(PDO::FETCH_OBJ);
            $username_who_commented = $username_who_commented->user_name;
            $subject = 'SnapCat | New comment';
            $header = 'From: noreply@snapcat.com';
            $content = "
            Hi ".$username.", you have a new comment from ".$username_who_commented."!
            
            Click this link to see your picture commented:
            http://localhost:8080/camagru/view/image.php?id=".$get_img_id."

            -----------------------------------
            Please do not reply to this email
            ";
            if (mail($email, $subject, $content, $header) == false)
                echo ("Mail wasn't sent because of an error\n");
        }
    }
    catch(Exception $e)
    {
    exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

if (isset($comment_text))
{
    if (isset($comment_text) && isset($img_file) && isset($user_id))
    {
        if (checkComment($user_id, $comment_text, $img_file))
        {
            saveCommentToDb($user_id, $comment_text, $img_file);
            sendNewCommentNotifEmail($user_id, $img_file);
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