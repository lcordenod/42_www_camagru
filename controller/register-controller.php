<?php
require_once '../config/connect.php';
require_once '../controller/verify-account-controller.php';

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

    // CHECK INPUT QUERY
    $username_check = $DB_con->prepare("SELECT COUNT(`user_name`) FROM user WHERE `user_name`=:username");
    $username_check->bindParam(':username', $username);
    $username_check->execute();
    $username_check = $username_check->fetchColumn();
    $email_check = $DB_con->prepare("SELECT COUNT(`user_email`) FROM user WHERE `user_email`=:email");
    $email_check->bindParam(':email', $email);
    $email_check->execute();
    $email_check = $email_check->fetchColumn();
    $password_diff = strcmp($password, $password_rpt);

    // CHECK INPUT
    function    check_username_chars($string) {
        if (preg_match('/^[a-zA-Z0-9_.-]*$/', $string))
            return (1);
        else
            return (0);
    }

    function    check_email_chars($string) {
        if (preg_match('/\s/', $string) == null)
            return (1);
        else
            return (0);
    }
    

    // ERROR MESSAGES
    $state = "display:none";
    $username_error = "Username already exists, please enter another one";
    $username_wrong_format = "Username entered format is wrong (only letters and numbers)";
    $username_toolong = "Please make sure username is equal or less than 30 characters";
    $email_error = "Email is already used, please enter another one or connect with that one";
    $email_wrong_format = "Email entered format is wrong (example@email.com)";
    $email_toolong = "Please make sure email is equal or less than 50 characters";
    $password_error = "Password entered isn't valid";
    $password_toolong = "Please make sure password is equal or less than 50 characters";

    // CHECK BEFORE SUBMIT
    if ($username_check)
    {
        $state = "display:block";
        $error_backend = $username_error;
    }
    else if (!check_username_chars($username))
    {
        $state = "display:block";
        $error_backend = $username_wrong_format;
    }
    else if ($email_check)
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
                            VALUES ('$username', '$email', '$password')");
        $submit->execute();
        sendVerifyEmail($email);
        header("Location: login.php");
        return;
    }
}
?>