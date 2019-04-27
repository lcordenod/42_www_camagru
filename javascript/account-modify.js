function    sendVerifyEmail(email_to) {
    postData("../controller/account-modify-controller.php", {action: "send-reset-password-email", email: email_to});
}

function    modifyAccountEmail(current_email) {
    postData("../controller/account-modify-controller.php", {action: "modify-account-email", email: current_email, new_email: new_email});
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