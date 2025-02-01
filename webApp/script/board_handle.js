function post_write_submit() {
    // Get user input post content
	let form = document.getElementById("post_write_form");
    let input = document.getElementsByTagName("input")[0];
    let textarea = document.getElementsByTagName("textarea")[0];
    
    let raw_title = input.value;
    let raw_content = textarea.value;
    
    // Check empty place
    let check = true;
    if (raw_title == "" || raw_content == "") {
        alert("You can't upload this empty");
        check = false;
    }
    
    // Encode string to HTML Entity
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

function coment_write_submit() {
    let form = document.getElementById("coment_form");
    let input = document.getElementById("reply_input");
    
    let raw_reply = input.value;
    
    // Check empty
    if (raw_reply == "") {
        alert("댓글을 입력해주세요!");
    } else {
        // encode string to HTML Entity
        input.value = raw_reply.replace(/[\u00A0-\u9999<>\&]/g, function(i) {
            return '&#'+i.charCodeAt(0)+';';
        });
        form.submit();
    }
}

function coment_modify_submit() {
    let form = document.getElementById("coment_form");
    let input = document.getElementById("reply_input");
    
    let raw_reply = input.value;
    
    // Check empty
    if (raw_reply == "") {
        alert("댓글을 입력해주세요!");
    } else {
        // encode string to HTML Entity
        input.value = raw_reply.replace(/[\u00A0-\u9999<>\&]/g, function(i) {
            return '&#'+i.charCodeAt(0)+';';
        });
        form.submit();
    }
}

function coment_delete(coment_id) {
    let check = confirm("정말로 댓글을 지우시겠습니까?");
    if (check) location.href='./inner/coment_delete.php?coment_id='+coment_id;
}