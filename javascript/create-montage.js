function    sendMontageDetails(width) {
    var image_elem = document.getElementById("picture-taken");
    var filter_elem = document.getElementById("filter-img-active");

    image_src = image_elem.src;
    image_width = width;
    filter_src = filter_elem.src;
    filter_width = filter_elem.clientWidth;
    filter_top = filter_elem.offsetTop;
    filter_left = filter_elem.offsetLeft;
    console.log(image_src);
    console.log(image_width);
    console.log(filter_src);
    console.log(filter_width);
    console.log(filter_top);
    console.log(filter_left);
    postData("../controller/create-montage-controller.php", {image_src: image_src, image_width: image_width, filter_src: filter_src, filter_width: filter_width, filter_top: filter_top, filter_left: filter_left})
}