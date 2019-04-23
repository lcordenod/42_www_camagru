<?php
session_start();
unset($_SESSION['auth']);
header("Location: /camagru/index.php");
?>