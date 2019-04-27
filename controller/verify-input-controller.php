<?php
require_once '../config/connect.php';

// CHECK USERNAME FORMAT
function    check_username_chars($string) {
    if (preg_match('/^[a-zA-Z0-9_.-]*$/', $string))
        return (1);
    else
        return (0);
}

// CHECK EMAIL FORMAT
function    check_email_chars($string) {
    if (preg_match('/\s/', $string) == null)
        return (1);
    else
        return (0);
}

// CHECK IF EMAIL IS ALREADY IN DB
function    doesEmailExist($email) {
    $email_check = db_connect()->prepare("SELECT COUNT(`user_email`) FROM user WHERE `user_email`=:email");
    $email_check->bindParam(':email', $email);
    $email_check->execute();
    $email_check = $email_check->fetchColumn();
    return ($email_check);
}

// CHECK IF USERNAME IS ALREADY IN DB
function    doesUsernameExist($username) {
    $username_check = db_connect()->prepare("SELECT COUNT(`user_name`) FROM user WHERE `user_name`=:username");
    $username_check->bindParam(':username', $username);
    $username_check->execute();
    $username_check = $username_check->fetchColumn();
    return ($username_check);
}

function    doesPasswordMatch($username_email, $password) {
    $password_check = db_connect()->prepare("SELECT * FROM user WHERE `user_name`=:username OR `user_email`=:email");
    $password_check->bindParam(':username', $username_email);
    $password_check->bindParam(':email', $username_email);
    $password_check->execute();
    $user = $password_check->fetch(PDO::FETCH_OBJ);
    $password_diff = strcmp($password, $user->user_pwd);
    if ($password_diff === 0)
        return (true);
    else
        return (false);
}
?>