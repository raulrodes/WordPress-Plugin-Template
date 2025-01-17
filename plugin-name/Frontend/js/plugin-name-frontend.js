window.addEventListener('load', function () {
    // call to external api
    fetch('https://example.com/api/get-data', {
        method: "get",
        headers: {
            "Accept": "application/json",
        }
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (json) {
            // call function passing data as json
        })
        .catch(function (e) {
            console.log("Error: " + e);
        });

    // call to own ajax
    fetch('/wp-admin/admin-ajax.php', {
        method: "post",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: 'param1=value1&param2=value2'
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            const el = document.getElementById('element-to-update');
            el.innerHTML = data;
        })
        .catch(function (err) {
            console.log(err);
        });
});