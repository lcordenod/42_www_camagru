<?php
require_once 'verify-account-controller.php';
require_once 'verify-input-controller.php';
require_once 'forgot-password-controller.php';
require_once '../model/input-errors.php';

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$action = $decoded['action'];
$email = $decoded['email'];

function    modifyAccountEmail($current_email, $new_email) {
    $update_email = db_connect()->prepare("UPDATE user SET user_email =:new_email WHERE `user_email`=:current_email");
    $update_email->bindParam(':new_email', $new_email);
    $update_email->bindParam(':current_email', $current_email);
    $update_email->execute();
}

function    modifyAccountUsername($current_username, $new_username) {
    $update_username = db_connect()->prepare("UPDATE user SET user_name =:new_username WHERE `user_name` =:current_username");
    $update_username->bindParam(':new_username', $new_username);
    $update_username->bindParam(':current_username', $current_username);
    $update_username->execute();
}

function    modifyAccountPassword($username, $new_password) {
    $update_password = db_connect()->prepare("UPDATE user SET user_pwd =:new_password WHERE `user_name` =:username");
    $update_password->bindParam(':username', $username);
    $update_password->bindParam(':new_password', $new_password);
    $update_password->execute();
}

// SEND EMAIL WHEN USERNAME IS UPDATED
function    sendNewUsernameEmail($email){
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

if (isset($action))
{
    if ($action == "send-reset-password-email")
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

?>