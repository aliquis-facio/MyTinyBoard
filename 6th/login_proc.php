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

function login2($conn, $user_id, $user_pw) {
    // identify and certify seperation
    $sql = "SELECT id, pw FROM member WHERE id = '{$user_id}'";
    echo "SQL: {$sql}<br>";
    $ret = mysqli_query($conn, $sql);

    if(isset($ret)) {
        $row = mysqli_fetch_assoc($ret);

        if ($user_pw == $row['pw']) {
            echo "<script>alert('login2 success')</script>";
        } else {
            echo "<script>alert('fail')</script>";
        }
    } else {
        echo "<script>alert('fail')</script>";
    }
}

function login3($conn, $user_id, $user_pw) {
    // identify and certify as the same time with hash
    $hash_user_pw = hash('sha512', $user_pw);
    $sql = "SELECT id, pw, hash_pw FROM member WHERE id = '{$user_id}' AND hash_pw = '{$hash_user_pw}'";
    echo "SQL: {$sql}<br>";
    $ret = mysqli_query($conn, $sql);

    if (isset($ret)) {
        $result = mysqli_fetch_assoc($ret);

        if($result) {
            echo "<script>alert('login3 success')</script>";
        } else {
            echo "<script>alert('fail')</script>";
        }
    }
}

function login4($conn, $user_id, $user_pw) {
    // identify and certify seperation with hash
    $hash_user_pw = hash('sha512', $user_pw);
    $sql = "SELECT id, pw, hash_pw FROM Data WHERE id = '{$user_id}'";
    echo "SQL: {$sql}<br>";
    $ret = mysqli_query($conn, $sql);

    if (isset($ret)) {
        $result = mysqli_fetch_assoc($ret);
        
        $hash_db_pw = $result['hash_pw'];
        if ($hash_db_pw == $hash_user_pw) {
            echo "<script>alert('login4 success')</script>";
        } else {
            echo "<script>alert('fail')</script>";
        }
    }
}

function login5($conn, $user_id, $user_pw) {
    // identify and certify as the same time with escape text
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $user_pw = mysqli_real_escape_string($conn, $user_pw);

    $sql = "SELECT id, pw from Data where id = '{$user_id}' and pw = '{$user_pw}'";
    echo "SQL: {$sql}<br>";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    if($result) {
        echo "<script>alert('login5 success')</script>";
    } else {
        echo "<script>alert('fail')</script>";
    }
}

function login6($conn, $user_id, $user_pw) {
    // identify and certify seperation with escape tex
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $user_pw = mysqli_real_escape_string($conn, $user_pw);

    $sql = "SELECT id, pw FROM Data WHERE id = '{$user_id}'";
    echo "SQL: {$sql}<br>";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    $db_pw = $result['pw'];
    if ($db_pw == $user_pw) {
        echo "<script>alert('login6 success')</script>";
    } else {
        echo "<script>alert('fail')</script>";
    }
}

function login7($conn, $user_id, $user_pw) {
    // identify and certify as the same time with hash, escape text
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $user_ipw = mysqli_real_escape_string($conn, $user_pw);

    $hash_user_pw = hash('sha512', $user_pw);
    $sql = "SELECT id, pw, hash_pw FROM Data WHERE id = '{$user_id}' AND hash_pw = '{$hash_user_pw}'";
    echo "SQL: {$sql}<br>";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    if($result) {
        echo "<script>alert('login7 success')</script>";
    } else {
        echo "<script>alert('fail')</script>";
    }
}

function login8($conn, $user_id, $user_pw) {
    // identify and certify seperation with hash, escape text
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $user_pw = mysqli_real_escape_string($conn, $user_pw);

    $hash_user_pw = hash('sha512', $user_pw);
    $sql = "SELECT id, pw, hash_pw FROM Data WHERE id = '{$user_id}'";
    echo "SQL: {$sql}<br>";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    $hash_db_pw = $result['hash_pw'];
    if ($hash_db_pw == $hash_user_pw) {
        echo "<script>alert('login8 success')</script>";
    } else {
        echo "<script>alert('fail')</script>";
    }
}

function login9($conn, $user_id, $user_pw) {
    // identify and certify seperation with hash, escape text, prepared statement
    $db_server = 'localhost';
    $db_username = 'admin';
    $db_password = 'student1234';
    $db_name = 'NotOK';

    $user_id = mysqli_real_escape_string($conn, $user_id);
    $user_pw = mysqli_real_escape_string($conn, $user_pw);
    $hash_user_pw = hash("sha512", $user_pw);
    echo "id: {$user_id}, pw: {$user_pw}<br>";
    echo "hash: {$hash_user_pw}<br>";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $dsn = "mysql: host = {$db_server}; dbname = {$db_name}";
    $pdo = new PDO($dsn, $db_username, $db_password);
    // $pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $pdo -> prepare("SELECT * FROM Data WHERE id = :user_id");
    $stmt -> bindParam(":user_id", $user_id, PDO::PARAM_STR);
    $stmt -> execute();
    echo "statement execute<br>";

    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $hash_db_pw = $result['hash_pw'];
        echo "{$hash_db_pw}<br>";
    
        if ($hash_db_pw == $hash_user_pw) {
            echo "<script>alert('login9 success')</script>";
        } else {
            echo "<script>alert('fail')</script>";
        }
    } else {
        echo "<script>alert('no result')</script>";
    }
}

function login10($conn, $user_id, $user_pw) {
    // identify and certify as the same time
    $sql = "SELECT id, pw FROM member WHERE id = '" . $user_id . "' AND pw = '" . $user_pw . "'";
    echo "SQL: {$sql}<br>";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    if($result) {
        echo "<script>alert('login10 success')</script>";
    } else {
        echo "<script>alert('fail')</script>";
    }
}

function login11($conn, $user_id, $user_pw) {
    // identify and certify as the same time
    $sql = "SELECT id, pw FROM member WHERE id = '
    {$user_id}' AND pw = '
    {$user_pw}'";
    echo "SQL: {$sql}<br>";
    $ret = mysqli_query($conn, $sql);

    if($ret) {
        while($row = mysqli_fetch_assoc($ret)) {
            foreach ($row as $key => $value) {
                echo "<li>{$key}: {$value}</li>";
            }
            echo "<br>";
        }
        echo "<script>alert('login11 success')</script>";
    } else {
        echo "<script>alert('fail')</script>";
    }
}

function login12($conn, $user_id, $user_pw) {
    // identify and certify as the same time
    $sql = "SELECT id, pw FROM member WHERE id = ('{$user_id}') AND pw = ('{$user_pw}')";
    echo "SQL: {$sql}<br>";
    $ret = mysqli_query($conn, $sql);

    if($ret) {
        while($row = mysqli_fetch_assoc($ret)) {
            foreach ($row as $key => $value) {
                echo "<li>{$key}: {$value}</li>";
            }
            echo "<br>";
        }
        echo "<script>alert('login12 success')</script>";
    } else {
        echo "<script>alert('fail')</script>";
    }
}

function login13($conn, $user_id, $user_pw) {
    // identify and certify as the same time
    $sql = "SELECT id, pw FROM member WHERE id = (\"{$user_id}\") AND pw = (\"{$user_pw}\")";
    echo "SQL: {$sql}<br>";
    $ret = mysqli_query($conn, $sql);

    if($ret) {
        while($row = mysqli_fetch_assoc($ret)) {
            foreach ($row as $key => $value) {
                echo "<li>{$key}: {$value}</li>";
            }
            echo "<br>";
        }
        echo "<script>alert('login13 success')</script>";
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
    case 2:
        login2($conn, $input_id, $input_pw);
        break;
    case 3:
        login3($conn, $input_id, $input_pw);
        break;
    case 4:
        login4($conn, $input_id, $input_pw);
        break;
    case 5:
        login5($conn, $input_id, $input_pw);
        break;
    case 6:
        login6($conn, $input_id, $input_pw);
        break;
    case 7:
        login7($conn, $input_id, $input_pw);
        break;
    case 8:
        login8($conn, $input_id, $input_pw);
        break;
    case 9:
        login9($conn, $input_id, $input_pw);
        break;
    case 10:
        login10($conn, $input_id, $input_pw);
        break;
    case 11:
        login11($conn, $input_id, $input_pw);
        break;
    case 12:
        login12($conn, $input_id, $input_pw);
        break;
    case 13:
        login13($conn, $input_id, $input_pw);
        break;
}

mysqli_close($conn);
?>