<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'student1234');
define('DB_NAME', 'NotOK');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create Connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check Connection
if ($conn -> connect_error) {
    die("Connection failed: " . $conn -> connect_error);
}

// Prepare and Bind
$stmt = $conn -> prepare("SELECT * FROM board WHERE title = ?");

$test = 'asdf';
$stmt -> bind_param("s", $test);

/* execute query */
$stmt -> execute();

/* bind result variables */
$stmt -> bind_result($res);

/* fetch value */
$stmt -> fetch();

echo($test . " is in res " . $res);
?>
