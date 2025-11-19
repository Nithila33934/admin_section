<?php 
header('Content-Type: application/json; charset=utf-8');

include("db_connect.php");

function post($key){
    return isset($_POST[$key]) ? trim($_POST[$key]) : null;

}

$name = post('name');
$meter_number = post('meter_number');
$address = post('address');
$phone = post('phone');
$nic = post('nic');

$errors = [];
if (!$name) $errors[] = 'Name is required.';
if (!$meter_number) $errors[] = 'Meter number is required.';
if (!$nic) $errors[] = 'NIC is required.';

if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit();
}

$sql = "IF EXISTS (SELECT 1 FROM users WHERE meter_number = ?)
        BEGIN
            UPDATE users
            SET name = ?, address = ?, phone = ?, nic = ?
            WHERE meter_number = ?
        END
        ELSE
        BEGIN
            INSERT INTO users (name, meter_number, address, phone, nic)
            VALUES (?, ?, ?, ?, ?)
        END";

        $params = [
            $meter_number,
            $name, $address, $nic, $phone,
            $meter_number,
            $name, $meter_number, $address, $phone, $nic
        ];

        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt) {
            echo json_encode(['success' => true, 'message' => 'User inserted/updated successfully.']);
        } else {
            
            echo json_encode(['success' => false, 'errors' => 'Database error', 'details' => sqlsrv_errors()]);
        }