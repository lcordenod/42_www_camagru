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

function    getAllUserImagesData() {
    // get all user data in one request to the server
}

function    initFirstContentPage() {
    // initialize the page with 5 images
}

function    loadNextContentElem() {
    // load the 5 next elem
}

(function () {
    window.addEventListener('load', isUserGalleryEmpty, false);
})();