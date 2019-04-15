var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// CHECK FOR EMAIL

function    checkEmail() {
    var email = document.getElementById("email");
    var error_message = document.getElementById("error-email");
    var atpos = email.value.indexOf("@");
    var dotpos = email.value.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
        error_message.style.display = "block";
        return false;
    }
    else {
        error_message.style.display = "none";
    }
}

// CHECKS FOR PASSWORD

myInput.onfocus = function() {
    document.getElementById("password-message").style.display = "block";
}

myInput.onfocusout = function() {
    document.getElementById("error-password").style.display = "block";
    console.log("test");
}

myInput.onblur = function() {
    document.getElementById("password-message").style.display = "none";
}

myInput.onkeyup = function() {
var lowerCaseLetters = /[a-z]/g;
if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
} else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

var upperCaseLetters = /[A-Z]/g;
if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
} else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
}

var numbers = /[0-9]/g;
if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
} else {
    number.classList.remove("valid");
    number.classList.add("invalid");
}

if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
} else {
    length.classList.remove("valid");
    length.classList.add("invalid");
    }
}

// CHECKS FOR REPEAT PASSWORD

function    checkRepeatPassword() {
    var password = document.getElementById("password");
    var password_rpt = document.getElementById("password-rpt");
    var error_message = document.getElementById("error-password-rpt");
    if (password.value !== password_rpt.value && password_rpt.value !== "")
    {
        error_message.style.display = "block";
        return false;
    } else {
        console.log("else");
        error_message.style.display = "none";
    }
}