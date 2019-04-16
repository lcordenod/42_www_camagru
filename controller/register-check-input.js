// INPUT AS VARIABLES
var email_input = document.getElementById("email");
var username_input = document.getElementById("username");
var password_input = document.getElementById("password");
var password_rpt_input = document.getElementById("password-rpt");

// ERROR MESSAGES
var username_error = document.getElementById("error-username");
var email_error = document.getElementById("error-email");
var password_error = document.getElementById("error-password");
var password_rpt_error = document.getElementById("error-password-rpt");

// INITIALIZING INPUT STATES BEFORE SUBMIT
var username_state = 0;
var email_state = 0;
var password_state = 0;
var password_letter_state = 0;
var password_capital_state = 0;
var password_number_state = 0;
var password_length_state = 0;
var password_rpt_state = 0;

// CHECK FOR USERNAME

function    checkUsername() {
    if (username_input.value === "")
    {
        username_error.style.display = "block";
        username_state = 0;
    }
    else
    {
        username_error.style.display = "none";
        username_state = 1;
    }
}

// CHECK FOR EMAIL

function    checkEmail() {
    var atpos = email_input.value.indexOf("@");
    var dotpos = email_input.value.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email_input.length)
    {
        email_error.style.display = "block";
        email_state = 0;
    }
    else
    {
        email_error.style.display = "none";
        email_state = 1;
    }
}

// CHECKS FOR PASSWORD

var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

password_input.onfocus = function() {
    document.getElementById("password-message").style.display = "block";
}

password_input.onblur = function() {
    document.getElementById("password-message").style.display = "none";
}

password_input.onkeyup = function() {
var lowerCaseLetters = /[a-z]/g;
if(password_input.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
    password_letter_state = 1;
} else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
    password_letter_state = 0;
}

var upperCaseLetters = /[A-Z]/g;
if(password_input.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
    password_capital_state = 1;
} else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
    password_capital_state = 0;
}

var numbers = /[0-9]/g;
if(password_input.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
    password_number_state = 1;
} else {
    number.classList.remove("valid");
    number.classList.add("invalid");
    password_number_state = 0;
}

if(password_input.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
    password_length_state = 1;
} else {
    length.classList.remove("valid");
    length.classList.add("invalid");
    password_length_state = 0;
    }
}

function    checkPassword() {
    checkRepeatPassword();
    if (password_input.value === "" || !password_letter_state || !password_capital_state || !password_number_state || !password_length_state)
    {
        password_error.style.display = "block";
        password_state = 0;
    }
    else
    {
        password_error.style.display = "none";
        password_state = 1;
    }
}

// CHECKS FOR REPEAT PASSWORD

function    checkRepeatPassword() {
    if (password_input.value !== password_rpt_input.value && password_input.value !== "")
    {
        password_rpt_error.style.display = "block";
        password_rpt_state = 0;
    } else
    {
        password_rpt_error.style.display = "none";
        password_rpt_state = 1;
    }
}

// BUTTON SUBMIT

function    disableSubmitButton()
{
    if (!username_state || !email_state || !password_state || !password_rpt_state)
    {
        document.getElementById("register-btn").disabled = true;
        document.getElementById("register-btn").innerText = "Fill in form before registering";
    }
    else
    {
        document.getElementById("register-btn").disabled = false;
        document.getElementById("register-btn").innerText = "Register Now";
    }
}