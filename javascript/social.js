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

/* function    addCommentToDB(comment) {

}

function    displayComment(comment) {

} */

(function () {
    for (var i = 0; i < comments_text_boxes.length; i++)
    {
        comments_text_boxes[i].addEventListener('keyup', function (e) {
            isCommentValid(this);
            e.preventDefault;
        }, false);
        comments_text_boxes[i].addEventListener('focusout', function (e) {
            this.parentNode.parentNode.getElementsByClassName('comment-format-error')[0].style.display = "none";
            e.preventDefault;
        }, false);
    }
})();