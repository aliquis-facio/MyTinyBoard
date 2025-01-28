<?php
include_once("./error_report");
include_once("./sql_connect.php");

// get paremeters
$id = $_POST["id"];
$pw = hash('sha512', $_POST["pw"]);
$email = $_POST["email"];
$name = $_POST["name"];
$birth = $_POST["birth"];
$number = $_POST["number"];

// id overlap check
$select_sql = "SELECT * FROM member WHERE id = ?";
$stmt = $conn->prepare($select_sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$ret = $stmt->get_result();
$cnt = $ret->num_rows;
if ($cnt == 1) {
    echo "<script>
    alert('이미 존재하는 아이디입니다!');
    history.back();
    </script>";
    exit;
} else {
    // new register
    $stmt->reset();
    $insert_sql = "INSERT INTO member VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param('ssssss', $id, $pw, $name, $birth, $number, $email);
    $stmt->execute();
    
    echo "<script>
    alert('회원가입되셨습니다!');
    location.href = '../sign_in.php';
    </script>";
    exit;
}

$stmt->close();
?>