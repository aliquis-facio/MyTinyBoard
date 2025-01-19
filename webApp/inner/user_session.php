<?php
    if(!session_id()) {
        session_start();
    }

    if(!isset($_SESSION['user_name'])) {
        echo "<script>location.replace('../sign_in.php');</script>";
    } else {
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
    }
?>