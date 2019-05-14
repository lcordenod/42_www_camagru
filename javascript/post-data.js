function    postData(url, data = {}) {
    return fetch(url, {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
        })
        .then(res => res.text())
        .then(text => { console.log(text);
            if (url === "../controller/create-montage-controller.php"){
                var picture_taken = document.getElementById('picture-taken');
                var start = text.indexOf("..");
                var end = text.indexOf(".png");
                var montage_url = text.substr(start, end - start + 4);
                picture_taken.src = montage_url;
            }
        })
}