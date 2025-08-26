<?php
session_start();
$conn = new mysqli('sql101.infinityfree.com','if0_39791941','inqilab123','if0_39791941_inqilab_db');

if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$sql = "SELECT * FROM donors WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Ensure balance exists
$balance = isset($user['balance']) ? $user['balance'] : 0;

// Donation stats
$month_sql = "SELECT 
                COUNT(DISTINCT month) as total_months,
                SUM(amount) as total_amount,
                MAX(id) as last_donation_id
              FROM donations 
              WHERE user_id='$user_id'";
$month_result = mysqli_query($conn, $month_sql);
$donation_stats = mysqli_fetch_assoc($month_result);

// Last donation details
$last_donation = null;
if($donation_stats['last_donation_id']){
    $last_id = $donation_stats['last_donation_id'];
    $last_res = mysqli_query($conn,"SELECT month, amount, method FROM donations WHERE id='$last_id'");
    $last_donation = mysqli_fetch_assoc($last_res);
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Donation Summary</title>
<style>
body {font-family: Arial; background:#f4f4f4;}
.summary {max-width:700px;margin:30px auto;background:#fff;padding:20px 30px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.1);}
.profile {text-align:center;margin-bottom:20px;}
.profile img {width:100px;height:100px;border-radius:50%;object-fit:cover;margin-bottom:10px;border:2px solid #4CAF50;}
.stats {margin:15px 0;padding:15px;background:#f0f8ff;border-radius:5px;}
.stats p b{color:#2d3436;}
.logout {text-align:center;margin-top:20px;}
.logout a {color:red;font-weight:bold;text-decoration:none;}
.logout a:hover {text-decoration:underline;}
.logout{
    border: 1px solid aqua;
    padding: 5px;
    background-color: aquamarine;
}
</style>
</head>
<body>
<section class="summary">
    <h1 class="nav-logo">ইনকি<span style="color:aqua;">লাব</span></h1>
<h2>Welcome, <?php echo $user['name']; ?> 🎉</h2>

<div class="profile">
    <img src="uploads/<?php echo $user['photo']; ?>" alt="User Photo">
    <p><b>Name:</b> <?php echo $user['name']; ?></p>
    <p><b>Email:</b> <?php echo $user['email']; ?></p>
    <p><b>Phone:</b> <?php echo $user['phone']; ?></p>
    <p><b>Balance:</b> <?php echo number_format($balance,2); ?> Tk</p>
</div>

<hr>
<h3>📊 Donation Summary</h3>
<div class="stats">
<p>✅ মোট কত মাস দিয়েছেন: <b><?php echo $donation_stats['total_months'] ?? 0; ?> মাস</b></p>
<p>💰 মোট কত টাকা দিয়েছেন: <b><?php echo $donation_stats['total_amount'] ?? 0; ?> Tk</b></p>

<?php if($last_donation): ?>
<p>🕒 সর্বশেষ মাস: <b><?php echo $last_donation['month']; ?></b></p>
<p>💵 সর্বশেষ টাকা: <b><?php echo $last_donation['amount']; ?> Tk</b></p>
<p>💳 Method: <b><?php echo $last_donation['method']; ?></b></p>
<?php endif; ?>
</div>

<div class="logout"><a href="logout.php">Log Out</a></div>

</section>
</body>
</html>
