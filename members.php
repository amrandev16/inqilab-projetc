<?php
session_start();
$conn = new mysqli('localhost','root','','inqilab_db');
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

// সব donor এবং তাদের সর্বশেষ donation আনা
$sql = "SELECT d.id, d.name, d.email, d.phone, d.balance, d.photo,
               dn.amount AS last_amount, dn.month AS last_month, dn.method AS last_method
        FROM donors d
        LEFT JOIN donations dn ON dn.id = (
            SELECT id FROM donations 
            WHERE user_id = d.id 
            ORDER BY id DESC LIMIT 1
        )";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>All Members</title>
<link rel="stylesheet" href="styles.css">
<style>
table {
    width: 95%;
    border-collapse: collapse;
    margin: 20px auto;
}
table, th, td {
    border: 1px solid #2aa9cfff;
    padding: 10px;
    text-align: center;
}
th {
    background: #eee;
}
img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
</style>
</head>
<body style="background-color:pink;">
<h2 style="text-align:center;">👥 All Members & Donation History</h2>
<table>
    <tr>
        <th>Serial</th> <!-- ID এর পরিবর্তে Serial -->
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Balance (Tk)</th>
        <th>Last Donation</th>
        <th>Month</th>
        <th>Method</th>
    </tr>
    <?php 
    $serial = 1; // serial counter শুরু
    while($row = mysqli_fetch_assoc($result)){ ?>
    <tr>
        <td><?php echo $serial++; ?></td> <!-- serial number display -->
        <td>
            <?php if(!empty($row['photo'])){ ?>
                <img src="uploads/<?php echo $row['photo']; ?>" alt="photo">
            <?php } else { echo "No Photo"; } ?>
        </td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo number_format($row['balance'],2); ?></td>
        <td><?php echo $row['last_amount'] ? $row['last_amount']." Tk" : "No Donation"; ?></td>
        <td><?php echo $row['last_month'] ? $row['last_month'] : "-"; ?></td>
        <td><?php echo $row['last_method'] ? $row['last_method'] : "-"; ?></td>
    </tr>
    <?php } ?>
</table>

<p style="text-align:center;margin-top:20px;">
    <a href="donation_page.php">⬅ Back to Donation Page</a>
</p>
</body>
</html>
