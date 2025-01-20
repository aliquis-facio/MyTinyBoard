<!DOCTYPE html>

<head>
    <title>SIGN IN</title>
    <meta content="charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/sign_in.css">
    <script src="./script/user_handle.js"></script>
</head>

<body>
    <div class = "logo">
        <a class = "title" href="./index.php">뭐 어때</a>
    </div>

    <div class = "bodyBox cyan">
        <form id="sign_in_form" action="./inner/signin_proc.php" method="POST">
            <input class = "long" name = "id" type="text" placeholder = "아이디">
            <input class = "long" name = "pw" type="password" placeholder="비밀번호">
            <button class = "long blue" type="button" onclick="sign_in_submit()">LOG IN</button>
        </form>
    </div>

    <div class = "footBox">
        <nav>
            <a href="./find_id.php">아이디 찾기</a> | 
            <a href="./find_pw.php">비밀번호 찾기</a> | 
            <a href="./sign_up.php">회원가입</a>
        </nav>
    </div>
</body>

</html>