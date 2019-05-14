// INPUT AS VARIABLES
var password_login_input = document.getElementById("password-login");

// ERROR MESSAGES
var password_login_error = document.getElementById("error-password-login");

// INITIALIZING INPUT STATES BEFORE SUBMIT
var password_login_state = 0;

// CHECK FOR PASSWORD
function    checkPasswordDelete() {
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

function    disableDeleteButton()
{
    if (!password_login_state)
    {
        document.getElementById("delete-account-btn").disabled = true;
        document.getElementById("delete-account-btn").innerText = "Fill in form before logging in";
    }
    else
    {
        document.getElementById("delete-account-btn").disabled = false;
        document.getElementById("delete-account-btn").innerText = "Delete account";
    }
}