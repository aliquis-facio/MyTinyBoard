<?php
//error 출력
error_reporting(E_ALL);
ini_set('display_errors', '1');

//session start
session_start();

//sql 서버 연결
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'student1234');
define('DB_NAME', 'NotOK');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$conn) {
    echo "sql not connected<br>";
}

//id, pw 받기
$input_id = $_POST["id"];
$input_pw = $_POST["pw"];

if (empty($input_id) or empty($input_pw)) {
    echo "<script>alert('Fill in the blank plz')</script>";
    echo "<script>location.replace('sign_in.php');</script>";
    exit;
} else {
    $select_sql = "SELECT * FROM member WHERE id = '{$input_id}'";
    $result = mysqli_fetch_array(mysqli_query($conn, $select_sql));

    if ($result['pw'] == $input_pw) {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_name'] = $result['name'];
        $_SESSION['user_score'] = $result['score'];
        echo "<script>location.replace('home.php');</script>";
    } else {
        echo "<script>alert('아이디(로그인 전화번호, 로그인 전용 아이디) 또는 비밀번호가 잘못 되었습니다. 아이디와 비밀번호를 정확히 입력해 주세요.')</script>";
        echo "<script>location.replace('sign_in.php');</script>";
        exit;
    }
}

mysqli_close($conn);
?>