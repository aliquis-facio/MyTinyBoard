<!DOCTYPE HTML>
<html>

<head>
    <title>HOME</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/list.css">
    <script></script>
</head>

<?php
    include_once("./inner/user_session.php");
    include_once("./inner/sql_connect.php");
?>

<body>
    <div class = "">
        <nav>
            <a class="title" href="./index.php">뭐 어때</a>
        </nav>
        <?php
            echo "<span>{$user_id}님</span>
            <a href=\"./post_list.php?writer={$user_id}\">내 게시글</a>";
        ?>
        <button type="button" class="red" onclick="location.href = './inner/logout.php'">LOG OUT</button>
    </div>
    
    <div class = "headBox">
        <h1>자유게시판</h1>
        <?php
            $select_sql = "SELECT * FROM board";
            $stmt = $conn->prepare($select_sql);
            $stmt->execute();
            $cnt = $stmt -> num_rows();
            echo "<h4> {$cnt}개의 글</h4>"
        ?>
        <a href="./post_write.php">글쓰기</a>
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
            <tbody>
                <?php
                    $num = 1;
                    $stmt->reset();
                    $select_sql = "SELECT * FROM `board` ORDER BY `board`.`write_date` DESC";
                    $stmt = $conn->prepare($select_sql);
                    $stmt->execute();
                    $ret = $stmt->get_result();

                    if ($ret) {
                        while($row = $ret->fetch_assoc()) {
                            $write_date = str_replace("-", ".", substr($row['write_date'], 0, 16));

                            echo "<tr>
                            <td>{$num}</td>
                            <td><a href=\"./post_view.php?board_id={$row['board_id']}\">{$row['title']}</a></td>
                            <td><a href=\"./post_list.php?writer={$row['writer']}\">{$row['writer']}</a></td>
                            <td>{$write_date}</td>
                            <td>{$row['view']}</td>
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
    </div>
</body>

</html>