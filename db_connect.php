<?php 
$serverName = "ASUS\\SQLEXPRESS"; //serverName\instanceName
$connectionOptions = [
    "Database" => "UMS",
    "Uid" => "",
    "PWD" => ""
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
    echo "Connected Successfully!";
} else {
    echo "Connection Failed!";
    die(print_r(sqlsrv_errors(), true));
}
    
?>

