<?php
require_once '../config/connect.php';

header('Content-Type: text/html; charset=utf-8');
session_start();

// DEBUGGING PHP
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

if ($_SESSION['auth'])
{
    header("Location: /camagru/index.php");
    return;
}
else if (isset($_POST['username-email']) && isset($_POST['password-login']) && $_POST['submit'] !== "OK")
{
    $DB_con = db_connect();
    // GET INPUT
    $username_email = strtolower($_POST['username-email']);
    $password = hash('whirlpool', $_POST["password-login"]);

    // CHECK INPUT QUERY
    $user_check = $DB_con->prepare("SELECT * FROM user WHERE `user_name`=:username OR `user_email`=:email");
    $user_check->bindParam(':username', $username_email);
    $user_check->bindParam(':email', $username_email);
    $user_check->execute();
    $user = $user_check->fetch(PDO::FETCH_OBJ);
    $password_diff = strcmp($password, $user->user_pwd);

    // ERROR MESSAGES
    $state = "display:none";
    $login_error = "Username/Email or password is incorrect";

    // CHECK BEFORE SUBMIT
    if (!($user) || $password_diff !== 0)
    {
        $state = "display:block";
        $error_backend = $login_error;
    }
    else
    {
        $_SESSION['auth'] = $user;
        header("Location: /camagru/index.php");
        return;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body onload="disableLoginButton()">
    <?php
    include('header.php')
    ?>
    <form action="" method="POST" id="login-form" onfocusout="disableLoginButton()">
        <div class="register-container">
            <h1>Log In</h1>
            <p>Please enter your account details in order to log in to SnapCat</p>
            <hr>
            <label for="email"><b>Username or Email</b></label>
            <input type="text" placeholder="Enter Username or Email" name="username-email" id="username-email" maxlength="50" onfocusout="checkUsernameEmailLogin()" required>
            <span id="error-username-email">Please enter a valid username or email</span>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password-login" id="password-login" maxlength="30" onfocusout="checkPasswordLogin()" required>
            <span id="error-password-login">Please enter a valid password</span>
            <hr>
            <button type="submit" id="login-btn" value="OK">Log In</button>
            <span class="invalid" id="error-backend" style="<?php echo $state ?>"><?php echo $error_backend ?></span>
        </div>
        <div class="register-signin-link">
            <p>Forgotten your password? <a href="forgot-password.php">Retrieve it here</a>.</p>
        </div>
    </form>
    <script type="text/javascript" src="../controller/login-check-input.js"></script>
    </body>
</html>