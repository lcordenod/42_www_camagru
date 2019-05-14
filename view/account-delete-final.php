<?php
session_start();
if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])) {
    header("Location: /camagru/index.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
    <div class="register-container">
        <h1 id="title-account">Hi ;)</h1>
        <p>Your account is now deleted</p>
    </div>
    </body>
</html>