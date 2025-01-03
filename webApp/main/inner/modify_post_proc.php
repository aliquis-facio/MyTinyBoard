<?php
    include_once("./error_report.php");
    include_once("./sql_connect.php");
?>

<?php
    if (!session_id()) {
        session_start();
    }

    $user = $_SESSION['user_id'];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $board_id = $_POST["board_id"];
    date_default_timezone_set('Asia/Seoul');
    $modified_date = new DateTime("now");

    if (empty($title) or empty($content)) {
        echo "<script>alert('제목과 내용을 다 채우고 등록 버튼을 눌러주시기 바랍니다')</script>";
        echo "<script>location.replace('../outer/post_modify.php?board_id={$board_id}');</script>";
        exit;
    } else {
        $update_sql = "UPDATE board SET title = '{$title}', content = '{$content}', write_date = '{$modified_date -> format('Y-m-d')}' WHERE board_id = '{$board_id}'";
        $result = mysqli_query($conn, $update_sql);

        if ($result) {
            echo "<script>alert('수정되었습니다');</script>";
            echo "<script>location.replace('../outer/new_home.php');</script>";
        } else {
            echo "<script>alert('오류가 발생했습니다');</script>";
            echo "<script>location.replace('../outer/post_modify.php');</script>";
        }
    }

    mysqli_close($conn);
?>