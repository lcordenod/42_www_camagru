<?php
if (isset($_GET['message']))
{
    $button = '<button id="verify-login" onclick="window.location.href = \'/camagru/view/login.php\';">Log In</button>';
    if ($_GET['message'] == "retrieve-confirm")
    {
        $message = "An email has been sent to retrieve your password";
        $button = '<button id="verify-login" onclick="window.location.href = \'/camagru/index.php\';">Go back to homepage</button>';
    }
    else if ($_GET['message'] == "different-passwords")
    {
        $message = "Passwords entered aren't the same";
        $button = '<button id="verify-login" onclick="window.history.back();">Go back</button>';
    }
    else if ($_GET['message'] == "same-password-as-before")
    {
        $message = "You used the same password as current one set for your account, you may now:";
        $button = '<button id="verify-login" onclick="window.history.back();">Go back</button>
        <br><button id="verify-login" onclick="window.location.href = \'/camagru/view/login.php\';">Log In</button>';
    }
    else if ($_GET['message'] == "password-too-long")
    {
        $message = "Password entered is too long ";
        $button = '<button id="verify-login" onclick="window.history.back();">Go back</button>';
    }
    else if ($_GET['message'] == "wrong-link")
    {
        $message = "Reset password link is wrong or incomplete, please check link entered or generate another one";
        $button = '<button id="verify-login" onclick="window.location.href = \'/camagru/view/forgot-password-reset.php\';">Send another reset link</button>';
    }
    else if ($_GET['message'] == "invalid-link")
    {
        $message = "Reset password link is invalid or expired, please generate another one";
        $button = '<button id="verify-login" onclick="window.location.href = \'/camagru/view/forgot-password-reset.php\';">Send another reset link</button>';
    }
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
        <?php echo $button ?>
    </div>
    </body>
</html>