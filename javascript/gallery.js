var empty_gallery = document.getElementById('my-gallery-empty-box');

function    showEmptyGalleryBox() {
    empty_gallery.style.display = "block";
}

function    generateSingleUserGallery(img_path, comments, likes, username, img_id, log_status)
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
        {
            var single_comment = document.createElement("div");
            var p_comment = document.createElement("p");
            p_comment.setAttribute("class", "single-comment");
            var username_comment = document.createElement("span");
            username_comment.setAttribute("class", "username-comment");
            username_comment.innerText = comments[j][0];
            var separator = document.createElement("span");
            separator.innerText = " - ";
            var user_comment = document.createElement("span");
            user_comment.setAttribute("class", "user-comment");
            user_comment.innerText = comments[j][1];
            single_comment.appendChild(p_comment);
            p_comment.appendChild(username_comment);
            p_comment.appendChild(separator);
            p_comment.appendChild(user_comment);
            comment += single_comment.innerHTML;
        }
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
    if (username && username != undefined)
    {
        var posted_by = document.createElement("div");
        posted_by.setAttribute("class", "gallery-posted-by");
        posted_by.innerText = "Posted by " + username;
        document.getElementById("my-gallery-feed").appendChild(posted_by)
    }
    document.getElementById("my-gallery-feed").appendChild(gallery);
    if (img_id && img_id != undefined && log_status == "logged in")
    {
        img_link = document.createElement("a");
        img_link.setAttribute("href", "/camagru/view/image.php?id=" + img_id);
        img_link.appendChild(picture);
        gallery.appendChild(img_link);
    }
    else
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

function    displayMoreImagesBtn() {
    var more_images_btn = document.createElement("button");
    more_images_btn.setAttribute("id", "more-images-btn");
    more_images_btn.innerHTML = "More images";
    document.getElementsByClassName("register-container")[0].appendChild(more_images_btn);
}

function    removeMoreImagesBtn() {
    document.getElementById("more-images-btn").parentNode.removeChild(document.getElementById("more-images-btn"));
}

function    getUserGallery(offset) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.includes("Catched exception"))
                console.log("DB error: " + this.responseText);
            else if (this.responseText != "null" && this.responseText != "undefined")
            {
                var gallery_array = JSON.parse(this.responseText);
                for (var i = 0; i < gallery_array.length; i++)              
                    generateSingleUserGallery(gallery_array[i][2], gallery_array[i][3], gallery_array[i][4], undefined, gallery_array[i][1], gallery_array[0][5]);
                document.getElementById("my-gallery-pictures-count").innerText = gallery_array[0][0];
                checkInput(gallery_array[0][5]);
                if (gallery_array[0][0] - offset > 5 && !document.getElementById("more-images-btn"))
                    displayMoreImagesBtn();
                else if (gallery_array[0][0] - offset <= 5 && document.getElementById("more-images-btn"))
                    removeMoreImagesBtn();
                if (document.getElementById("more-images-btn"))
                {
                    document.getElementById("more-images-btn").addEventListener("click", function() {
                        offset += 5;
                        cloneNode();
                        removeMoreImagesBtn();
                        getUserGallery(offset);
                    });
                }
            }
            else
                showEmptyGalleryBox();
        }
    };
    xmlhttp.open("POST", "../view/my-gallery-view.php", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("offset=" + offset);
}

function    getAllUsersGallery(offset) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.includes("Catched exception"))
                console.log("DB error: " + this.responseText);
            else if (this.responseText != "null" && this.responseText != "undefined")
            {
                var gallery_array = JSON.parse(this.responseText);
                for (var i = 0; i < gallery_array.length; i++)
                    generateSingleUserGallery(gallery_array[i][2], gallery_array[i][3], gallery_array[i][4], gallery_array[i][5], gallery_array[i][1], gallery_array[0][6]);
                checkInput(gallery_array[0][6]);
                if (gallery_array[0][0] - offset > 5 && !document.getElementById("more-images-btn"))
                    displayMoreImagesBtn();
                else if (gallery_array[0][0] - offset <= 5 && document.getElementById("more-images-btn"))
                    removeMoreImagesBtn();
                if (document.getElementById("more-images-btn"))
                {
                    document.getElementById("more-images-btn").addEventListener("click", function() {
                        offset += 5;
                        cloneNode();
                        removeMoreImagesBtn();
                        getAllUsersGallery(offset);
                    });
                }
            }
            else
                document.getElementById("my-gallery-feed").innerHTML = '<span style="display:block;text-align:center;">No images yet :(</span>';
        }
    };
    xmlhttp.open("POST", "/camagru/view/all-gallery-view.php", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("offset=" + offset);
}

function    getImageView(img_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != "null" && this.responseText != "undefined")
            {
                var image_array = JSON.parse(this.responseText);          
                generateSingleUserGallery(image_array[0], image_array[1], image_array[2], image_array[3]);
                checkInput(image_array[4]);
            }
            else
                alert("An error happened when loading the image");
        }
    };
    xmlhttp.open("POST", "/camagru/view/image-view.php", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("img_id=" + img_id);
}

function    deleteImage(img_id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Image deleted")
            {
                window.history.back();
                alert("Image deleted");
            }
            else
                alert("An error happened when deleting the image");
        }
    };
    xmlhttp.open("POST", "/camagru/controller/image-controller.php", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("action=delete-img&img_id=" + img_id);
}

window.addEventListener('load', function(e) {
    if (window.location.href.indexOf("index.php") != -1)
        getAllUsersGallery(0);
    else if (window.location.href.indexOf("account-my-gallery.php") != -1)
        getUserGallery(0);
    else if (window.location.href.indexOf("image.php") != -1)
    {
        var urlParams = new URLSearchParams(location.search);
        if ((img_param = urlParams.get('id')) != undefined)
        {
            img_param = img_param.toString();
            getImageView(img_param);
        }
    }
});