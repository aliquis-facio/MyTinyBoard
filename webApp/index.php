<!DOCTYPE HTML>
<html>

<head>
    <title>HOME</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/index.css">
    <script></script>
</head>

<?php
    include_once("./inner/user_session.php");
    include_once("./inner/sql_connect.php");
    include_once("./inner/error_report.php");
?>

<body>
    <div class="container">
        <div class = "head_box">
            <nav>
                <a class="title" href="./index.php">뭐 어때</a>
            </nav>
            <button class="red logout" type="button" onclick="location.href = './inner/logout.php'">LOG OUT</button>
        </div>
        
        <div class="side_box">
            <?php
                // Get user written post data
                $select_sql = "SELECT * FROM `board` WHERE writer='{$user_id}'";
                $stmt->prepare($select_sql);
                $stmt->execute();
                $ret = $stmt->get_result();
                $cnt_post = $ret->num_rows;
                $stmt->reset();
                
                // Get user written coment data
                $select_sql = "SELECT * FROM `coment` WHERE writer='{$user_id}'";
                $stmt->prepare($select_sql);
                $stmt->execute();
                $ret = $stmt->get_result();
                $cnt_coment = $ret->num_rows;

                echo "<p><b>{$user_id}님</b></p>
                <p><a href=\"./mypage.php\">내 정보</a></p>
                <p><a href=\"./post_list.php?writer={$user_id}\">내 게시글</a></p>
                <p>내가 쓴 게시글: {$cnt_post}개</p>
                <p>내가 쓴 댓글: {$cnt_coment}개</p>";
            ?>
            <a href="./post_write.php">글쓰기</a>
        </div>
    
        <div class="body_box">
            <div class = "title_panel">
                <div>
                    <form id="post_search" class="search_box" action="">
                        <input type="text" name="search" value="">
                        <button class="green" type="submit">검색</button>
                    </form>
                </div>
    
                <p class="board_title">자유게시판</p>
                <?php
                    $search_string = isset($_GET['search']) ? $_GET['search']:"";
                    
                    if ($search_string == "") {
                        // Get all post
                        $select_sql = "SELECT * FROM `board` ORDER BY created_date DESC";
                        $stmt->prepare($select_sql);
                        $stmt->execute();
                        $ret = $stmt->get_result();
                        $num_of_total_post = $ret->num_rows;
                        echo "<p class='the_num_of_post'>{$num_of_total_post}개의 글</p>";
                    } else {
                        // Get post
                        $search_string = "%{$search_string}%";
                        $select_sql = "SELECT * FROM `board` WHERE `title` LIKE ? ORDER BY created_date DESC";
                        $stmt->prepare($select_sql);
                        $stmt->bind_param('s', $search_string);
                        $stmt->execute();
                        $ret = $stmt->get_result();
                        $num_of_total_post = $ret->num_rows;
                        echo "<p class='the_num_of_post'>{$num_of_total_post}개의 글</p>";
                    }
                ?>
            </div>
        
            <hr>
        
            <div class = "body_panel">
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
                    <tbody>
                        <?php
                            $num = 1;
                            $page_size = 15;
                            $page_is_empty = false;
                            $page_total_post = 0;
                            $page_num = 0;
                            $page_has_prev = false;
                            $page_has_next = false;

                            if ($ret) {
                                while($row = $ret->fetch_assoc()) {
                                    $created_date = str_replace("-", ".", substr($row['created_date'], 0, 16));
        
                                    echo "<tr>
                                    <td>{$num}</td>
                                    <td><a href=\"./post_view.php?post_id={$row['post_id']}\">{$row['title']}</a></td>
                                    <td><a href=\"./post_list.php?writer={$row['writer']}\">{$row['writer']}</a></td>
                                    <td>{$created_date}</td>
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
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="links">
                                    <?php
                                        echo "<a href=\"#\">&laquo;</a>
                                        <a href=\"#\">&lt;</a>
                                        <a class=\"active\" href=\"#\">1</a>
                                        <a href=\"#\">2</a>
                                        <a href=\"#\">3</a>
                                        <a href=\"#\">4</a> 
                                        <a href=\"#\">5</a> 
                                        <a href=\"#\">&gt;</a>
                                        <a href=\"#\">&raquo;</a>";
                                    ?>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>

</html>