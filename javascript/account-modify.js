function    sendVerifyEmail(email_to) {
    postData("../controller/account-modify-controller.php", {action: "send-reset-password-email", email: email_to});
    console.log("par ici");
}

function    disableConfirmUsernameButton()
{
    if (!username_state)
    {
        document.getElementById("confirm-username-btn").disabled = true;
        document.getElementById("confirm-username-btn").innerText = "Fill in form before confirming";
    }
    else
    {
        document.getElementById("confirm-username-btn").disabled = false;
        document.getElementById("confirm-username-btn").innerText = "Confirm username";
    }
}