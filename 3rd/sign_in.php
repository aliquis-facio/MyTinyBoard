<!DOCTYPE html>

<head>
    <title>SIGN IN</title>
    <meta content="charset=utf-8">
    <!-- <link rel="stylesheet" href="../main/style/main.css">
    <link rel="stylesheet" href="../main/style/sign_in.css"> -->
    <script src = "function.js"></script>
</head>

<body>
    <div class = "headBox">
        <a class = "title" href="home.php">안녕하진않아요</a>
    </div>

    <div class = "bodyBox">
        <div class = "login-box 1">
            <span>1</span>
            <form action="./login_proc.php" method="POST">
                <input name = "id1" type="text" placeholder = "아이디">
                <input name = "pw1" type="password" placeholder="비밀번호">
                <button type="submit">LOG IN</button>
            </form>
        </div>
    </div>

    <div class = "footBox">
        <nav>
            <a href="find_id.php">아이디 찾기</a> | 
            <a href="find_pw.php">비밀번호 찾기</a> | 
            <a href="sign_up.php">회원가입</a>
        </nav>
    </div>
</body>

</html>