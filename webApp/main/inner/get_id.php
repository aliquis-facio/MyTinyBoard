<?php
function get_id($conn, $name, $type, $var) {
    $select_sql = "SELECT name, {$type}, id FROM member WHERE name = '{$name}' and {$type} = '{$var}'";
    $result = mysqli_fetch_array(mysqli_query($conn, $select_sql));

    if (isset($result['id'])) {
        echo "<script>alert('당신의 아이디는 {$result['id']}입니다.')</script>";
        echo "<script>location.replace('../outer/new_home.php');</script>";
    } else {
        echo "<script>alert('이름 혹은 {$type}을 잘못 입력하셨습니다')</script>";
        echo "<script>location.replace('../outer/find_id.php');</script>";
        exit;
    }
}
?>