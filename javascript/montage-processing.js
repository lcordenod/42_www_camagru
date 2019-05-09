function    createMontage(width) {
    var image_elem = document.getElementById("picture-taken");
    var filter_elem = document.getElementById("filter-img-active");
    var image_upload = document.getElementById("image-upload");
    var width_scaling = 1;

    image_src = image_elem.src;
    image_width = width;
    if (image_upload.length !== 0 && image_upload.length !== undefined)
        width_scaling = 480 / image_upload.clientWidth;
    else if (document.body.clientWidth <= 545)
        width_scaling *= 1.6;
    filter_src = filter_elem.src;
    filter_width = filter_elem.clientWidth * width_scaling;
    filter_top = filter_elem.offsetTop * width_scaling;
    filter_left = filter_elem.offsetLeft * width_scaling;
    postData("../controller/create-montage-controller.php", {image_src: image_src, image_width: image_width, filter_src: filter_src, filter_width: filter_width, filter_top: filter_top, filter_left: filter_left});
}

function    saveMontage() {
    var montage = document.getElementById("picture-taken");
    montage_src = montage.src;
    postData("../controller/save-montage-controller.php", {file_tmp_path: montage_src});
}