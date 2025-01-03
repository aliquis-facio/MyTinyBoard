<!DOCTYPE HTML>
<html>

<head>
    <title>WRITE</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/write.css">
    <script></script>
</head>

<?php
    include("../inner/user_session.php");
?>

<body>
    <div class = "logo">
        <a class = "title" href="./new_home.php">안녕하진않아요</a>
    </div>

    <div class="container">
        <h1>글쓰기</h1>
        <button class = "small orange" form = "post_write" type = "submit">등록</button>
    </div>

    <hr>

    <div>
        <form id = "post_write" action="../inner/post_write_proc.php" method = "POST">
            <input class="post_title" name = "title" type="text" placeholder = "제목을 입력해주세요">
            <textarea class="post_content" name = "substance">내용을 입력해주세요</textarea>
        </form>
    </div>

    <div>
        <a href="./new_home.php">뒤로 가기</a>
    </div>
</body>

</html>