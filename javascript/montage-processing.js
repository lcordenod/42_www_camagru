function    createMontage(width) {
    var image_elem = document.getElementById("picture-taken");
    var filter_elem = document.getElementById("filter-img-active");

    image_src = image_elem.src;
    image_width = width;
    filter_src = filter_elem.src;
    filter_width = filter_elem.clientWidth;
    filter_top = filter_elem.offsetTop;
    filter_left = filter_elem.offsetLeft;
    postData("../controller/create-montage-controller.php", {image_src: image_src, image_width: image_width, filter_src: filter_src, filter_width: filter_width, filter_top: filter_top, filter_left: filter_left});
}

function    saveMontage() {
    var montage = document.getElementById("picture-taken");

    montage_src = montage.src;
    postData("../controller/save-montage-controller.php", {file_tmp_path: montage_src});
}