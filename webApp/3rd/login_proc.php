<?php
function login1($conn, $user_id, $user_pw) {
    // identify and certify as the same time
    $sql = "SELECT id, pw FROM member WHERE id = '{$user_id}' AND pw = '{$user_pw}'";
    echo "SQL: {$sql}<br>";
    $ret = mysqli_query($conn, $sql);

    if($ret) {
        while($row = mysqli_fetch_assoc($ret)) {
            foreach ($row as $key => $value) {
                echo "<li>{$key}: {$value}</li>";
            }
            echo "<br>";
        }
        echo "<script>alert('login1 success')</script>";
    } else {
        echo "<script>alert('fail')</script>";
    }
}

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
foreach ($_POST as $key => $value) {
    $num = substr($key, 2);
    break;
}
echo "num: {$num}<br>";

$input_id = $_POST["id{$num}"];
$input_pw = $_POST["pw{$num}"];
echo "id: {$input_id}<br>";
echo "pw: {$input_pw}<br>";

$num = (int)$num;
switch($num) {
    case 1:
        login1($conn, $input_id, $input_pw);
        break;
}

mysqli_close($conn);
?>