function post_write_submit() {
	let form = document.getElementById("post_write_form");
    let inputs = document.getElementsByTagName("input");
    let check = true;

    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "") {
            alert("You can't upload this empty");
            check = false;
            break;
        }
    }

    if (check) {
		form.submit();
	}
}