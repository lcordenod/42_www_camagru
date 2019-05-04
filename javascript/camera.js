(function () {
    var width = 480;
    var height = 0;
    var streaming = false;
    document.getElementById('camera-snap-btn').disabled = true;

    function    startCamera() {
        video = document.getElementById('camera-stream');
        canvas = document.getElementById('canvas');
        picture = document.getElementById('picture-taken');
        snap_button = document.getElementById('camera-snap-btn');

        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
            .then(function (stream) {
                video.srcObject = stream;
                video.play();
            })
            .catch(function (err) {
                console.log("An error occurred: " + err);
            });

        video.addEventListener('canplay', function (e) {
            if (!streaming) {
                height = video.videoHeight / (video.videoWidth / width);
                if (isNaN(height)) {
                    height = width / (4 / 3);
                }
                video.setAttribute('width', width);
                video.setAttribute('height', height);
                canvas.setAttribute('width', width);
                canvas.setAttribute('height', height);
                streaming = true;
            }
        }, false);

        snap_button.addEventListener('click', function (e) {
            takePicture();
            e.preventDefault();
        }, false);

        hidePictureTaken();
        clearPicture();
    }

    function    clearPicture() {
        var context = canvas.getContext('2d');
        context.fillStyle = "#AAA";
        context.fillRect(0, 0, canvas.width, canvas.height);

        var data = canvas.toDataURL('image/png');
        picture.setAttribute('src', data);
    }

    // Capture a picture by fetching the current contents of the video
    // and drawing it into a canvas, then converting that to a PNG
    // format data URL. By drawing it on an offscreen canvas and then
    // drawing that to the screen, we can change its size and/or apply
    // other changes before drawing it.

    function    takePicture() {
        var context = canvas.getContext('2d');
        if (width && height) {
            canvas.width = width;
            canvas.height = height;
            context.drawImage(video, 0, 0, width, height);

            var data = canvas.toDataURL('image/png');
            picture.setAttribute('src', data);
            hideCameraBox();
            showPictureTaken();
            disableFilters();
        } else {
            clearPicture();
        }
    }

    function    hideCameraBox() {
        var camera_box = document.getElementById('camera-box');
        var snap_button = document.getElementById('camera-snap-btn');
        camera_box.style.display = "none";
        snap_button.style.display = "none";
    }

    function    showCameraBox() {
        var camera_box = document.getElementById('camera-box');
        var snap_button = document.getElementById('camera-snap-btn');
        camera_box.style.display = "block";
        snap_button.style.display = "block";
    }

    function    hidePictureTaken() {
        var picture_taken = document.getElementById('picture-taken');
        var save_button = document.getElementById('camera-save-btn');
        var retry_button = document.getElementById('camera-retry-btn');
        picture_taken.style.display = "none";
        save_button.style.display = "none";
        retry_button.style.display = "none";
    }

    function    showPictureTaken() {
        var picture_taken = document.getElementById('picture-taken');
        var save_button = document.getElementById('camera-save-btn');
        var retry_button = document.getElementById('camera-retry-btn');
        picture_taken.style.display = "block";
        save_button.style.display = "inline-block";
        retry_button.style.display = "inline-block";

        retry_button.addEventListener('click', function (e) {
            resetCamera();
            e.preventDefault();
        }, false);
    }

    function    resetCamera() {
        hidePictureTaken();
        showCameraBox();
        enableFilters();
    }

    window.addEventListener('load', startCamera, false);
})();