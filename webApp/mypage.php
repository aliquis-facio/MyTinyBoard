<!DOCTYPE HTML>
<html>

<head>
    <title>MY PAGE</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <script></script>
</head>

<?php
    include_once("./inner/error_report.php");
    include_once("./inner/user_session.php");
    include_once("./inner/sql_connect.php");
?>

<body>
    <div class="container">
        <div class = "head_box">
            <nav>
                <a class="title" href="./index.php">뭐 어때</a>
            </nav>
            
            <h1>내 정보</h1>
        </div>
                    
        <div class="body_box">
            <div>
                <p>기본 정보</p>
                <?php
                    $select_sql = "SELECT * FROM `member` WHERE id=?";
                    $stmt = $conn->prepare($select_sql);
                    $stmt->bind_param('s', $user_id);
                    $stmt->execute();
                    $ret = $stmt->get_result();
                    $row = $ret->fetch_assoc();

                    echo "<div>
                        <p>이름: {$row['name']}</p>
                        <p>ID: {$row['id']}</p>
                    </div>
                    <div>
                        <p>전화번호: {$row['number']}</p>
                        <p>생년월일: {$row['birth']}</p>
                    </div>
                    <div>
                        <p>이메일: {$row['email']}</p>
                    </div>";
                ?>
            </div>
        </div>

        <div class="foot_box">
            <p><a href="./update_my_information.php">개인정보 변경</a></p>
        </div>
    </div>
</body>