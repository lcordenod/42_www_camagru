function    sendVerifyEmail(email_to) {
    postData("../controller/account-modify-controller.php", {action: "send-reset-password-email", email: email_to});
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

function postData(url, data = {}) {
    return fetch(url, {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
        })
    .then(response => {
        return response.json()
    })
}