<?php
    include_once("./sql_connect.php");

    $select_sql = "SELECT board_id FROM board";
    $result = mysqli_query($conn, $select_sql);
    $cnt = mysqli_num_rows($result);
?>