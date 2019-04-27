<?php
require_once '../config/connect.php';

// CHECK IF USER HAS A VALID EMAIL
function    isUserValid($username_email) {
    $user_valid_check = db_connect()->prepare("SELECT user_valid FROM user WHERE `user_name`=:username OR `user_email`=:email");
    $user_valid_check->bindParam(':username', $username_email);
    $user_valid_check->bindParam(':email', $username_email);
    $user_valid_check->execute();
    $valid = $user_valid_check->fetch(PDO::FETCH_OBJ);
    if ($valid->user_valid == 0)
        return (false);
    else
        return (true);
}

// CHECK IF USER HAS A VALID EMAIL KEY
function    isUserKeyValid($username_email, $key) {
    $user_key_check = db_connect()->prepare("SELECT user_valid_key FROM user WHERE `user_name`=:username OR `user_email`=:email");
    $user_key_check->bindParam(':username', $username_email);
    $user_key_check->bindParam(':email', $username_email);
    $user_key_check->execute();
    $valid = $user_key_check->fetch(PDO::FETCH_OBJ);
    if ($valid->user_valid_key === $key)
        return (true);
    else
        return (false);
}

// CHANGE VALID STATUS TO TRUE
function    makeUserValid($username_email)
{
    $user_valid = db_connect()->prepare("UPDATE user SET user_valid = 1 WHERE `user_name`=:username OR `user_email`=:email");
    $user_valid->bindParam(':username', $username_email);
    $user_valid->bindParam(':email', $username_email);
    $user_valid->execute();
}

// CHANGE VALID STATUS TO FALSE
function    makeUserInvalid($username_email)
{
    $user_valid = db_connect()->prepare("UPDATE user SET user_valid = 0 WHERE `user_name`=:username OR `user_email`=:email");
    $user_valid->bindParam(':username', $username_email);
    $user_valid->bindParam(':email', $username_email);
    $user_valid->execute();
}

// SEND EMAIL TO USER TO VERIFY EMAIL
function    sendVerifyEmail($email){
    try {
        $username = db_connect()->prepare("SELECT `user_name` FROM user WHERE `user_email`=:email");
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
    $username->bindParam(':email', $email);
    $username->execute();
    $username = $username->fetch(PDO::FETCH_OBJ);
    $username = $username->user_name;
    $key = md5(rand(0, 1000));
    $update_key = db_connect()->prepare("UPDATE user SET user_valid_key =:user_key WHERE `user_email`=:email");
    $update_key->bindParam(':user_key', $key);
    $update_key->bindParam(':email', $email);
    $update_key->execute();
    $subject = 'SnapCat | Verify your email';
    $header = 'From: noreply@snapcat.com';
    $content = "
    Hi ".$username.", thanks for registering!
    Your registration has been taken into account but we will need you to confirm your email in order to finalize your account creation
    
    Click this link to activate your account:
    http://localhost:8080/camagru/view/verify-account.php?email=".urlencode($email)."&key=".urlencode($key)."

    -----------------------------------
    Please do not reply to this email
    ";
    if (mail($email, $subject, $content, $header) == false)
        echo ("Mail wasn't sent because of an error");
}
?>