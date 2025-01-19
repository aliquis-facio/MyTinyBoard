<?php
$pw1 = "gildong123";
$hash_pw1 = hash('sha512', $pw1);
echo strlen($hash_pw1) . "<br>";
echo $hash_pw1;
?>