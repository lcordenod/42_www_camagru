function    handleImage(e) {
    var tgt = e.target || window.event.srcElement;
    files = tgt.files;

    if (FileReader && files && files.length)
    {
        var file_reader = new FileReader();
        file_reader.onload = function () {
            document.getElementById('error-no-camera').style.display = "none";
            document.getElementById('image-upload-preview').style.display = "block";
            document.getElementById('image-upload-preview').src = file_reader.result;
            document.getElementById('image-upload-btn').innerHTML = "Upload another image";
            document.getElementById('upload-confirm-btn').style.display = "block";
        }
        file_reader.readAsDataURL(files[0]);
    }
}