<?php
include("./sql_connect.php");

if(!session_id()) {
    session_start();
}

//id, pw 받기
$input_id = $_POST["id"];
$input_pw = $_POST["pw"];

if (empty($input_id) or empty($input_pw)) {
    echo "<script>alert('Fill in the blank plz')</script>";
    echo "<script>location.replace('../sign_in.php');</script>";
    exit;
} else {
    $select_sql = "SELECT * FROM member WHERE id = '{$input_id}'";
    $result = mysqli_fetch_array(mysqli_query($conn, $select_sql));

    if ($result['pw'] == $input_pw) {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_name'] = $result['name'];
        $_SESSION['user_score'] = $result['score'];
        echo "<script>location.replace('../index.php');</script>";
    } else {
        echo "<script>alert('아이디(로그인 전화번호, 로그인 전용 아이디) 또는 비밀번호가 잘못 되었습니다. 아이디와 비밀번호를 정확히 입력해 주세요.')</script>";
        echo "<script>location.replace('../sign_in.php');</script>";
        exit;
    }
}

mysqli_close($conn);
?>