<!DOCTYPE html>

<head>
    <title>SCORE BOARD</title>
    <meta content="charset=utf-8">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/score_board.css">
    <script></script>
</head>

<body>
    <div class = "headBox">
        <a class = "title" href="index.html">index</a>
    </div>

    <div class = "bodyBox">
        <form action="score_board.php" method="GET">
            <input name = "name" type="text" placeholder = "NAME">
            <button type="submit">SEARCH</button>
        </form>
        <div class="result">
            <?php
            define('DB_SERVER', 'localhost');
            define('DB_USERNAME', 'admin');
            define('DB_PASSWORD', 'student1234');
            define('DB_NAME', 'NotOK');

            $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $input_name = $_GET['name'];
            $select_sql = "select name, score from Data where name = '{$input_name}'";
            $result = mysqli_fetch_array(mysqli_query($conn, $select_sql));

            if(!empty($result)){
                echo "Score is " . $result['score'] . "!<br>";
            } else {
                echo "그런 이름 없어용~<br>";
            }
            ?>
        </div>
    </div>
</body>

</html>