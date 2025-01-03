function keylogger_id() {
    let id = document.getElementById('id').value;
    document.getElementById("result_id").innerText = "id: " + id;
}

function keylogger_pw() {
    let pw = document.getElementById('pw').value;
    document.getElementById("result_pw").innerText = "pw: " + pw;
}