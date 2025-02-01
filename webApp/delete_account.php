<!DOCTYPE HTML>
<html>

<head>
    <title>DELETE ACCOUNT</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <script src="./script/user_handle.js"></script>
</head>

<?php
    include_once("./inner/user_session.php");
    include_once("./inner/sql_connect.php");
?>

<body>
    <div class="container">
        <div class = "head_box">
            <nav>
                <a class="title" href="./index.php">뭐 어때</a>
            </nav>
            
            <h1>내 정보</h1>
        </div>
                    
        <div class="body_box">
            <div>
                <p>회원 탈퇴</p>
            </div>
            <form id="delete_account_form" action="./inner/delete_account_proc.php" method="post">
                <input type="password" name="pw" placeholder="비밀번호를 입력해주세요">
                <button class="red" type="button" onclick="delete_account()">탈퇴</button>
            </form>
        </div>
    </div>
</body>