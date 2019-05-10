<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if (!($_SESSION['auth']))
    header("Location: /camagru/index.php");
else if ($_SESSION['auth']->user_valid === 0)
    header("Location: /camagru/index.php");

?>