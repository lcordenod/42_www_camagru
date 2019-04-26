<?php
if (isset($_GET['message']))
{
    if ($_GET['message'] == "retrieve-confirm")
        $message = "An email has been sent to retrieve your password";
    else if ($_GET['message'] == "different-passwords")
        $message = "Passwords entered aren't the same";
    else if ($_GET['message'] == "password-too-long")
        $message = "Password entered is too long ";
    else if ($_GET['message'] == "success")
        $message = "Your password has been changed";
}
else
    header("Location: /camagru/index.php");
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
        <p><?php echo $message ?></p>
        <button id="verify-login" onclick="window.location.href = '/camagru/view/login.php';">log In</button>
    </div>
    </body>
</html>