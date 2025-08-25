<?php
session_start();
$conn = new mysqli('localhost','root','','inqilab_db');

if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

// Upload folder
$uploadFolder = "uploads/";
if(!is_dir($uploadFolder)){
    mkdir($uploadFolder, 0777, true);
}

if(isset($_POST['register'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password_raw = $_POST['password'];
    $password_again_raw = $_POST['password_again'];

    if(!empty($name) && !empty($email) && !empty($phone) && !empty($password_raw) && !empty($password_again_raw)){

        if($password_raw === $password_again_raw){

            $check_sql = "SELECT * FROM donors WHERE phone='$phone'";
            $result = mysqli_query($conn, $check_sql);

            if(mysqli_num_rows($result) > 0){
                $error = "এই নাম্বার দিয়ে আগেই রেজিস্ট্রেশন আছে ❌";
            } else {

                if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ""){
                    $photoTmp = $_FILES['photo']['tmp_name'];
                    $photoName = time().'_'.preg_replace('/\s+/', '_', basename($_FILES['photo']['name']));
                    $uploadDir = $uploadFolder.$photoName;

                    if(move_uploaded_file($photoTmp, $uploadDir)){

                        // normal password save
                        $password = $password_raw;  

                        $insert_sql = "INSERT INTO donors (name,email,phone,password,photo)
                                       VALUES ('$name','$email','$phone','$password','$photoName')";

                        if(mysqli_query($conn, $insert_sql)){
                         
                          header("Location: login.php");
                            $success = "Registration Successful ✅ <a href='login.php'>Login Here</a>";
                        } else {
                            $error = "Database Error: ".mysqli_error($conn);
                        }

                    } else {
                        $error = "Photo upload ব্যর্থ ❌";
                    }

                } else {
                    $error = "Photo select করুন ❌";
                }

            }

        } else {
            $error = "Password এবং Confirm Password মিলছে না ❌";
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
  <title>Register - Inqilab</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    
  </style>
</head>
<body>
<button class="back_btn"><a href="index.php" class="back_btn">⬅ Back</a>
</button>
<section  class="regiter-section" id="register">
    <div class="register-box">
   <h2>Register Donor</h2>
<form method="post" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Phone: <input type="text" name="phone" required><br>
    Password: <input type="password" name="password" required><br>
    Confirm Password: <input type="password" name="password_again" required><br>
    Photo: <input type="file" name="photo" required><br>
    <button type="submit" name="register">Register</button>
</form>

    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
</section>

</body>
</html>
