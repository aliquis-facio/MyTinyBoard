<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'student1234');
define('DB_NAME', 'NotOK');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$city = "'s-Hertogenbosch";
$escaped_city = mysqli_real_escape_string($mysqli, $city);

echo "original: {$city}<br>";
echo "escaped: {$escaped_city}"
?>