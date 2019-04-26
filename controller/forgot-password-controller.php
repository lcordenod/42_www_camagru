<?php
require_once '../config/connect.php';
require_once 'debug.php';

// CHECK IF RESET PASSWORD KEY FROM EMAIL LINK IS MATCHING ONE IN DB
function    isResetPasswordKeyValid($email, $key) {
    $user_key_check = db_connect()->prepare("SELECT reset_password_key FROM user WHERE `user_email`=:email");
    $user_key_check->bindParam(':email', $email);
    $user_key_check->execute();
    $valid = $user_key_check->fetch(PDO::FETCH_OBJ);
    if ($valid->reset_password_key === $key)
        return (true);
    else
        return (false);
}

// UPDATE RESET PASSWORD KEY IN DB
function    updateResetPasswordKey($email, $reset_key)
{
    $reset_password_key = db_connect()->prepare("UPDATE user SET reset_password_key =:reset_key WHERE `user_email`=:email");
    $reset_password_key->bindParam(':email', $email);
    $reset_password_key->bindParam(':reset_key', $reset_key);
    $reset_password_key->execute();
}

// DISABLE RESET PASSWORD KEY IN DB
function    disableResetPasswordKey($email)
{
    $disable_password_key = db_connect()->prepare("UPDATE user SET reset_password_key =null WHERE `user_email`=:email");
    $disable_password_key->bindParam(':email', $email);
    $disable_password_key->execute();
}

// CHECK IF NEW PASSWORD IS SAME AS OLD ONE
function    isNewPasswordDifferentFromOld($email, $password)
{
    $old_password_check = db_connect()->prepare("SELECT user_pwd FROM user WHERE `user_email`=:email");
    $old_password_check->bindParam(':email', $email);
    $old_password_check->execute();
    $old_password = $old_password_check->fetch(PDO::FETCH_OBJ);
    if ($old_password->user_pwd === $password)
        return (false);
    else
        return (true);
}

// SEND RESET LINK TO USER BY EMAIL
function    sendResetPasswordEmail($email){
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
    $subject = 'SnapCat | Reset your password';
    $header = 'From: noreply@snapcat.com';
    $content = "
    Hi ".$username.",
    Your have requested to reset your password.
    
    Click this link to reset your password:
    http://localhost:8080/camagru/view/forgot-password-save.php?email=".urlencode($email)."&key=".urlencode($key)."

    -----------------------------------
    Please do not reply to this email
    ";
    if (mail($email, $subject, $content, $header) == false)
        echo ("Mail wasn't sent because of an error");
    else
        updateResetPasswordKey($email, $key);
}

// SEND CONFIRM RESET PASSWORD EMAIL
function    sendConfirmResetPasswordEmail($email) {
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
    $subject = 'SnapCat | Your password has been changed';
    $header = 'From: noreply@snapcat.com';
    $content = "
    Hi ".$username.",
    Congrats, your new password is now effective!
    
    You may now login with your new password to enjoy SnapCat:
    http://localhost:8080/camagru/view/login.php

    -----------------------------------
    Please do not reply to this email
    ";
    if (mail($email, $subject, $content, $header) == false)
        echo ("Mail wasn't sent because of an error");
}

// UPDATE USER PASSWORD IN DB
function    updatePassword($email, $password) {
    $update_password = db_connect()->prepare("UPDATE user SET user_pwd =:user_pwd WHERE `user_email`=:email");
    $update_password->bindParam(':email', $email);
    $update_password->bindParam(':user_pwd', $password);
    $update_password->execute();
}
?>