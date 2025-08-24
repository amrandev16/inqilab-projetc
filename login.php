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
     <h2>Login</h2>
     <form action="login.php" method="POST">
      <label for="">Phone Number:</label>
      <input type="number" name="email" placeholder=" Phone Number" required>
      <label for="">Password:</label>
      <input type="password" name="password" placeholder=" Enter Password" required>
      <button type="submit" name="login">Login</button>
      <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>

   </div>
   
</section>

</body>
</html>
