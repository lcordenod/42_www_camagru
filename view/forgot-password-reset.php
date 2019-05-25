<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once '../controller/forgot-password-controller.php';

if ($_SESSION['auth'])
{
    header("Location: /camagru/index.php");
    return;
}
else if (isset($_POST['email']))
{
    $DB_con = db_connect();
    // GET INPUT
    $email = strtolower($_POST['email']);

    // CHECK INPUT QUERY
    $email_check = $DB_con->prepare("SELECT * FROM user WHERE `user_email`=:email");
    $email_check->bindParam(':email', $email);
    $email_check->execute();
    $user = $email_check->fetch(PDO::FETCH_OBJ);

    // ERROR MESSAGES
    $state = "display:none";
    $reset_password_error = "No account has been found with the email entered";

    // CHECK BEFORE SUBMIT
    if (!($user))
    {
        $state = "display:block";
        $error_backend = $reset_password_error;
    }
    else
    {
        sendResetPasswordEmail($email);
        header("Location: /camagru/view/forgot-password-return.php?message=retrieve-confirm");
        return;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="shortcut icon" type="image/png" href="/camagru/sources/cat-img.png"/>
    </head>
    <body onload="disableResetPasswordButton()">
    <?php
    include('header.php')
    ?>
    <form action="" method="POST" id="password-sendemail-form" onfocusout="disableResetPasswordButton()">
        <div class="register-container">
            <h1>Retrieve password by email</h1>
            <p>Please enter the email you used to create your SnapCat account</p>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" maxlength="50" onfocusout="checkEmail()" required>
            <span id="error-email">Please enter a valid email (example@email.com)</span>
            <hr>
            <button type="submit" id="reset-password-btn" value="OK">Confirm email</button>
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