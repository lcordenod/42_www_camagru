function    returnFileExtension(file_name)
{
    var file_extension = file_name.replace(/^.*\./, '');
    return (file_extension);
}

function    handleImage(e) {
    var tgt = e.target || window.event.srcElement;
    files = tgt.files;

    if (FileReader && files && files.length)
    {
        var file_extension = returnFileExtension(files[0].name);
        if ((file_extension === 'jpg' || file_extension === 'png' || file_extension === 'jpeg') && files[0].size/1024/1024 < 5)
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
        else if (files[0].size/1024/1024 >= 5)
            alert("File is too big, currently " + files[0].size/1024/1024 + " mb, please upload a file lower than 5 mb");
        else
            alert("File format isn't correct, please upload a jpg/png/jpeg file (with size lower than 5 mb)");
    }
}

function    uploadToMontage(){
    var upload_src = document.getElementById('image-upload-preview').src;

    if (upload_src)
    {
        document.getElementById('camera-stream').style.display = "none";
        document.getElementById('image-upload').style.display = "block";
        document.getElementById('image-upload').src = upload_src;
        showCameraBox();
        showPicturesTakenView();
        hideNoCameraBlock();
        showFilters();
        is_image_upload = true;
    }
}