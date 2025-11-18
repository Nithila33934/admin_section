<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header( "location: C:\xampp\htdocs\<admin_section>login.php");
    exit();
}
include("db_connect.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="meters.php">Meters</a></li>
                <li><a href="reading.php">Meter Readings</a></li>
                <li><a href="bills.php">Bills</a></li>
                <li><a href="payments.php">Payments</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="content"></div>
    </body>
</html>