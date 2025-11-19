<?php
session_start();

if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <link rel="stylesheet" href="admin_styles.css">
    </head>
    <body>
        <h1>Welcome!</h1>
        <p><strong>NIC:</strong> <?php echo $_SESSION['nic'];?></p>
        <p><strong>Meter Number:</strong><?php echo $_SESSION['meter_no']; ?></p>

        <br>

        <a href="get_bills.php">View Bills</a><br>
        <a href="status.php">View Payments</a><br>
        <a href="logout.php">Logout</a>
    </body>
</html>