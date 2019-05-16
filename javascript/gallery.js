var empty_gallery = document.getElementById('my-gallery-empty-box');
var comments_text_boxes = document.getElementsByClassName('comment-text-box');

function    isUserGalleryEmpty() {
    if (comments_text_boxes.length === 0)
    {
        console.log(comments_text_boxes.length);
        showEmptyGalleryBox();
    }
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

function    loadNextContentElem() {

}

function    initFirstContentPage() {
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
    xmlhttp.send("gallery-count=" + gallery_count + "&offset=lol");
}

(function () {
    window.addEventListener('load', function(e) {
        initFirstContentPage();
    });
})();