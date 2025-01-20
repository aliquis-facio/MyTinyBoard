<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

//sql 서버 연결
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'student1234');
define('DB_NAME', 'NotOK');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$stmt = $mysqli->stmt_init();

/* Prepared statement, stage 1: prepare */
$sql = "SELECT * FROM member where id=?";
$stmt = $mysqli->prepare($sql);

$stmt->bind_param('s', $id);

$id = 'test';

$stmt->execute();

$ret = $stmt->get_result();
$row = $ret->fetch_assoc();

printf($row['id']);

$stmt->close();
?>