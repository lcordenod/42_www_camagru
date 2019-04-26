// INPUT AS VARIABLES
var username_email_input = document.getElementById("username-email");
var password_login_input = document.getElementById("password-login");

// ERROR MESSAGES
var username_email_error = document.getElementById("error-username-email");
var password_login_error = document.getElementById("error-password-login");

// INITIALIZING INPUT STATES BEFORE SUBMIT
var username_email_state = 0;
var password_login_state = 0;

// CHECK FOR WHITESPACE AND SPECIAL CHARS IN INPUT
function    checkUsernameChars(string) {
    var regex = /^[a-zA-Z0-9_.-]*$/;
    if (string.match(regex))
        return (1);
    else
        return (0);
}

function    checkEmailChars(string) {
    var regex = /\s/;
    if (string.match(regex) == null)
        return (1);
    else
        return (0);
}

// CHECK FOR USERNAME/EMAIL
function    checkUsernameEmailLogin() {
    var atpos = username_email_input.value.indexOf("@");
    var dotpos = username_email_input.value.lastIndexOf(".");
    if ((atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= username_email_input.length || checkEmailChars(username_email_input.value) == 0)
    && (username_email_input.value === "" || checkUsernameChars(username_email_input.value) == 0))
    {
        username_email_error.style.display = "block";
        username_email_state = 0;
    }
    else
    {
        username_email_error.style.display = "none";
        username_email_state = 1;
    }
}

// CHECK FOR PASSWORD
function    checkPasswordLogin() {
    if (password_login_input.value === "" || !(password_login_input.value.length >= 8))
    {
        password_login_error.style.display = "block";
        password_login_state = 0;
    }
    else
    {
        password_login_error.style.display = "none";
        password_login_state = 1;
    }
}

// BUTTON LOGIN
function    disableLoginButton()
{
    if (!username_email_state || !password_login_state)
    {
        document.getElementById("login-btn").disabled = true;
        document.getElementById("login-btn").innerText = "Fill in form before logging in";
    }
    else
    {
        document.getElementById("login-btn").disabled = false;
        document.getElementById("login-btn").innerText = "Log In";
    }
}

setTimeout(function(){
    document.getElementById("error-backend").style.display = "none";
}, 3000)