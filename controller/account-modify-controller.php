<?php
require_once 'verify-account-controller.php';
$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$action = $decoded['action'];
$email = $decoded['email'];

if ($action == "send-reset-password-email")
{    
    sendVerifyEmail($email);
    echo "{\"status\": \"success\"}";
}
else
    echo "{\"status\": \"failed\"}";

?>