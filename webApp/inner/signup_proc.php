<?php
include("./sql_connect.php");

$id = $_POST["id"];
$pw = hash('sha512', $_POST["pw"]);
$email = $_POST["email"];
$name = $_POST["name"];
$birth = $_POST["birth"];
$number = $_POST["number"];

$select_sql = "SELECT id FROM member WHERE id = '{$id}'";
$ret = mysqli_query($conn, $select_sql);
print_r($ret);
if ($ret) {
    echo "<script>alert('중복되는 ID입니다!')</script>";
    echo "<script>location.replace('../sign_up.php');</script>";
    exit;
}

$insert_sql = "INSERT INTO member (id, pw, email, name, birth, number) VALUES ('{$id}', '{$pw}', '{$email}','{$name}','{$birth}','{$number}')";
$ret = mysqli_query($conn, $insert_sql);
echo "<script>alert('회원가입되셨습니다!')</script>";
echo "<script>location.replace('../sign_in.php');</script>";
exit;

mysqli_close($conn);
?>