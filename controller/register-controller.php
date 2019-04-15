<?php

require_once '../config/connect.php';
session_start();

if ($_POST['username'] !== '' && $_POST['email'] !== '' && $_POST['password'] !== '' && $_POST['password-rpt'] !== '' && $_POST['submit'] !== "OK")
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password']);
}

?>