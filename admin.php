<?php
session_start();
$conn = new mysqli('localhost','root','','inqilab_db');

$error = '';
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn,$sql);
    if($row = mysqli_fetch_assoc($result)){
        // plain password check
        if($password === $row['password']){
            $_SESSION['admin_id'] = $row['id'];
            header("Location: admin_panel.php");
            exit;
        } else {
            $error = "Password ভুল।";
        }
    } else {
        $error = "Username নেই।";
    }
}
?>

<link rel="stylesheet" href="admin.css">

<form method="post">
    <h1 class="nav-logo">ইনকি<span style="color:aqua;">লাব</span></h1>
    <h2>Admin Login</h2>
    <?php if($error) echo "<p class='message'>$error</p>"; ?>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="login">Login</button>
</form>
