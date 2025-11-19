<?php
session_start();


// Unset all of the session variables
session_unset();

// Destroy the session
session_destroy();


// Redirect to login page after logout
header("Location: login.php");
exit;
?>