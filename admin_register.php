<?php
session_start();
$conn = new mysqli('localhost','root','','inqilab_db');

$message = '';

// Admin Registration
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password']; // normal password

    // Check if username already exists
    $check = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    if(mysqli_num_rows($check) > 0){
        $message = "Username already exists!";
        header("location:admin.php");
    } else {
        mysqli_query($conn, "INSERT INTO admin (username, password) VALUES ('$username','$password')");
        $message = "✅ Admin registered successfully! You can login now.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Registration</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f5f6fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
form {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    width: 300px;
}
h2 {
    text-align: center;
    color: #2f3640;
}
input[type=text], input[type=password] {
    width: 100%;
    padding: 10px;
    margin: 8px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}
button {
    width: 100%;
    padding: 10px;
    background-color: #00b894;
    border: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    cursor: pointer;
}
button:hover {
    background-color: #00cec9;
}
.message {
    text-align: center;
    padding: 10px;
    margin: 10px 0;
    background-color: #ffeaa7;
    border-radius: 5px;
    font-weight: bold;
}
</style>
</head>
<body>

<form method="post">
    <h2>Admin Registration</h2>
    <?php if($message) echo "<div class='message'>$message</div>"; ?>
    Username:<br>
    <input type="text" name="username" required><br>
    Password:<br>
    <input type="password" name="password" required><br>
    <button type="submit" name="register">Register</button>
</form>

</body>
</html>
