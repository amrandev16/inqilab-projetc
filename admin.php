<?php
session_start();
$conn = new mysqli('sql101.infinityfree.com','if0_39791941','inqilab123','if0_39791941_inqilab_db');
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.admin_login{
    height: 100vh;
    display: flex;
    align-items: center;
    background-color: aqua;

}
    </style>
</head>
<body>
<section class="admin_login">
     <form method="post">
        <h1 class="nav-logo">ইনকি<span style="color:aqua;">লাব</span></h1>
        <h2>Admin Login</h2>
        <?php if($error) echo "<p class='message'>$error</p>"; ?>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit" name="login">Login</button>
</form>
</section>

</body>
</html>