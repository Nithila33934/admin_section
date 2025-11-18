<?php
session_start();
include("includes/db_connect.php");

$msg = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nic = $_POST['nic'];
    $meter_no = $_POST['meter_number'];

    $q = "SELECT * FROM users WHERE nic = ? AND meter_number = ?";
    $stmt = sqlsrv_query($conn, $q, [$nic, $meter_no]);
    if($stmt && $row = sqlsrv_fetch_array($stmt)){
        $_SESSION['user_nic'] = $row['nic'];
        $_SESSION['user_meter'] = $row['meter_number'];
        header("Location: user_insert.php");
        exit;
    } else {
        $msg = "Invalid NIC or Meter Number.";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body class="login-bg">
    <div class="login-card">
        <h2>User Access Portal</h2>
        <form method="POST">
            <input type="text" name="nic" placeholder="Enter NIC" required><br><br>
            <input type="text" name="meter_number" placeholder="Enter Meter Number" required><br><br>
            <button type="submit" class="btn">Show</button>
        </form>
        <p stype="color:black;"><?php echo $msg; ?></p>
    </div>
</body>
</html>
