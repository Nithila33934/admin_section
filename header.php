<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header( "location: C:\xampp\htdocs\admin_section/login.php");
    exit();
}
include("db_connect.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="admin_styles.css">
    </head>
    
</html>