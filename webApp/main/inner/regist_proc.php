<?php
include("./sql_connect.php");

$check = true;
foreach($_POST as $key => $value) {
    if(empty($value)) {
        $check = false;
        break;
    }
}

if($check) {
    $id = $_POST["id"];
    $pw = $_POST["pw"];
    $hash_pw = hash('sha512', $pw);
    $email = $_POST["email"];
    $name = $_POST["name"];
    $birth = $_POST["birth"];
    $number = $_POST["number"];
    $score = $_POST["score"];
    
    $select_sql = "SELECT id FROM member WHERE id = '{$id}'";
    $result = mysqli_query($conn, $select_sql);
    if ($result) {
        echo "<script>alert('중복되는 ID입니다!')</script>";
        echo "<script>location.replace('../outer/sign_up.php');</script>";
        exit;
    }
    
    $insert_sql = "INSERT INTO member (id, pw, hash_pw, email, name, birth, number, score) VALUES ('{$id}', '{$pw}','{$hash_pw}','{$email}','{$name}','{$birth}','{$number}',{$score})";
    $result = mysqli_query($conn, $insert_sql);
    echo "<script>alert('회원가입되셨습니다!')</script>";
    echo "<script>location.replace('../outer/sign_in.php');</script>";
    exit;
} else {
    echo "<script>alert('빈칸 없이 채워주시기 바랍니다')</script>";
    echo "<script>location.replace('../outer/sign_up.php');</script>";
    exit;
}

mysqli_close($conn);
?>