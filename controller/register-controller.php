<?php
require_once '../config/connect.php';
require_once 'verify-account-controller.php';
require_once 'verify-input-controller.php';
require_once '../model/input-errors.php';

if ($_SESSION['auth'])
{
    header("Location: /camagru/index.php");
    return;
}
else if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-rpt']) && $_POST['submit'] !== "OK")
{
    $DB_con = db_connect();
    // GET INPUT
    $username = strtolower($_POST['username']);
    $email = strtolower($_POST['email']);
    $password = hash('whirlpool', $_POST["password"]);
    $password_rpt = hash('whirlpool', $_POST["password-rpt"]);

    // CHECK PASSWORD INPUT IS SAME
    $password_diff = strcmp($password, $password_rpt);

    // CHECK BEFORE SUBMIT
    if (doesUsernameExist($_POST['username']))
    {
        $state = "display:block";
        $error_backend = $username_error;
    }
    else if (!check_username_chars($username))
    {
        $state = "display:block";
        $error_backend = $username_wrong_format;
    }
    else if (doesEmailExist($_POST['email']))
    {
        $state = "display:block";
        $error_backend = $email_error;
    }
    else if (!check_email_chars($email))
    {
        $state = "display:block";
        $error_backend = $email_wrong_format;
    }
    else if ($password_diff)
    {
        $state = "display:block";
        $error_backend = $password_error;
    }
    else if (strlen($username) > 30)
    {
        $state = "display:block";
        $error_backend = $username_toolong;
    }
    else if (strlen($email) > 50)
    {
        $state = "display:block";
        $error_backend = $email_toolong;
    }
    else if (strlen($_POST["password"]) > 30)
    {
        $state = "display:block";
        $error_backend = $password_toolong;
    }
    else
    {
        $submit = $DB_con->prepare("INSERT INTO user (`user_name`, user_email, user_pwd)
                            VALUES (:username, '$email', '$password')");
        $submit->bindParam(':username', $username);
        $submit->execute();
        sendVerifyEmail($email);
        header("Location: login.php");
        return;
    }
}
?>