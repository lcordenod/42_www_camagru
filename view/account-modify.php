<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if (!($_SESSION['auth']))
{
    header("Location: /camagru/index.php");
    return;
}
$username = $_SESSION['auth']->user_name;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
    <?php
    include('header.php')
    ?>
    <div class="register-container">
        <h1 id="title-account"><?php echo $username ?>'s account settings</h1>
    </div>
    </body>
</html>