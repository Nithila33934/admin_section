<?php
$serverName = "ASUS\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array("Database"=>"UMS");

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn) {
     echo "Database connection OK";
} else {
    echo "Connection Failed <br>";
    print_r(sqlsrv_errors());
}
?>