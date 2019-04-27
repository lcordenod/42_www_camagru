<?php
require_once 'verify-account-controller.php';
require_once 'verify-input-controller.php';
require_once '../model/input-errors.php';

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$action = $decoded['action'];
$email = $decoded['email'];
$new_email = $decode['new_email'];

function    modifyAccountEmail($current_email, $new_email) {
    $update_email = db_connect()->prepare("UPDATE user SET user_email =:new_email WHERE `user_email`=:current_email");
    $update_email->bindParam(':new_email', $new_email);
    $update_email->bindParam(':current_email', $current_email);
    $update_email->execute();
}

if ($action == "send-reset-password-email")
{    
    sendVerifyEmail($email);
    echo "{\"status\": \"success\"}";
}
else if ($action == "modify-account-email")
{
    if (doesEmailExist($new_email))
    {
        $error_backend = $email_error;
        return;
    }
    else
    {
        modifyAccountEmail($email, $new_email);
        makeUserInvalid($new_email);
        sendVerifyEmail($new_email);
        header("Location: /camagru/view/account.php");
    }
    echo "{\"status\": \"success\"}";
}
else
    echo "{\"status\": \"failed\"}";

?>