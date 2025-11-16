<?php 
header('Content-Type: application/json; charset=utf-8');
require_once 'db_connect.php';

$phone = isset($_GET['phone']) ? trim($_GET['phone']) : null;
$message = isset($_GET['message']) ? trim($_GET['message']) : null;

if (!$phone) {
    echo json_encode(['success' => false, 'error' => 'Phone number is required.']);
    exit();
}

if ($message) {
    echo json_encode([
        'success' => true,
        'status' => 'SIMULATED_SENT',
        'phone' => $phone,
        'message' => $message
    ]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT meter_number, nic, name FROM users WHERE phone = :phone");
    $stmt->execute([':phone' => $phone]);
    $user = $stmt->fetch();
    if (!$user) {
        echo json_encode(['success' => false, 'error' => 'User not found.']);
        exit;
    }
    $meter = $user['meter_number'];

    $stmt = $pdo->prepare("SELECT bill_month, amount, status, date_added FROM bills WHERE meter_number = :meter_number ORDER BY bill_month DESC LIMIT 1");
    $stmt->execute([':meter_number' => $meter]);
    $bill = $stmt->fetch();

    if (!$bill) {
        echo json_encode(['success' => true, 'error' => 'No bills found for this user.']);
        exit;
    }

    echo json_encode([
        'success' => true,
        'user' => $user,
        'latest_bill' => $bill

    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error', 'details' => $e->getMessage()]);
}
