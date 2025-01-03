<!DOCTYPE html>

<head>
    <title>SIGN UP</title>
    <meta content="charset=utf-8">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/sign_up.css">
    <script></script>
</head>

<body>
    <div class = 'container'>
        <div class = "logo">
            <a class = "title" href="./new_home.php">안녕하진않아요</a>
        </div>
    
        <div class = "bodyBox cyan">
            <form action="../inner/regist_proc.php" method="POST">
                <input class = "long" name = "id" type="text" placeholder = "아이디">
                <input class = "long" name = "pw" type="password" placeholder="비밀번호">
                <input class = "long" name = "email" type="text" placeholder="이메일: example@example.com">
                <input class = "long" name = "name" type="text" placeholder="이름">
                <input class = "long" name = "birth" type="text" placeholder="생일: 0000-00-00">
                <input class = "long" name = "number" type="text" placeholder="번호: 000-0000-0000">
                <input class = "long" name = "score" type="text" placeholder="점수: 000">
                <button class = "long blue" type="submit">REGIST</button>
            </form>
        </div>
    </div>
</body>

</html>