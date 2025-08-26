<?php
// INFINITYFREE HOSTING SETUP
$host = "sql101.infinityfree.com";   // InfinityFree এর MySQL Host
$user = "if0_39791941";              // আপনার Database Username
$pass = "inqilab123";          // আপনার Database Password
$db   = "if0_39791941_inqilab_db";   // আপনার Database Name

// Database connect
$conn = new mysqli($host, $user, $pass, $db);

// Connection check
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
