<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);?>
<?php
session_start();
$conn = new mysqli('sql101.infinityfree.com','if0_39791941','inqilab123','if0_39791941_inqilab_db');
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

if(isset($_POST['login'])){
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    if(!empty($phone) && !empty($password)){
        $sql = "SELECT * FROM donors WHERE phone='$phone'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            // এখানে আর password_verify ব্যবহার হবে না
            if($password === $row['password']){
                // Login successful
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                header("Location: donation_page.php");
                exit;
            } else {
                $error = "Password ভুল ❌";
            }

        } else {
            $error = "User পাওয়া যায় নাই ❌";
        }

    } else {
        $error = "সব ফিল্ড পূরণ করুন ❌";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Inqilab</title>
 <link rel="stylesheet" href="styles.css">
</head>
<body>

<button class="back_btn"><a href="index.php" class="back_btn">⬅ Back</a>
</button>

<section class="login-section" id="login">
    <div class="login-box">

     <form method="post">
    <h2>Login</h2>

    <?php if(isset($error)){ echo '<div class="message">'.$error.'</div>'; } ?>

    Phone: <input type="text" name="phone" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="login">Login</button><br>
    <p style="text-align:center;margin-top:10px;">
        Don't have an account? <a href="register.php">Register</a>
    </p>
</form>

   </div>
   
</section>

</body>
</html>
