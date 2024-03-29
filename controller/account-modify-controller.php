<?php
require_once 'verify-account-controller.php';
require_once 'verify-input-controller.php';
require_once 'forgot-password-controller.php';
require_once '../controller/files-directories-management-controller.php';
require_once '../model/input-errors.php';
session_start();

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$action = $decoded['action'];
$action_get = $_POST['action-get'];
$email = $decoded['email'];

function    modifyAccountEmail($current_email, $new_email) {
    try
    {
        $update_email = db_connect()->prepare("UPDATE user SET user_email =:new_email WHERE `user_email`=:current_email");
        $update_email->bindParam(':new_email', $new_email);
        $update_email->bindParam(':current_email', $current_email);
        $update_email->execute();
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    modifyAccountUsername($current_username, $new_username) {
    try
    {
        $update_username = db_connect()->prepare("UPDATE user SET user_name =:new_username WHERE `user_name` =:current_username");
        $update_username->bindParam(':new_username', $new_username);
        $update_username->bindParam(':current_username', $current_username);
        $update_username->execute();
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    modifyAccountPassword($username, $new_password) {
    try
    {
        $update_password = db_connect()->prepare("UPDATE user SET user_pwd =:new_password WHERE `user_name` =:username");
        $update_password->bindParam(':username', $username);
        $update_password->bindParam(':new_password', $new_password);
        $update_password->execute();
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    deleteUserComments($user_id)
{
    try
    {
        $delete_user_comments = db_connect()->prepare("DELETE FROM comments WHERE `comment_user` =:u_id");
        $delete_user_comments->bindParam(':u_id', $user_id);
        $delete_user_comments->execute();
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    deleteUserImages($user_id)
{
    try
    {
        $delete_user_images = db_connect()->prepare("DELETE FROM images WHERE `img_user` =:u_id");
        $delete_user_images->bindParam(':u_id', $user_id);
        $delete_user_images->execute();
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    deleteUserLikes($user_id)
{
    try
    {
        $delete_user_likes = db_connect()->prepare("DELETE FROM likes WHERE `like_user` =:u_id");
        $delete_user_likes->bindParam(':u_id', $user_id);
        $delete_user_likes->execute();
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    deleteUserAccount($user_id)
{
    try
    {
        $delete_user = db_connect()->prepare("DELETE FROM user WHERE `user_id` =:u_id");
        $delete_user->bindParam(':u_id', $user_id);
        $delete_user->execute();
        deleteUserComments($user_id);
        deleteUserImages($user_id);
        deleteUserLikes($user_id);
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

// SEND EMAIL WHEN USERNAME IS UPDATED
function    sendNewUsernameEmail($email){
    try {
        $username = db_connect()->prepare("SELECT `user_name` FROM user WHERE `user_email`=:email");
        $username->bindParam(':email', $email);
        $username->execute();
        $username = $username->fetch(PDO::FETCH_OBJ);
        $username = $username->user_name;
        $subject = 'SnapCat | Your username has changed';
        $header = 'From: noreply@snapcat.com';
        $content = "
        Hi ".$username.",
        Just an email to tell you that you made a good choice, your new username rocks and is effective on SnapCat!
    
        -----------------------------------
        Please do not reply to this email
        ";
        if (mail($email, $subject, $content, $header) == false)
            echo ("Mail wasn't sent because of an error");
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    getCommentSubForUser($user_id)
{
    try {
        $get_comment_sub = db_connect()->prepare("SELECT comment_sub FROM user WHERE `user_id` =:u_id");
        $get_comment_sub->bindParam(':u_id', $user_id);
        $get_comment_sub->execute();
        return ($get_comment_sub->fetchColumn());
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

function    postCommentSubForUser($user_id)
{
    try {
        if (getCommentSubForUser($user_id) === "1")
            $new_val = 0;
        else
            $new_val = 1;
        $post_comment_sub = db_connect()->prepare("UPDATE user SET comment_sub=:new_val WHERE `user_id` =:u_id");
        $post_comment_sub->bindParam(':new_val', $new_val, PDO::PARAM_INT);
        $post_comment_sub->bindParam(':u_id', $user_id);
        $post_comment_sub->execute();
        return ($post_comment_sub->fetchColumn());
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

if (isset($action_get))
{
    echo getCommentSubForUser($_SESSION["auth"]->user_id);
}
else if (isset($action))
{
    if ($action == "post-comment-sub")
    {
        postCommentSubForUser($_SESSION["auth"]->user_id);
        echo "{\"status\": \"success\"}";
    }
    else if ($action == "send-reset-password-email")
    {
        sendVerifyEmail($email);
        echo "{\"status\": \"success\"}";
    }
    else
        echo "{\"status\": \"failed\"}";
}
else if (isset($_POST['email']) && $_POST['submit'] !== "OK")
{
    // GET INPUT
    $email = strtolower($_POST['email']);

    // CHECK BEFORE SUBMIT
    if (doesEmailExist($email))
    {
        $state = "display:block";
        $error_backend = $email_error;
    }
    else if (!check_email_chars($email))
    {
        $state = "display:block";
        $error_backend = $email_wrong_format;
    }
    else
    {
        modifyAccountEmail($_SESSION['auth']->user_email, $email);
        makeUserInvalid($email);
        sendVerifyEmail($email);
        $_SESSION['auth']->user_valid = 0;
        $_SESSION['auth']->user_email = $email;
        header("Location: /camagru/view/account.php");
        return;
    }
}
else if (isset($_POST['username']) && $_POST['submit'] !== "OK") 
{
    // GET INPUT
    $username = strtolower($_POST['username']);

    // CHECK BEFORE SUBMIT
    if (doesUsernameExist($username))
    {
        $state = "display:block";
        $error_backend = $username_error;
    }
    else if (!check_username_chars($username))
    {
        $state = "display:block";
        $error_backend = $username_wrong_format;
    }
    else
    {
        modifyAccountUsername($_SESSION['auth']->user_name, $username);
        $_SESSION['auth']->user_name = $username;
        sendNewUsernameEmail($_SESSION['auth']->user_email);
        header("Location: /camagru/view/account.php");
        return;
    }
}
else if (isset($_POST['password']) && isset($_POST['password-rpt']) && $_POST['submit'] !== "OK")
{
    // HASH INPUT
    $password = hash('whirlpool', $_POST["password"]);
    $password_rpt = hash('whirlpool', $_POST["password-rpt"]);

    // CHECK PASSWORD INPUT IS SAME
    $password_diff = strcmp($password, $password_rpt);
    $password_diff_old = strcmp($password, $_SESSION['auth']->user_pwd);

    // CHECK BEFORE SUBMIT
    if ($password_diff)
    {
        $state = "display:block";
        $error_backend = $password_error;
    }
    if (!$password_diff_old)
    {
        $state = "display:block";
        $error_backend = $new_password_same_error;
    }
    else if (strlen($_POST["password"]) > 30)
    {
        $state = "display:block";
        $error_backend = $password_toolong;
    }
    else
    {
        modifyAccountPassword($_SESSION['auth']->user_name, $password);
        $_SESSION['auth']->user_pwd = $password;
        sendConfirmResetPasswordEmail($_SESSION['auth']->user_email);
        header("Location: /camagru/view/account.php");
        return;
    }
}
else if (isset($_POST['password']) && $_POST['submit'] !== "DEL")
{
    // HASH INPUT
    $password = hash('whirlpool', $_POST["password"]);

    // CHECK PASSWORD INPUT IS SAME
    $password_diff_old = strcmp($password, $_SESSION['auth']->user_pwd);

    // CHECK BEFORE SUBMIT
    if ($password_diff_old)
    {
        $state = "display:block";
        $error_backend = $account_delete_password_error;
    }
    else if (strlen($_POST["password"]) > 30)
    {
        $state = "display:block";
        $error_backend = $password_toolong;
    }
    else
    {
        $dest_gallery = "../sources/gallery/user-".$_SESSION['auth']->user_id;
        $dest_tmp = "../sources/tmp/user-".$_SESSION['auth']->user_id;
        deleteFilesFromDir($dest_gallery);
        deleteFilesFromDir($dest_tmp);
        deleteUserAccount($_SESSION['auth']->user_id);
        session_destroy();
        header("Location: /camagru/view/account-delete-final.php");
        return;
    }
}

?>