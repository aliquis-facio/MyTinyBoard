<!DOCTYPE HTML>
<html>

<head>
    <title>UPDATE MY INFO</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <script src="./script/user_handle.js"></script>
</head>

<?php
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
                <p>개인정보 변경</p>
                <p>변경하지 않을 시 공란으로 두시면 됩니다</p>
                <?php
                    $select_sql = "SELECT * FROM `member` WHERE id=?";
                    $stmt = $conn->prepare($select_sql);
                    $stmt->bind_param('s', $user_id);
                    $stmt->execute();
                    $ret = $stmt->get_result();
                    $row = $ret->fetch_assoc();
                    
                    echo "
                    <form id='update_form' class='' action='./inner/update_my_information_proc.php' method='post'>
                        <div>
                            <p>이름: <input type='text' name='new_name' placeholder=\"{$row['name']}\"></p>
                        </div>
                        <div>
                            <p>전화번호: <input type='text' name='new_number' placeholder=\"{$row['number']}\"></p>
                            <p>생년월일: <input type='text' name='new_birth' placeholder=\"{$row['birth']}\"></p>
                        </div>
                        <div>
                            <p>이메일: <input type='text' name='new_email' placeholder=\"{$row['email']}\"></p>
                        </div>
                        <div>
                            <p>현재 비밀번호: <input id='pw_input' type='password' name='input_curr_pw'></p>
                            <p>새로운 비밀번호: <input id='new_pw_input' type='password' name='new_pw'></p>
                            <p>새로운 비밀번호 확인: <input id='new_pw_confirm_input' type='password' name='new_pw_confirm'></p>
                        </div>
                        <button class='red' type='button' onclick='update_my_inform_submit()'>변경</button>
                    </form>";
                    $stmt->close();
                ?>
            </div>
        </div>
    </div>
</body>