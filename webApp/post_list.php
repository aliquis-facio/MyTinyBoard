<!DOCTYPE HTML>
<html>

<head>
    <title>POST LIST</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/list.css">
    <script></script>
</head>

<?php
    include_once("./inner/error_report.php");
    include_once("./inner/user_session.php");
    include_once("./inner/sql_connect.php");

    $user_id = $_SESSION['user_id'];
    $writer = $_GET['writer'];

    $select_sql = "SELECT * FROM board WHERE writer = ?";
    $stmt = $conn->prepare($select_sql);
    $stmt->bind_param('s', $writer);
    $stmt->execute();
    $ret = $stmt->get_result();
    $cnt = $ret->num_rows;
?>

<body>
    <div class = "logo">
        <a class = "title" href="./index.php">뭐 어때</a>
    </div>

    <div class = "headBox">
        <?php
            echo "<h1>{$writer}님의글보기</h1>
            <h4> {$cnt}개의 글</h4>";
            if ($user_id != $writer) echo "<a href=\"./post_list.php?writer={$user_id}\">내 게시글</a>";
        ?>
        <a href="./post_write.php">글쓰기</a>
        <a class = "orange" href="./index.php">뒤로 가기</a>
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
        <tbody>
            <?php
                $num = 1;

                if ($ret) {
                    while($row = mysqli_fetch_array($ret)) {
                        echo "<tr>
                        <td>{$num}</td>
                        <td><a href=\"./post_view.php?post_id={$row['post_id']}\">{$row['title']}</a></td>
                        <td><a href=\"./post_list.php?writer={$row['writer']}\">{$row['writer']}</a></td>
                        <td>{$row['created_date']}</td>
                        <td>{$row['post_view']}</td>
                        </tr>";
                        $num += 1;
                    }
                } else {
                    echo "오류 발생했다.<br>";
                }
                
                $stmt->close();
            ?>
        </tbody>
    </table>
</body>

</html>