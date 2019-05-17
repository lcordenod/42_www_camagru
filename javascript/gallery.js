var empty_gallery = document.getElementById('my-gallery-empty-box');
var comments_text_boxes = document.getElementsByClassName('comment-text-box');

function    showEmptyGalleryBox() {
    empty_gallery.style.display = "block";
}

function    generateSingleUserGallery(img_path, comments, likes)
{
    var gallery = document.createElement("div");
    gallery.setAttribute("class", "pictures-gallery-box");
    var picture = document.createElement("img");
    picture.setAttribute("class", "pictures-gallery");
    picture.src = img_path;
    var social = document.createElement("form");
    social.setAttribute("method", "POST");
    social.setAttribute("class", "gallery-social-block");
    var icons = document.createElement("div");
    icons.setAttribute("class", "gallery-social-icons");
    if (comments.length != undefined)
        icons.innerHTML = '<span class="like-count">' + likes + '</span><span class="social-like-icon">👍</span> <span class="comment-count">' + comments.length + '</span> 💬</div>';
    else
        icons.innerHTML = '<span class="like-count">' + likes + '</span><span class="social-like-icon">👍</span> <span class="comment-count">' + 0 + '</span> 💬</div>';
    var comment = "";
    if (comments != 0 && comments != undefined)
    {
        for (var j = 0; j < comments.length; j++)
            comment += '<p class="single-comment"><span class="username-comment">' + comments[j][0] + '</span><span> - </span><span class="user-comment">' + comments[j][1] +'</span></p>';
    }
    var comments_container = document.createElement("div");
    comments_container.setAttribute("class", "gallery-social-comments");
    comments_container.innerHTML = comment;
    var comment_input = document.createElement("div");
    comment_input.setAttribute("class", "gallery-social-comment");
    var text_area = document.createElement("textarea");
    text_area.setAttribute("placeholder", "Write a comment...");
    text_area.setAttribute("name", "comment");
    text_area.setAttribute("class", "comment-text-box");
    var comment_btn = document.createElement("button");
    comment_btn.setAttribute("class", "comment-post-btn");
    comment_btn.disabled = true;
    comment_btn.innerHTML = "Post";
    var comment_length = document.createElement("div");
    comment_length.setAttribute("class", "comment-length");
    var comment_length_error = document.createElement("div");
    comment_length_error.setAttribute("class", "comment-length-error");
    comment_length_error.innerHTML = "Comment is too long, must be less than 150 characters";
    var comment_format_error = document.createElement("div");
    comment_format_error.setAttribute("class", "comment-format-error");
    comment_format_error.innerHTML = "Comment format is incorrect";
    document.getElementById("my-gallery-feed").appendChild(gallery);
    gallery.appendChild(picture);
    social.appendChild(icons);
    social.appendChild(comments_container);
    comment_input.appendChild(text_area);
    comment_input.appendChild(comment_btn);
    comment_input.appendChild(comment_length);
    comment_input.appendChild(comment_length);
    social.appendChild(comment_input);
    comment_input.appendChild(comment_format_error);
    comment_input.appendChild(comment_length_error);
    gallery.appendChild(social);
}

function    getAllUsersGallery() {
    // get all user data in one request to the server
}

function    loadNextContentElem() {
    
}

function    getUserGallery() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != "null" && this.responseText != "undefined")
            {
                var gallery_array = JSON.parse(this.responseText);
                for (var i = 0; i < gallery_array.length; i++)
                    generateSingleUserGallery(gallery_array[i][2], gallery_array[i][3], gallery_array[i][4]);
                document.getElementById("my-gallery-pictures-count").innerHTML = gallery_array[0][0];
                checkInput();
            }
            else
                showEmptyGalleryBox();
        }
    };
    xmlhttp.open("POST", "../view/my-gallery-view.php", true);
    xmlhttp.send();
}

window.addEventListener('load', function(e) {
    getUserGallery();
});