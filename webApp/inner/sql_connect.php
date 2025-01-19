<?php
    //sql 서버 연결
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'student1234');
    define('DB_NAME', 'NotOK');

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if(!$conn) {
        echo "sql not connected<br>";
    }
?>