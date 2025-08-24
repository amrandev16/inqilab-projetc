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

<section  class="regiter-section" id="register">
    <div class="register-box">
    <h2>Register</h2>
    <form action="register.php" method="POST">
        Ful Name: <br>
      <input type="text" name="name" placeholder="Enter Full Name" required>
      Phone Number: <br>
      <input type="number" name="number" placeholder="Enter number" required>
      Password: <br>
      <input type="password" name="password" placeholder="Enter Password" required>
      Again Password: <br>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
</section>

</body>
</html>
