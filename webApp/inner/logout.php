<?php
    if (!session_id()) {
        session_start();
    }
    session_destroy();
?>

<script>
    alert("로그아웃되셨습니다");
    location.replace('../index.php');
</script>