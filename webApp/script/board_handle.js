function post_write_submit() {
	let form = document.getElementById("post_write_form");
    let input = document.getElementsByTagName("input")[0];
    let textarea = document.getElementsByTagName("textarea")[0];
    
    let raw_title = input.value;
    let raw_content = textarea.value;
    
    // check empty plcae
    let check = true;
    if (raw_title == "" || raw_content == "") {
        alert("You can't upload this empty");
        check = false;
    }
    
    // encode string to HTML Entity
    input.value = raw_title.replace(/[\u00A0-\u9999<>\&]/g, function(i) {
        return '&#'+i.charCodeAt(0)+';';
    });
    textarea.value = raw_content.replace(/[\u00A0-\u9999<>\&]/g, function(i) {
        return '&#'+i.charCodeAt(0)+';';
    });

    if (check) form.submit();
}

function post_modify_submit() {
	let form = document.getElementById("post_modify_form");
    let input = document.getElementsByTagName("input")[0];
    let textarea = document.getElementsByTagName("textarea")[0];

    let raw_title = input.value;
    let raw_content = textarea.value;
    
    // check empty plcae
    let check = true;
    if (raw_title == "" || raw_content == "") {
        alert("You can't upload this empty");
        check = false;
    }
    
    // encode string to HTML Entity
    input.value = raw_title.replace(/[\u00A0-\u9999<>\&]/g, function(i) {
        return '&#'+i.charCodeAt(0)+';';
    });
    textarea.value = raw_content.replace(/[\u00A0-\u9999<>\&]/g, function(i) {
        return '&#'+i.charCodeAt(0)+';';
    });

    if (check) form.submit();
}

function post_delete(post_id) {
    let check = confirm("Are You Sure Delete This Post?");
    if (check) location.href='./inner/post_delete.php?post_id='+post_id;
}