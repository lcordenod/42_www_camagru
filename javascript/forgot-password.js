// BUTTON SAVE PASSWORD
function    disableSavePasswordButton()
{
    if (!password_state || !password_rpt_state)
    {
        document.getElementById("save-password-btn").disabled = true;
        document.getElementById("save-password-btn").innerText = "Fill in form before saving";
    }
    else
    {
        document.getElementById("save-password-btn").disabled = false;
        document.getElementById("save-password-btn").innerText = "Save";
    }
}

// BUTTON SEND EMAIL TO RESET PASSWORD
function    disableResetPasswordButton()
{
    if (!email_state)
    {
        document.getElementById("reset-password-btn").disabled = true;
        document.getElementById("reset-password-btn").innerText = "Fill in form before confirming";
    }
    else
    {
        document.getElementById("reset-password-btn").disabled = false;
        document.getElementById("reset-password-btn").innerText = "Confirm email";
    }
}