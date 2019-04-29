<?php
require_once 'verify-account-controller.php';
require_once 'verify-input-controller.php';
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
    if (doesEmailExist($email) && check_email_chars($email))
    {
        $state = "display:block";
        $error_backend = $email_error;
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

?>