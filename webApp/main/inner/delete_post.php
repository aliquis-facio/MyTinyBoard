<?php
    include_once("./error_report.php");
    include_once("../inner/user_session.php");
    include_once("./sql_connect.php");
?>

<?php
    if (!session_id()) {
        session_start();
    }

    $board_id = $_GET['board_id'];
    
    $delete_sql = "DELETE FROM board WHERE board_id = '{$board_id}'";
    $ret = mysqli_query($conn, $delete_sql);

    if ($ret) {
        echo "<script>alert('삭제되었습니다');</script>";
        echo "<script>location.replace('../outer/new_home.php');</script>";
    } else {
        echo "<script>alert('오류가 발생했습니다');</script>";
        echo "<script>location.replace('../outer/view.php?board_id={$board_id}');</script>";
    }

    mysqli_close($conn);
?>