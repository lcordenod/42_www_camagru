var empty_gallery = document.getElementById('my-gallery-empty-box');
var comments_text_boxes = document.getElementsByClassName('comment-text-box');

function    isUserGalleryEmpty() {
    if (comments_text_boxes.length === 0)
        showEmptyGalleryBox();
}

function    showEmptyGalleryBox() {
    empty_gallery.style.display = "block";
}

function    hideEmptyGalleryBox() {

}

function    showUserGalleryBox() {

}

function    hideUserGalleryBox() {

}

function    getUserGalleryData() {

}

function    getUsersGalleryData() {
    // get all user data in one request to the server
}

function    doesNextPageExist(gallery_count, offset)
{
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText)
            {
                console.log(this.responseText);
                var node = document.createElement("button");
                var textnode = document.createTextNode("Load more images");
                node.appendChild(textnode);
                document.getElementById("my-gallery-feed").appendChild(node);
            }
        }
    };
    xmlhttp.open("POST", "../view/my-gallery-view.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("action=check" + "&gallery-count=" + gallery_count + "&offset=" + offset);
}

function    loadNextContentElem() {
    
}

function    initFirstContentPageSec() {
    var gallery_count = 5;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            if (!(document.getElementById("my-gallery-feed").innerHTML = this.responseText))
                isUserGalleryEmpty();
        }
    };
    xmlhttp.open("POST", "../view/my-gallery-view.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("action=init" + "&gallery-count=" + gallery_count);
}


(function () {
    window.addEventListener('load', function(e) {
        initFirstContentPage();
    });
    doesNextPageExist(5, 5);
})();