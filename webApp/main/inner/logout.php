<?php
    if (!session_id()) {
        session_start();
    }
    session_destroy();
?>

<script>
    alert("You've been logged out");
    location.replace('../outer/new_home.php');
</script>