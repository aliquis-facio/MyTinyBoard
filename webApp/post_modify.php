<!DOCTYPE HTML>
<html>

<head>
    <title>MODIFY</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/write.css">
    <script></script>
</head>

<?php
    include("./inner/user_session.php");
    include("./inner/sql_connect.php");

    $user_id = $_SESSION['user_id'];
    $board_id = $_GET['board_id'];
    
    $select_sql = "SELECT * FROM board WHERE board_id = '{$board_id}'";
    $ret = mysqli_query($conn, $select_sql);

    if ($ret) {
        $row = mysqli_fetch_assoc($ret);
        
        $title = $row['title'];
        $content = $row['content'];
    } else {
        echo "<script>alert('오류가 발생했습니다');</script>";
        echo mysqli_connect_error();
    }
?>

<body>
    <div class = "logo">
        <a class = "title" href="./index.php">뭐 어때</a>
    </div>

    <div>
        <h1>수정하기</h1>
        <button form = "post_modify" class = "orange">등록</button>
        <hr>
    </div>

    <div>
        <form action="./inner/post_modify_proc.php" method="post" id = "post_modify">
            <?php
                echo "<input id = 'board_write' class='post_title' type='text' name = 'title' value = '{$title}'>";
                echo "<textarea class='post_content' name='content'>{$content}</textarea>";
                echo "<input type='hidden' name='board_id' value='{$board_id}'>";
            ?>
        </form>
    </div>

    <div>
        <a href="./index.php">뒤로 가기</a>
    </div>
</body>

</html>