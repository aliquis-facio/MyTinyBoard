<!DOCTYPE HTML>
<html>

<head>
    <title>POST LIST</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/list.css">
    <script></script>
</head>

<?php
    include_once("../inner/error_report.php");
    include_once("../inner/user_session.php");
    include_once("../inner/sql_connect.php");

    $user_id = $_SESSION['user_id'];
    $writer = $_GET['writer'];
    $select_sql = "SELECT * FROM board WHERE writer = '{$writer}'";
    $ret = mysqli_query($conn, $select_sql);
    $cnt = mysqli_num_rows($ret);
?>

<body>
    <div class = "logo">
        <a class = "title" href="./new_home.php">안녕하진않아요</a>
    </div>

    <div class = "headBox">
        <?php
            echo "<h1>{$writer}님의글보기</h1>";
            echo "<h4> {$cnt}개의 글</h4>";
            if ($user_id != $writer) echo "<a href=\"./sb_post_list.php?writer={$user_id}\">내 게시글</a>";
        ?>
        <a href="./write.php">글쓰기</a>
        <a class = "orange" href="./new_home.php">뒤로 가기</a>
    </div>

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

                if ($ret) {
                    echo "<tbody>";
                    while($row = mysqli_fetch_array($ret)) {
                        echo "<tr>";
                        echo "<td>{$num}</td>";
                        echo "<td>";
                        echo "<a href=\"./view.php?board_id={$row['board_id']}\">{$row['title']}</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href=\"./sb_post_list.php?writer={$row['writer']}\">{$row['writer']}</a>";
                        echo "</td>";
                        echo "<td>{$row['write_date']}</td>";
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