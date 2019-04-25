<?php
    function console_logg( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    $url = $_SERVER['REQUEST_URI'];

    $active_index = "";
    $active_second_css = "";
    $active_third_css = "";
    $valid_email_html = "";
    
    if (isset($_SESSION['auth']))
    {
        $second_url = "/camagru/view/account.php";
        $third_url = "/camagru/view/logout.php";
        $second_txt = "My Account";
        $third_txt = "Log Out";
        if (strpos($url,'index.php'))
            $active_index = 'class="active"';
        else if (strpos($url,'account.php'))
            $active_second_css = 'class="active"';
            console_logg("test");
            console_logg($_SESSION['auth']->user_valid);
        if (!$_SESSION['auth']->user_valid)
            $valid_email_html = '<div id="valid-email-html">Please validate your email to access all your account settings</div>';
    } else {
        $second_url = "/camagru/view/register.php";
        $third_url = "/camagru/view/login.php";
        $second_txt = "Register";
        $third_txt = "Log In";
        if (strpos($url,'index.php'))
            $active_index = 'class="active"';
        else if (strpos($url,'register.php'))
            $active_second_css = 'class="active"';
        else if (strpos($url,'login.php'))
            $active_third_css = 'class="active"';
    }

?>
<div class="header">
    <a href="/camagru/index.php" class="logo">SnapCat</a>
    <img id="logo-img" src="http://localhost:8080/camagru/sources/cat-img.png">
    <div class="header-right">
        <a <?php echo $active_index ?> href="/camagru/index.php">Home</a>
        <a <?php echo $active_second_css ?> href="<?php echo $second_url ?>"><?php echo $second_txt ?></a>
        <a <?php echo $active_third_css ?> href="<?php echo $third_url ?>"><?php echo $third_txt ?></a>
    </div>
</div>
<?php echo $valid_email_html ?>