<!DOCTYPE HTML>
<?php
setcookie("session", "This_is_session");

$word = $_GET['word'];

session_start();

$_SESSION['test'] = "test";

echo $word;

session_destroy();
?>

<html>

<head>
    <title>Cookie</title>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./style/main.css">
    <script type="text/javascript" src="./script/cookie.js"></script>
</head>

<body>
    <p>cookie가 알아서 만들어지나요?</p>

    <?php
    echo "--- \$_GET['word'] ---<br>";
    if (!isset($_GET['word'])) {
        echo $_GET['word'] . "<br>";
    } else {
        echo "chocolate cookie<br>";
    }
    
    echo "--- \$word ---<br>";
    if (!isset($word)) {
        echo $word . "<br>";
    } else {
        echo "banana cookie<br>";
    }
    
    echo "--- \$_SESSION[\"This_is_session\"] ---<br>";
    if (!isset($_SESSION["This_is_session"])) {
        echo $_SESSION["This_is_session"] . "<br>";
    } else {
        echo "strawberry cookie<br>";
    }
    
    echo "--- \$_SESSION[\"test\"] ---<br>";
    if (!isset($_SESSION["test"])) {
        echo $_SESSION["test"] . "<br>";
    } else {
        echo "coconut cookie<br>";
    }

    // echo "watermelon cookie<br>";
    // echo "milk cookie<br>";
    ?>

    <form action="./cookie.php" method = "GET">
        <input type="text" name = "input_text">
        <button>submit</button>
    </form>

    <?php
    echo $_GET["input_text"];
    ?>
</body>

</html>