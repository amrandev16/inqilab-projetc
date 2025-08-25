<?php
session_start();
session_unset();  // সব session variable clear করে
session_destroy(); // session destroy করে
 // login page এ redirect
header("Location: index.php");
?>
