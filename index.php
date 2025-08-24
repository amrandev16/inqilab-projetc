<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />
    <link rel="stylesheet" href="respossive.css">
  <title>INQILAB</title>

</head>
<body>  

  <section class="home" id="home">
  <nav class="navbar">
   <div class="nav-container">
      <div class="navbar-logo">
      <h1 class="nav-logo">ইনকি<span class="logo-design">লাব</span></h1>
      </div>
      <div class="menu">
        <ul id="menulist">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#">Member</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="#contact">Contact</a></li>
        </ul>
   
      </div>
      <div class="menu_icon">
        <i class="fa-solid fa-bars" onclick="toggleMenu()"></i>
      </div>
   </div>
  </nav>

  <div class="home-content">
    <h1 class="home-hadding1">সমাজ গড়ি একসাথে -  <span style="color:rgba(59,207,147)">   ইনকিলাব , মানুষের তরে</span> </h1>
    <p class="home-hadding2">ইনকিলাবের মাধ্যমে আমরা শক্তি, স্থিতিশীলতা এবং আত্মনির্ভরতা গড়ে তুলি</p>
  </div>
</section>

<!-- /////////////////////// about section ///////////////////////// -->
<section class="about-section" id="about">
  <div class="about-container">
    <h2>About Us</h2>
    <p>
      <strong> আমাদের ইনকিলাব সংগঠন (Inqilab Organisation) </strong> একটি স্বেচ্ছাসেবী, অরাজনৈতিক ও অলাভজনক সংগঠন। 
      আমরা বিশ্বাস করি যে ক্ষুদ্র ক্ষুদ্র উদ্যোগের মাধ্যমেই বড় পরিবর্তন আনা সম্ভব।
    </p>
    <h3>আমাদের উদ্দেশ্য</h3>
    <ul>
      <li>সমাজের অসহায় ও সুবিধাবঞ্চিত মানুষদের পাশে দাঁড়ানো।</li>
      <li>শিক্ষা, স্বাস্থ্য ও সচেতনতা বৃদ্ধি কার্যক্রমে কাজ করা।</li>
      <li>রক্তদান, দানশীলতা ও জরুরি সময়ে সহযোগিতা করা।</li>
      <li>যুবসমাজকে সমাজসেবামূলক কাজে অনুপ্রাণিত করা।</li>
    </ul>
    <h3>আমাদের লক্ষ্য</h3>
    <p>
      একটি সুন্দর, ন্যায়ভিত্তিক ও মানবিক সমাজ তৈরি করা যেখানে প্রত্যেকে একে অপরের পাশে দাঁড়াবে।
    </p>
  </div>
</section>
<!-- ///////////////////////// -->

<section class="contact-section" id="contact">

  <header>
   
    <h2>Contact Us</h2>
    
    <p style="color:white">Have any questions? We’d love to hear from you.</p>
  </header>

  <div class="contact-form">
    <form action="contact_process.php" method="POST">
      <label>Your Name</label>
      <input type="text" name="name" required>

      <label>Your Email</label>
      <input type="email" name="email" required>

      <label>Subject</label>
      <input type="text" name="subject" required>

      <label>Message</label>
      <textarea name="message" rows="5" required></textarea>

      <button type="submit" name="submit">Send Message</button>
    </form>
  </div>

   <div class="contact-info">

    <h3>Our Address</h3>
    <p>Rajaspur, Parashuram, Feni</p>
    <p>📞 +880 1616510815</p>
    <p>📞 +880 1824231209</p>
    <p><i class="fa-brands fa-whatsapp"></i> +971545706487</p>
    <p>📧 Inqilab885@gmail.com</p>

    </div>


</section>

<footer>
  <div class="footer-bottom">
    <p>© 2025 Donation Platform | All Rights Reserved.</p>
  </div>
</footer>
<script>
  let menulist = document.getElementById("menulist")
  menulist.style.maxHeight ="0px";

  function toggleMenu() {
    if(menulist.style.maxHeight == "0px"){
      menulist.style.maxHeight = "300px";
    }
    else{
      menulist.style.maxHeight = "0px";
    }
  }
</script>
</body>
</html>
