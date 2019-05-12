var comments_text_boxes = document.getElementsByClassName('comment-text-box');

function    isCommentFormatValid(comment) {
    if (comment.value.length === 0)
    {
        document.getElementById('comment-format-error').style.display = "block";
        return (false);
    }
    else
    {
        document.getElementById('comment-format-error').style.display = "none";
        return (true);
    }
}

function    isCommentLengthValid(comment) {
    var len = comment.value.length;
    if (len >= 150)
    {
        document.getElementById('comment-length-error').style.display = "block";
        document.getElementById('comment-length').style.display = "none";
        return (false);
    }
    else
    {
        document.getElementById('comment-length').innerHTML = comment.value.length;
        document.getElementById('comment-length').style.display = "block";
        document.getElementById('comment-length-error').style.display = "none";
        return (true);
    }
}

function    isCommentValid(comment) {
    if (!isCommentFormatValid(comment))
    {
        isCommentLengthValid(comment);
        comment.parentNode.querySelector("#comment-post-btn").disabled = true;
        document.getElementById('comment-length').style.display = "none";
        return (false);
    }
    else if (!isCommentLengthValid(comment))
    {
        isCommentFormatValid(comment);
        comment.parentNode.querySelector("#comment-post-btn").disabled = true;
        return (false);
    }
    else
    {
        comment.parentNode.querySelector("#comment-post-btn").disabled = false;
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
            document.getElementById('comment-format-error').style.display = "none";
            e.preventDefault;
        }, false);
    }
})();