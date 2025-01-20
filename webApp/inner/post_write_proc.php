<?php
    include_once("./error_report.php");
    include_once("./sql_connect.php");
?>

<?php
    if (!session_id()) {
        session_start();
    }

    // get parameters
    $writer = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Seoul');
    $created_date = new DateTime("now");
    $created_date = $created_date->format('Y-m-d H:i:s');
    $title = $_POST["title"];
    $post_id = hash('sha256', $title);
    $substance = $_POST["substance"];
    $post_view = 0;

    // insert sql
    $insert_sql = "INSERT INTO board VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param('sssssi', $post_id, $writer, $title, $substance, $created_date, $post_view);
    $stmt->execute();
    $cnt = $stmt->num_rows();
    echo $cnt;

    if ($cnt) {
        echo "<script>alert('등록되었습니다');</script>";
        // echo "<script>location.replace('../index.php');</script>";
    } else {
        echo "<script>
        alert('오류가 발생했습니다');
        // history.back();
        </script>";
        // echo "<script>location.replace('../post_write.php');</script>";
    }

    $stmt->close();
?>