<?php 
header('Content-Type: application/json; charset=utf-8');

require_once 'db_connect.php';

function post($key){
    return isset($_POST[$key]) ? trim($_POST[$key]) : null;

}

$name = post('name');
$meter_number = post('meter_number');
$address = post('address');
$phone = post('phone');
$email = post('email');

$errors = [];
if (!$name) $errors[] = 'Name is required.';
if (!$meter_number) $errors[] = 'Meter number is required.';
if (!$nic) $errors[] = 'NIC is required.';

if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit();
}

try {
    $sql = "INSERT INTO users (name, meter_number, address, nic, phone) 
            VALUES (:name, :meter_number, :address, :nic, :phone)
            ON DUPLICATE KEY UPDATE
            name = VALUES(name),
            address = VALUES(address),
            phone = VALUES(phone),
            created_at = NOW()";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':meter_number' => $meter_number,
        ':address' => $address,
        ':nic' => $nic,
        ':phone' => $phone
    ]);

    echo json_encode(['success' => true, 'message' => 'User inserted/updated successfully.']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error', 'details' => $e->getMessage()]);
}
