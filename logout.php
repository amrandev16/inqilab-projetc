<?php
session_start();
session_destroy(); // সব session শেষ করবে
header("Location:index.php"); // login page এ redirect
exit;
?>

