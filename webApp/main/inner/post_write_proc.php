<?php
    include_once("./error_report.php");
    include_once("./sql_connect.php");
?>

<?php
    if (!session_id()) {
        session_start();
    }

    $user = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Seoul');
    $created_date = new DateTime("now");
    $title = $_POST["title"];
    $board_id = hash('sha256', $title);
    $substance = $_POST["substance"];

    if (empty($title) or empty($substance)) {
        echo "<script>alert('제목과 내용을 다 채우고 등록 버튼을 눌러주시기 바랍니다')</script>";
        echo "<script>location.replace('../outer/write.php');</script>";
        exit;
    } else {
        $insert_sql = "INSERT INTO board VALUES ('$board_id', '{$user}', '{$title}', '{$substance}', '{$created_date -> format('Y-m-d H:i:s')}', 0)";
        $result = mysqli_query($conn, $insert_sql);

        if ($result) {
            echo "<script>alert('등록되었습니다');</script>";
            echo "<script>location.replace('../outer/new_home.php');</script>";
        } else {
            echo "<script>alert('오류가 발생했습니다');</script>";
            echo "<script>location.replace('../outer/write.php');</script>";
        }
    }

    mysqli_close($conn);
?>