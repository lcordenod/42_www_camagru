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

function    getCommentSub()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "1")
            {
                document.getElementsByTagName("input")[0].checked = true;
            }
            else if (this.responseText == "0")
                document.getElementsByTagName("input")[0].checked = false;
        }
    };
    xmlhttp.open("POST", "/camagru/controller/account-modify-controller.php", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("action-get=get-comment-sub");
}

function    postCommentSub()
{
    postData("../controller/account-modify-controller.php", {action: "post-comment-sub"});
}

window.addEventListener('load', function(e) {
    if (window.location.href.indexOf("account.php") != -1)
    {
        getCommentSub();
        document.getElementsByTagName("input")[0].addEventListener("click", postCommentSub);
    }
});