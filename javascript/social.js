var comments_text_boxes = document.getElementsByClassName('comment-text-box');

function    isCommentFormatValid(comment) {
    if (comment.value.length === 0)
    {
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
    else
    {
        comment.parentNode.parentNode.getElementsByClassName("comment-post-btn")[0].disabled = false;
        return (true);
    }
}

function    addCommentToDB(comment) {
    var comment_text = comment.value;
    var img_src = comment.parentNode.parentNode.parentNode.getElementsByClassName('pictures-gallery')[0].src;
    var img_file = img_src.replace(/^.*[\\\/]/, '');
    var user_id = img_file.match(/user-([0-9]*)/)[1];
    postData("../controller/social-controller.php", {comment_text: comment_text, img_file: img_file, user_id: user_id});
}

function    displayComment(comment) {
    var single_comment = document.createElement("p");
    var separator = document.createElement("span");
    var comment_username = document.createElement("span");
    var new_comment = document.createElement("span");
    single_comment.setAttribute("class", "single-comment");
    new_comment.setAttribute("class", "user-comment");
    comment_username.setAttribute("class", "username-comment");
    var text = comment.value;
    var text_node = document.createTextNode(text);
    separator.innerHTML = " - ";
    comment_username.innerHTML = document.getElementsByClassName("title-settings")[0].parentNode.innerHTML.slice(46);
    new_comment.appendChild(text_node);
    comment.parentNode.parentNode.getElementsByClassName("gallery-social-comments")[0].appendChild(single_comment);
    single_comment.appendChild(comment_username);
    single_comment.appendChild(separator);
    single_comment.appendChild(new_comment);
}

function    resetInputBox(comment) {
    comment.parentNode.parentNode.getElementsByClassName('comment-text-box')[0].value = "";
    comment.parentNode.parentNode.getElementsByClassName("comment-post-btn")[0].disabled = true;
}

(function () {
    for (var i = 0; i < comments_text_boxes.length; i++)
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
            displayComment(this.parentNode.getElementsByClassName('comment-text-box')[0]);
            addCommentToDB(this.parentNode.getElementsByClassName('comment-text-box')[0]);
            resetInputBox(this.parentNode.getElementsByClassName('comment-text-box')[0]);
            e.preventDefault();
        }, false);
    }
})();