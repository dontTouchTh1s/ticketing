async function AJAX_request(url, method, body) {
    let result;
    await fetch(url, {
        method: method,
        headers: {"Content-Type": "application/json"},
        body: body
    })
        .then(
            function (response) {
                return response.json();
            }
        )
        .then(function (data) {
            result = data
        })
        .catch(error => {
            console.log(error);
            result = false;
        });
    return result;
}

let reports = document.querySelectorAll(".report-container");
for (let report of reports) {
    let showInfoButton = report.querySelector("button");
    let id = report.querySelector('.report-id').id;
    showInfoButton.addEventListener('click', () => getReportInfo(event, id))
}

async function getReportInfo(event, id) {
    let postData = JSON.stringify({id: id});
    let result = await AJAX_request('/api/report-sender', 'POST', '')
}

