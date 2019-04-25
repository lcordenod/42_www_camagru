// BUTTON SAVE PASSWORD
function    disableSubmitButton()
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