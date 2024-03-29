<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/forgot-password-controller.php';

if ($_SESSION['auth'])
{
    header("Location: /camagru/index.php");
    return;
}
else if (isset($_GET['email']) && isset($_GET['key']))
{ 
    if (!isResetPasswordKeyValid($_GET['email'], $_GET['key']))
        header("Location: /camagru/view/forgot-password-return.php?message=invalid-link");
    else if (isset($_POST["password"]) && $_POST["password-rpt"] && $_POST['submit'] !== "OK") {
        $password = hash('whirlpool', $_POST["password"]);
        $password_rpt = hash('whirlpool', $_POST["password-rpt"]);
        $password_diff = strcmp($password, $password_rpt);
        if ($password_diff)
            header("Location: /camagru/view/forgot-password-return.php?message=different-passwords");
        else if (strlen($_POST["password"]) > 30)
            header("Location: /camagru/view/forgot-password-return.php?message=password-too-long");
        else if (!isNewPasswordDifferentFromOld($_GET['email'], $password))
            header("Location: /camagru/view/forgot-password-return.php?message=same-password-as-before");
        else {
            updatePassword($_GET['email'], $password);
            disableResetPasswordKey($_GET['email'], $_GET['key']);
            sendConfirmResetPasswordEmail($_GET['email']);
            header("Location: /camagru/view/forgot-password-return.php?message=success");
        }
    }
}
else
    header("Location: /camagru/view/forgot-password-return.php?message=wrong-link");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="shortcut icon" type="image/png" href="/camagru/sources/cat-img.png"/>
    </head>
    <body onload="disableSavePasswordButton()">
    <?php
    include('header.php')
    ?>
    <form action="" method="POST" id="password-reset-form">
        <div class="register-container">
            <h1>New Password</h1>
            <p>Fill in this form to create your new password for your account</p>
            <hr>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" maxlength="30" onfocusout="checkPassword();disableSavePasswordButton()" required>
            <span id="error-password">Please enter a valid password</span>
            <div id="password-message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <label for="password-rpt"><b>Repeat password</b></label>
            <input type="password" placeholder="Repeat Password" name="password-rpt" id="password-rpt" maxlength="30" onkeyup="checkRepeatPassword();disableSavePasswordButton()" required>
            <span id="error-password-rpt">Please enter a password repeat that matches password</span>
            <hr>
            <button type="submit" id="save-password-btn" value="OK">Save</button>
            <span class="invalid" id="error-backend" style="<?php echo $state ?>"><?php echo $error_backend ?></span>
        </div>
        <div class="register-signin-link">
            <p>Remember your password? <a href="login.php">Log in here</a>.</p>
        </div>
    </form>
    <?php
    include('footer.php')
    ?>
    <script type="text/javascript" src="../javascript/register-check-input.js"></script>
    <script type="text/javascript" src="../javascript/forgot-password.js"></script>
    </body>
</html>