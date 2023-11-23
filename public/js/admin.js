function ajaxRequest(url, method, data = null) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open(method, url);
        xhr.send(data ? data : null);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                console.group("Ajax Request Response");
                console.log(xhr.responseText);
                console.groupEnd();
                resolve(JSON.parse(xhr.responseText));
            } else {
                reject(new Error(xhr.statusText));
            }
        };
        xhr.onerror = function () {
            reject(new Error('Network error'));
        };
    });
}
