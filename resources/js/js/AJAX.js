async function AJAXRequest(url, method, body, token) {
    let result;
    await fetch(url, {
        method: method,
        headers: {"Content-Type": "application/json"},
        body: body,
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

let modal = document.querySelector('.modal');
let spinner = modal.querySelector('.spinner-border');
let reportableInfo = modal.querySelector('.reportable-info');
let buttons = modal.querySelectorAll('.btn-close-modal');
for (let btnCloseModal of buttons) {
    btnCloseModal.addEventListener('click', function (e) {
        spinner.style.display = "block";
        reportableInfo.style.display = "none";
    })
}
let reports = document.querySelectorAll(".report-container");
for (let report of reports) {
    let showInfoButton = report.querySelector("button");
    let id = report.querySelector('.reportable-id').id;
    let type = report.querySelector('.reportable-type').getAttribute('reportable_type');
    let CSRF = report.querySelector('[name = "_toekn"]')
    showInfoButton.addEventListener('click', () => getReportInfo(event, id, type, CSRF))
}

async function getReportInfo(event, id, type, CSRF) {
    let postData = JSON.stringify({
        id: id,
        type: type
    });
    let result = await AJAXRequest('/api/report-sender', 'POST', postData, CSRF);
    modal.querySelector('#reportable-type').textContent = result['type'];
    let sender = modal.querySelector('#sender-name');
    sender.textContent = result['sender'];
    sender.setAttribute('href', result['manage_sender']);
    modal.querySelector('#reportable-type').textContent = result['type'];
    modal.querySelector('#content').textContent = result['content'];
    modal.querySelector('#modal-form-submit').href = result['manage_ticket'];
    spinner.style.display = "none";
    reportableInfo.style.display = "block";
}

