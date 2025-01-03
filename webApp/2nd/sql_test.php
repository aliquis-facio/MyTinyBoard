<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo "error report<br>";
?>

<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'student1234');
define('DB_NAME', 'NotOK');
echo "define<br>";

$db_conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($db_conn) {
    echo "DB Connect OK<br>";
} else {
    echo "DB Connect Fail<br>";
}

$sql = "SELECT * FROM member";
$result = mysqli_query($db_conn, $sql);

// echo $result;
var_dump($result);

$data_types = ['idx', 'id', 'pw', 'email', 'name', 'birth', 'number', 'score'];
echo "data types<br>";

$row1 = mysqli_fetch_array($result);
echo "row1<br>";

foreach ($data_types as $type) {
    echo "{$type}: {$row1[$type]}<br>";
}
echo "foreach<br>";

$sql = "INSERT INTO member VALUE (2, 'test', 'test1234', 'test@google.com', 'test', '2024-10-28', '010-1111-1111', 0)";
mysqli_query($db_conn, $sql);
echo "insert<br>";

mysqli_close($db_conn);
?>
