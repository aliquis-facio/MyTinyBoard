<?php
    include_once("./error_report.php");
    include_once("./sql_connect.php");
    include_once("./user_session.php");
?>

<?php
// Get parameter
$writer = $_SESSION['user_id'];
date_default_timezone_set('Asia/Seoul');
$created_date = new DateTime("now");
$created_date = $created_date -> format('Y-m-d H:i:s');
$reply = $_POST["reply"];
$post_id = $_POST["post_id"];
$coment_id = hash('sha256', $writer.$created_date);

echo "writer: " . $writer . "<br>";
echo "reply: " . $reply . "<br>";
echo "date: " . $created_date . "<br>";
echo "post id: " . $post_id . "<br>";
echo "coment id: " . $coment_id . "<br>";

// Insert reply data to DB using prepare statement
$update_sql = "UPDATE `coment` SET `reply`=?, `created_date`=? WHERE coment_id = ?";
$stmt = $conn->prepare($update_sql);
$stmt->bind_param('sssss', $reply, $created_date, $coment_id);
$stat = $stmt->execute();

if ($stat) {
    echo "<script>
    alert('수정되었습니다');
    location.replace('../post_view.php?post_id={$post_id}');
    </script>";
} else {
    echo "<script>
    alert('오류가 발생했습니다');
    history.back();
    </script>";
}

$stmt->close();
?>