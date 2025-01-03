<!DOCTYPE HTML>
<html>

<head>
    <title>HOME</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/list.css">
    <script></script>
</head>

<?php
    include_once("../inner/user_session.php");
?>

<body>
    <div class = "">
        <nav>
            <a class="title" href="./new_home.php">안녕하진않아요</a>
            <!-- <a href="./score_board.php">점수판</a> -->
        </nav>
        <span>
            <?php echo "{$user_id}님";?>
        </span>
        <?php echo "<a href=\"./sb_post_list.php?writer={$user_id}\">내 게시글</a>";?>
        <button type="button" class="red" onclick="location.href = '../inner/logout.php'">LOG OUT</button>
    </div>
    
    <div class = "headBox">
        <h1>자유게시판</h1>
        <?php
            include_once("../inner/sql_connect.php");

            $select_sql = "SELECT board_id FROM board";
            $result = mysqli_query($conn, $select_sql);
            $cnt = mysqli_num_rows($result);
            echo "<h4> {$cnt}개의 글</h4>"
        ?>
        <a href="./write.php">글쓰기</a>
    </div>

    <hr>

    <div class = "bodyBox">
        <table class="table">
            <thead>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>등록일</th>
                    <th>조회수</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="links">
                            <a href="#">&laquo;</a>
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a> 
                            <a href="#">&raquo;</a>
                        </div>
                    </td>
                </tr>
            </tfoot>
            <?php
                $num = 1;
                $select_sql = "SELECT * FROM `board` ORDER BY `board`.`write_date` DESC";
                $result = mysqli_query($conn, $select_sql);

                if ($result) {
                    echo "<tbody>";
                    while($row = mysqli_fetch_array($result)) {
                        $write_date = str_replace("-", ".", substr($row['write_date'], 0, 16));

                        echo "<tr>";
                        echo "<td>{$num}</td>";
                        echo "<td>";
                        echo "<a href=\"./view.php?board_id={$row['board_id']}\">{$row['title']}</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href=\"./sb_post_list.php?writer={$row['writer']}\">{$row['writer']}</a>";
                        echo "</td>";
                        echo "<td>{$write_date}</td>";
                        echo "<td>{$row['view']}</td>";
                        echo "</tr>";
                        $num += 1;
                    }
                    echo "</table>";
                } else {
                    echo "오류 발생했다.<br>";
                }

                mysqli_close($conn);
            ?>
        </div>
    </div>
</body>

</html>