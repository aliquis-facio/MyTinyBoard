<!DOCTYPE HTML>
<html>

<head>
    <title>VIEW</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/board_view.css">
    <script src="./script/board_handle.js"></script>
</head>

<?php
    include("./inner/user_session.php");
    include("./inner/sql_connect.php");

    $user_id = $_SESSION['user_id'];
    $post_id = $_GET['post_id'];
    
    $select_sql = "SELECT * FROM board WHERE post_id = ?";
    $stmt->prepare($select_sql);
    $stmt->bind_param('s', $post_id);
    $stmt->execute();
    $ret = $stmt->get_result();

    if ($ret) {
        $row = $ret->fetch_assoc();
        
        $writer = $row['writer'];
        $view = $row['post_view'];

        if ($writer != $user_id) {
            $view += 1;
            $update_sql = "UPDATE board SET view = ? WHERE post_id = ?";
            $stmt->reset();
            $stmt->prepare();
            $stmt->bind_param('is', $view, $post_id);
            $stmt->execute();
        }
    } else {
        echo "<script>alert('오류가 발생했습니다');</script>";
    }
?>

<body>
    <div class = "logo">
        <a class = "title" href="./index.php">뭐 어때</a>
    </div>

    <div class="container">
        <div class = "headBox">
            <?php
                $created_date = str_replace("-", ".", substr($row['created_date'], 0, 16));
                echo "<h1>{$row['title']}</h1>
                <p class='post_header'>{$writer}님</p>
                <p class='post_header'>{$created_date}</p>";
            ?>
        </div>
        
        <hr>
    
        <div class = "bodyBox">
            <div id='post_content' class = "contentBox">
                <?php
                    echo $row['substance'];
                ?>
            </div>
            <?php
                if ($writer != $user_id)
                    echo "<a id=\"writer_link\" class='left' href=\"./post_list.php?writer={$row['writer']}\">{$row['writer']}님의 게시글 더보기</a>";
                else {
                    echo "<span class='right'>
                    <a class='orange' href='./post_modify.php?post_id={$post_id}'>수정하기</a>
                    <a class='red' onclick='post_delete(\"$post_id\")'>삭제하기</a>
                    </span>";
                }
            ?>
        </div>
    
        <hr>
        
        <div class = "footBox">
            <div class = "coment_list">
                <!-- 댓글 목록 -->
                <ul>
                    <?php
                        $select_sql = "SELECT * FROM `coment` WHERE post_id=? ORDER BY created_date ASC";
                        $stmt->reset();
                        $stmt->prepare($select_sql);
                        $stmt->bind_param('s', $post_id);
                        $stmt->execute();
                        $ret = $stmt->get_result();

                        if ($ret) {
                            while($row = $ret->fetch_assoc()) {
                                $writer = $row['writer'];
                                $coment = $row['reply'];
                                $created_date = str_replace("-", ".", substr($row['created_date'], 0, 16));

                                echo "<li>
                                <p class='strong_font coment'>{$writer}님</p>
                                <p class='thin_font coment'>{$coment}</p>
                                <p class='grey small_font coment'>{$created_date}</p>
                                </li>
                                <hr>";
                            }
                        } else {
                            echo "<script>alert('오류가 발생했습니다');</script>";
                        }
                    ?>
                </ul>
            </div>
            
            <div>
                <span>
                    <form action="./inner/coment_write.php" method="post">
                        <input type="text" name="reply" placeholder="댓글을 남겨보세요">
                        <?php
                            echo "<input type='hidden' name='post_id' value={$row['post_id']}>";
                        ?>
                        <button class = "orange">등록</button>
                    </form>
                </span>
            </div>
        </div>
    </div>
</body>

</html>