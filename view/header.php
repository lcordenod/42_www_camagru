<?php
    $url = $_SERVER['REQUEST_URI'];

    $active_index = "";
    $active_register = "";
    $active_login = "";
    if (strpos($url,'index.php'))
        $active_index = 'class="active"';
    else if (strpos($url,'register.php'))
        $active_register = 'class="active"';
    else if (strpos($url,'login.php'))
        $active_login = 'class="active"';
?>
<div class="header">
    <a href="#default" class="logo">SnapCat</a>
    <img id="logo-img" src="http://localhost:8080/camagru/sources/cat-img.png">
    <div class="header-right">
        <a <?php echo $active_index ?> href="index.php">Home</a>
        <a <?php echo $active_register ?> href="register.php">Register</a>
        <a <?php echo $active_login ?> href="login.php">Log In</a>
    </div>
</div>