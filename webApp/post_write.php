<!DOCTYPE HTML>
<html>

<head>
    <title>WRITE</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/write.css">
    <script src="./script/board_handle.js"></script>
</head>

<?php
    include("./inner/user_session");
?>

<body>
    <div class = "logo">
        <a class = "title" href="./index">뭐 어때</a>
    </div>

    <div class="container">
        <h1>글쓰기</h1>
        <button class="small orange" form="post_write" type="submit" onclick="post_write_submit()">등록</button>
    </div>

    <hr>

    <div>
        <form id="post_write_form" action="./inner/post_write_proc.php" method="POST">
            <input class="post_title" name = "title" type="text" placeholder="제목을 입력해주세요">
            <textarea class="post_content" name="substance" placeholder="내용을 입력해주세요"></textarea>
        </form>
    </div>

    <div>
        <a href="./index.php">뒤로 가기</a>
    </div>
</body>

</html>