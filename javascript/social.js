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
    console.log (postData("../controller/social-controller.php", {comment_text: comment_text, img_file: img_file}));
}

function    addLikeToDb(img_src) {
    var img_file = img_src.replace(/^.*[\\\/]/, '');
    postData("../controller/social-controller.php", {img_file: img_file});
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
            if (addCommentToDB(this.parentNode.getElementsByClassName('comment-text-box')[0]) == "comment success")
            {
                displayComment(this.parentNode.getElementsByClassName('comment-text-box')[0]);
                incrementCommentCount(this.parentNode.getElementsByClassName('comment-text-box')[0]);
            }
            else
                alert("Comment format is incorrect")
            resetInputBox(this.parentNode.getElementsByClassName('comment-text-box')[0]);
            e.preventDefault();
        }, false);
        comments_text_boxes[i].parentNode.parentNode.getElementsByClassName('social-like-icon')[0].addEventListener('click', function (e) {
/*             if (times_clicked % 2 == 0) {
                decrementLikeCount(this.parentNode.parentNode.getElementsByClassName('comment-text-box')[0]);
            } else {
                incrementLikeCount(this.parentNode.parentNode.getElementsByClassName('comment-text-box')[0]);
            }
            addLikeToDb(this.parentNode.parentNode.parentNode.getElementsByClassName('pictures-gallery')[0].src); */
            e.preventDefault();
        }, false);
    }
})();