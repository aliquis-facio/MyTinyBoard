<!DOCTYPE HTML>
<html>

<head>
    <title>VIEW</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/board_view.css">
    <script src="./script/view.js"></script>
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
        
        $writer = $row['writer'];
        $view = $row['view'];

        if ($writer != $user_id) {
            $view += 1;
            $update_sql = "UPDATE board SET view = '{$view}' WHERE board_id = '{$board_id}'";
            $update_ret = mysqli_query($conn, $update_sql);
        }
    } else {
        echo "<script>alert('오류가 발생했습니다');</script>";
        echo mysqli_connect_error();
    }
?>

<body>
    <div class = "logo">
        <a class = "title" href="./index.php">뭐 어때</a>
    </div>

    <div class="container">
        <div class = "headBox">
            <?php
                echo "<h1>{$row['title']}</h1>";
                echo "<p class='post_header'>{$writer}님</p>";
                echo "<p class='post_header'>{$row[write_date]}</p>";
            ?>
        </div>
        
        <hr>
    
        <div class = "bodyBox">
            <div id='post_content' class = "contentBox">
                <?php echo $row['content'];?>
            </div>
            <?php
                if ($writer != $user_id) echo "<a id=\"writer_link\" class='left' href=\"./post_list.php?writer={$row['writer']}\">{$row['writer']}님의 게시글 더보기</a>";
                else {
                    echo "<span class='right'>";
                    echo "<a class = 'orange' href='./post_modify.php?board_id={$board_id}'>수정하기</a>";
                    echo "<a class = 'red' href = './inner/post_delete.php?board_id={$board_id}'\">삭제하기</button>";
                    echo "</span>";
                }
            ?>
        </div>
    
        <hr>
        
        <div class = "footBox">
            <div class = "coment_list">
                <!-- 댓글 목록 -->
                <ul>
                    <?php
                        $select_sql = "SELECT * FROM coment WHERE post_id = '{$board_id}' ORDER BY 'write_date' ASC";
                        $ret = mysqli_query($conn, $select_sql);

                        if ($ret) {
                            while($row = mysqli_fetch_array($ret)) {
                                $writer = $row['writer'];
                                $coment = $row['reply'];
                                $write_date = str_replace("-", ".", substr($row['write_date'], 0, 16));

                                echo "<li>";
                                echo "<p class='strong_font coment'>{$writer}님</p>";
                                echo "<p class='thin_font coment'>{$coment}</p>";
                                echo "<p class='grey small_font coment'>{$write_date}</p>";
                                echo "</li>";
                                echo "<hr>";
                            }
                        } else {
                            echo "<script>alert('오류가 발생했습니다');</script>";
                            echo mysqli_connect_error();
                        }
                    ?>
                </ul>
            </div>
            
            <div>
                <span>
                    <?php echo "{$user_id}님";?>
                </span>
                <span>
                    <form action="./inner/coment_write.php" method="post">
                        <input type="text" name="reply" placeholder="댓글을 남겨보세요">
                        <?php
                            echo "<input type='hidden' name='post_id' value={$row['board_id']}>";
                        ?>
                        <button class = "orange">등록</button>
                    </form>
                </span>
            </div>
        </div>
    </div>
</body>

</html>