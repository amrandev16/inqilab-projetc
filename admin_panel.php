<?php
session_start();
$conn = new mysqli('sql101.infinityfree.com','if0_39791941','inqilab123','if0_39791941_inqilab_db');

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit;
}

// Handle updates
if(isset($_POST['update'])){
    $donation_id = $_POST['donation_id'];
    $user_id     = $_POST['user_id'];
    $new_balance = $_POST['balance'];
    $new_amount  = $_POST['amount'];
    $new_month   = $_POST['month'];

    mysqli_query($conn,"UPDATE donors SET balance='$new_balance' WHERE id='$user_id'");
    mysqli_query($conn,"UPDATE donations SET amount='$new_amount', month='$new_month' WHERE id='$donation_id'");

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Fetch all users
$users_sql = "SELECT * FROM donors ORDER BY id ASC";
$users_result = mysqli_query($conn, $users_sql);

// Fetch months for filter dropdown
$month_sql = "SELECT DISTINCT month FROM donations ORDER BY FIELD(month,'January','February','March','April','May','June','July','August','September','October','November','December')";
$month_result = mysqli_query($conn, $month_sql);
$months = [];
while($row = mysqli_fetch_assoc($month_result)){ $months[] = $row['month']; }

$filter_month = isset($_GET['month']) ? $_GET['month'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel - Users Total</title>
<style>
body { font-family: Arial,sans-serif; background:#f4f4f4; margin:0; padding:0;}
.container { width:95%; margin:20px auto; padding-bottom:50px;}
h2 { text-align:center; margin-bottom:20px;}
table { width:100%; border-collapse: collapse; background:#fff; box-shadow:0 0 10px rgba(0,0,0,0.1);}
th, td { border:1px solid #ccc; padding:10px; text-align:center;}
th { background:#0984e3; color:#fff; text-transform:uppercase;}
tr:hover { background:#dfe6e9;}
input[type=number], select { padding:5px; width:90%; border:1px solid #ccc; border-radius:4px;}
button { padding:5px 10px; background:#00b894; border:none; color:#fff; border-radius:5px; cursor:pointer; transition:0.3s;}
button:hover { background:#00cec9;}
form.inline { display:flex; justify-content:center; align-items:center; gap:5px;}
.user-photo { width:50px; height:50px; border-radius:50%; object-fit:cover;}
.logout { text-align:center; margin:20px; position:fixed; bottom:10px; width:100%;}
.logout a { display:inline-block; padding:10px 20px; background:#e17055; color:#fff; font-weight:bold; text-decoration:none; border-radius:5px; transition:0.3s;}
.logout a:hover { background:#d63031;}
.total-row { font-weight:bold; background:#ffeaa7;}
@media screen and (max-width:768px){ table, th, td{font-size:12px;} input[type=number], select{width:100%;} }
</style>
</head>
<body>

<div class="container">
    <h1 class="nav-logo">ইনকি<span style="color:aqua;">লাব</span></h1>
<h2>Admin Panel</h2>

<!-- Month Filter -->
<form method="get" style="text-align:center; margin-bottom:15px;">
    
    <label style="font-weight:bold;">Select Month: </label>
    <select name="month" onchange="this.form.submit()">
        <option value="">All Months</option>
        <?php foreach($months as $m): ?>
            <option value="<?php echo $m; ?>" <?php if($filter_month==$m) echo "selected"; ?>>
                <?php echo $m; ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<table>
<tr>
    <th>Serial</th>
    <th>Photo</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Balance (Tk)</th>
    <th>Last Amount (Tk)</th>
    <th>Last Month</th>
    <th>Total Amount (Tk)</th>
    <th>Total Months</th>
    <th>Update</th>
</tr>

<?php
$serial = 1; // Display serial number
$total_balance = 0;
$total_amount  = 0;

while($user = mysqli_fetch_assoc($users_result)){
    $user_id = $user['id'];

    // Fetch latest donation
    $donation_sql = "SELECT * FROM donations WHERE user_id='$user_id' ";
    if($filter_month) $donation_sql .= " AND month='$filter_month' ";
    $donation_sql .= " ORDER BY id DESC LIMIT 1";
    $donation_res = mysqli_query($conn, $donation_sql);
    $last_donation = mysqli_fetch_assoc($donation_res);

    // Fetch total donation and month count
    $total_sql = "SELECT SUM(amount) as total_amount, COUNT(DISTINCT month) as total_months
                  FROM donations WHERE user_id='$user_id' ";
    if($filter_month) $total_sql .= " AND month='$filter_month' ";
    $total_res = mysqli_query($conn,$total_sql);
    $total_row = mysqli_fetch_assoc($total_res);

    $total_balance += $user['balance'];
    $total_amount  += $total_row['total_amount'];
?>
<tr>
    <td><?php echo $serial++; ?></td> <!-- Display serial -->
    <td><img src="../uploads/<?php echo $user['photo']; ?>" class="user-photo"></td>
    <td><?php echo $user['name']; ?></td>
    <td><?php echo $user['email']; ?></td>
    <td><?php echo $user['phone']; ?></td>
    <td>
        <form method="post" class="inline">
            <input type="hidden" name="donation_id" value="<?php echo $last_donation['id'] ?? ''; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <input type="number" name="balance" value="<?php echo $user['balance']; ?>" required>
    </td>
    <td>
        <input type="number" name="amount" value="<?php echo $last_donation['amount'] ?? 0; ?>" required>
    </td>
    <td>
        <select name="month" required>
            <?php 
            $all_months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            foreach($all_months as $mth): ?>
                <option value="<?php echo $mth; ?>" <?php if(($last_donation['month'] ?? '')==$mth) echo "selected"; ?>>
                    <?php echo $mth; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </td>
    <td><?php echo $total_row['total_amount'] ?? 0; ?></td>
    <td><?php echo $total_row['total_months'] ?? 0; ?></td>
    <td>
        <button type="submit" name="update">Update</button>
        </form>
    </td>
</tr>
<?php } ?>

<tr class="total-row">
    <td colspan="5">Total Balance</td>
    <td><?php echo $total_balance; ?> Tk</td>
    <td colspan="5"></td>
</tr>

</table>
</div>

<div class="logout">
    <a href="admin_logout.php">Logout</a>
</div>

</body>
</html>
