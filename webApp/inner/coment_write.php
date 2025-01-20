<?php
    include_once("./error_report.php");
    include_once("./sql_connect.php");
    include_once("./user_session.php");
?>

<?php
if(!session_id()) {
    session_start();
}

$coment_writer = $_SESSION['user_id'];
date_default_timezone_set('Asia/Seoul');
$coment_created_date = new DateTime("now");
$coment = $_POST["reply"];
$post_id = $_POST["post_id"];
$coment_id = hash('sha256', $coment_writer.$coment_created_date -> format('Y-m-d H:i:s'));
if (empty($coment)) {
    echo "<script>alert('댓글 작성 완료 후 등록 버튼을 눌러주시기 바랍니다')</script>";
    echo "<script>location.replace('../post_view.php');</script>";
    exit;
} else {
    $insert_sql = "INSERT INTO coment (coment_id, post_id, write_date, writer, reply) VALUES ('{$coment_id}', '{$post_id}', '{$coment_created_date -> format('Y-m-d H:i:s')}', '{$coment_writer}', '{$reply}')";
    $result = mysqli_query($conn, $insert_sql);

    if ($result) {
        echo "<script>alert('등록되었습니다');</script>";
        echo "<script>location.replace('../post_view.php?board_id={$post_id}');</script>";
    } else {
        echo "<script>alert('오류가 발생했습니다');</script>";
        echo "<script>location.replace('../post_view.php?board_id={$post_id}');</script>";
    }
}

mysqli_close($conn);
?>