var comments_text_boxes = document.getElementsByClassName('comment-text-box');

function    isCommentFormatValid(comment) {
    if (comment.value.length === 0)
    {
        comment.parentNode.parentNode.getElementsByClassName('comment-format-error')[0].style.display = "block";
        return (false);
    }
    else if (comment.value.replace(/\s/g, '').length === 0)
    {
        console.log("test");
        comment.parentNode.parentNode.getElementsByClassName('comment-format-error')[0].style.display = "block";
        return (false);
    }
    else
    {
        comment.parentNode.parentNode.getElementsByClassName('comment-format-error')[0].style.display = "none";
        return (true);
    }
}

function    isCommentLengthValid(comment) {
    var len = comment.value.length;
    if (len >= 150)
    {
        comment.parentNode.parentNode.getElementsByClassName('comment-length-error')[0].style.display = "block";
        comment.parentNode.parentNode.getElementsByClassName('comment-length')[0].style.display = "none";
        return (false);
    }
    else
    {
        comment.parentNode.parentNode.getElementsByClassName('comment-length')[0].innerHTML = comment.value.length;
        comment.parentNode.parentNode.getElementsByClassName('comment-length')[0].style.display = "block";
        comment.parentNode.parentNode.getElementsByClassName('comment-length-error')[0].style.display = "none";
        return (true);
    }
}

function    isCommentValid(comment) {
    if (!isCommentFormatValid(comment))
    {
        isCommentLengthValid(comment);
        comment.parentNode.parentNode.getElementsByClassName("comment-post-btn")[0].disabled = true;
        comment.parentNode.parentNode.getElementsByClassName('comment-length')[0].style.display = "none";
        return (false);
    }
    else if (!isCommentLengthValid(comment))
    {
        isCommentFormatValid(comment);
        comment.parentNode.parentNode.getElementsByClassName("comment-post-btn")[0].disabled = true;
        return (false);
    }
    else if (isCommentLengthValid(comment) && !isCommentFormatValid(comment))
    {
        comment.parentNode.parentNode.getElementsByClassName("comment-post-btn")[0].disabled = true;
        return (false);
    }
    else
    {
        comment.parentNode.parentNode.getElementsByClassName("comment-post-btn")[0].disabled = false;
        return (true);
    }
}

function    addCommentToDB(comment) {
    var comment_text = comment.value.trim();
    comment_text = comment_text.replace(/ +(?= )/g,'');
    comment_text = comment_text.replace(/(\r\n|\n|\r)/gm,"");
    var img_src = comment.parentNode.parentNode.parentNode.getElementsByClassName('pictures-gallery')[0].src;
    var img_file = img_src.replace(/^.*[\\\/]/, '');
    postSocial("/camagru/controller/social-controller.php", {comment_text: comment_text, img_file: img_file});
}

function    addOrRemoveLikeFromDb(img_src) {
    var img_file = img_src.replace(/^.*[\\\/]/, '');
    postSocial("/camagru/controller/social-controller.php", {img_file: img_file});
}

function    displayComment(comment) {
    if (comment.value != "")
    {
        var single_comment = document.createElement("p");
        var separator = document.createElement("span");
        var comment_username = document.createElement("span");
        var new_comment = document.createElement("span");
        single_comment.setAttribute("class", "single-comment");
        new_comment.setAttribute("class", "user-comment");
        comment_username.setAttribute("class", "username-comment");
        var text = comment.value.trim();
        text = text.replace(/ +(?= )/g,'');
        text = text.replace(/(\r\n|\n|\r)/gm,"");
        var text_node = document.createTextNode(text);
        separator.innerHTML = " - ";
        if (comment_username.innerHTML = document.getElementsByClassName("title-settings").length)
            comment_username.innerHTML = document.getElementsByClassName("title-settings")[0].parentNode.innerHTML.slice(46);
        else if (document.getElementById("title-index-username") != undefined)
            comment_username.innerHTML = document.getElementById("title-index-username").innerHTML.slice(8, -3);
        else
            alert("Couldn't add comment, please try later");
        new_comment.appendChild(text_node);
        comment.parentNode.parentNode.getElementsByClassName("gallery-social-comments")[0].appendChild(single_comment);
        single_comment.appendChild(comment_username);
        single_comment.appendChild(separator);
        single_comment.appendChild(new_comment);
    }
}

function    incrementCommentCount(comment) {
    var count = parseInt(comment.parentNode.parentNode.getElementsByClassName('comment-count')[0].innerHTML, 10);
    count++;
    comment.parentNode.parentNode.getElementsByClassName('comment-count')[0].innerHTML = count.toString(10);
}

function    incrementLikeCount(comment) {
    var count = parseInt(comment.parentNode.parentNode.getElementsByClassName('like-count')[0].innerHTML, 10);
    count++;
    comment.parentNode.parentNode.getElementsByClassName('like-count')[0].innerHTML = count.toString(10);
}

function    decrementLikeCount(comment) {
    var count = parseInt(comment.parentNode.parentNode.getElementsByClassName('like-count')[0].innerHTML, 10);
    count--;
    comment.parentNode.parentNode.getElementsByClassName('like-count')[0].innerHTML = count.toString(10);
}

function    resetInputBox(comment) {
    comment.parentNode.parentNode.getElementsByClassName('comment-text-box')[0].value = "";
    comment.parentNode.parentNode.getElementsByClassName("comment-post-btn")[0].disabled = true;
}

function    postSocial(url, data = {}) {
    return fetch(url, {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
        })
        .then(res => res.text())
        .then(text => { console.log(text);
        if (text == "comment success")
        {
            displayComment(document.querySelectorAll('img[src*="' + data['img_file']+ '"]')[0].parentNode.getElementsByClassName('comment-text-box')[0]);
            incrementCommentCount(document.querySelectorAll('img[src*="' + data['img_file']+ '"]')[0].parentNode.getElementsByClassName('comment-text-box')[0]);
            resetInputBox(document.querySelectorAll('img[src*="' + data['img_file']+ '"]')[0].parentNode.getElementsByClassName('comment-text-box')[0]);
            document.querySelectorAll('img[src*="' + data['img_file']+ '"]')[0].parentNode.getElementsByClassName('comment-length')[0].style.display = "none";
        }
        else if (text == "comment fail")
            alert("Comment failed - please try again later");
        else if (text == "like added" || text == "like removed")
        {
            if (text == "like added")
                incrementLikeCount(document.querySelectorAll('img[src*="' + data['img_file']+ '"]')[0].parentNode.getElementsByClassName('comment-text-box')[0]);
            else if (text == "like removed")
                decrementLikeCount(document.querySelectorAll('img[src*="' + data['img_file']+ '"]')[0].parentNode.getElementsByClassName('comment-text-box')[0]);
        }
        else if (text == "like fail")
            alert("Like failed - please try again later");
        })
}

function    checkInput(log_status) {
    for (var i = 0; i < comments_text_boxes.length; i++)
    {
        if (log_status === "logged in")
        {
            comments_text_boxes[i].addEventListener('keyup', function (e) {
                isCommentValid(this);
                e.preventDefault();
            }, false);
            comments_text_boxes[i].addEventListener('focusout', function (e) {
                this.parentNode.parentNode.getElementsByClassName('comment-format-error')[0].style.display = "none";
                e.preventDefault();
            }, false);
            comments_text_boxes[i].parentNode.parentNode.getElementsByClassName('comment-post-btn')[0].addEventListener('click', function (e) {
                addCommentToDB(this.parentNode.getElementsByClassName('comment-text-box')[0]);
                e.preventDefault();
            }, false);
            comments_text_boxes[i].parentNode.parentNode.getElementsByClassName('social-like-icon')[0].addEventListener('click', function (e) {
                addOrRemoveLikeFromDb(this.parentNode.parentNode.parentNode.getElementsByClassName('pictures-gallery')[0].src);
                e.preventDefault();
            }, false);
        }
        else
            comments_text_boxes[i].parentNode.parentNode.addEventListener("click", function (e) {
                window.location.href = "/camagru/view/login.php";
                e.preventDefault();
            }, false);
    }
}

// Cloning gallery-feed to reset eventlisteners and avoid having multiple check inputs when more than one page
function    cloneNode()
{
    var old_elem = document.getElementById("my-gallery-feed");
    var new_elem = old_elem.cloneNode(true);
    old_elem.parentNode.replaceChild(new_elem, old_elem);
}