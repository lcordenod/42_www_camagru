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
        .then(text => console.log(text))
}