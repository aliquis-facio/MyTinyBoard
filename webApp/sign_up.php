<!DOCTYPE html>

<head>
    <title>SIGN UP</title>
    <meta content="charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/sign_up.css">
    <script src="./script/user_handle.js"></script>
</head>

<body>
    <div class = 'container'>
        <div class = "logo">
            <a class = "title" href="./index.php">뭐 어때</a>
        </div>
    
        <div class = "bodyBox cyan">
            <form id="sign_up_form" action="./inner/signup_proc.php" method="POST">
                <input class = "long" name = "id" type="text" placeholder = "ID">
                <input class = "long" name = "pw" type="password" placeholder="PW">
                <input class = "long" name = "email" type="text" placeholder="example@example.com">
                <input class = "long" name = "name" type="text" placeholder="Name">
                <input class = "long" name = "birth" type="text" placeholder="Birth: 0000-00-00">
                <input class = "long" name = "number" type="text" placeholder="Number: 000-0000-0000">
                <button class = "long blue" type="button" onclick="sign_up_submit()">REGIST</button>
            </form>
        </div>
    </div>
</body>

</html>