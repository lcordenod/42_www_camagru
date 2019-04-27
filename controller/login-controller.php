<?php
require_once 'verify-input-controller.php';
require_once '../config/connect.php';

if ($_SESSION['auth'])
{
    header("Location: /camagru/index.php");
    return;
}
else if (isset($_POST['username-email']) && isset($_POST['password-login']) && $_POST['submit'] !== "OK")
{
    $DB_con = db_connect();
    // GET INPUT
    $username_email = strtolower($_POST['username-email']);
    $password = hash('whirlpool', $_POST["password-login"]);

    // GET USER
    $user_check = $DB_con->prepare("SELECT * FROM user WHERE `user_name`=:username OR `user_email`=:email");
    $user_check->bindParam(':username', $username_email);
    $user_check->bindParam(':email', $username_email);
    $user_check->execute();
    $user = $user_check->fetch(PDO::FETCH_OBJ);

    // ERROR MESSAGES
    $state = "display:none";
    $login_error = "Username/Email or password is incorrect";

    // CHECK BEFORE SUBMIT
    if ((!doesUsernameExist($username_email) && !doesEmailExist($username_email)) || doesPasswordMatch($username_email, $password) === false)
    {
        $state = "display:block";
        $error_backend = $login_error;
    }
    else
    {
        $_SESSION['auth'] = $user;
        header("Location: /camagru/index.php");
        return;
    }
}
?>