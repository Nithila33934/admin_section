<?php 
require_once 'db_connect.php';

$nic = isset($_GET['nic']) ? trim($_GET['nic']) : null;
$meter = isset($_GET['meter']) ? trim($_GET['meter']) : null;

if (!$nic && !$meter) {
    echo '<div>Please provide NIC and Meter Number to view bills.</div>';
    exit;
}

try {
    $params = [];
    $where = [];

    if ($nic) {
        $where[] = "nic = :nic";
        $params[':nic'] = $nic;
    }

    if ($meter) {
        $where[] = "meter_number = :meter_number";
        $params[':meter'] = $meter;
    }

    $sql = "SELECT id, meter_number, bill_month, amount, status, date_added 
            FROM bills
            WHERE " . implode(' AND ', $where) . "
            ORDER BY bill_month DESC";

            $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll();

    if (!$rows) {
        echo '<div>No bills found for the provided details.</div>';
        exit;
    }

    echo '<table border="0" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse;">';
    echo '<thead><tr style="background:#eee;"><th>Bill Month</th><th>Amount</th><th>Status</th><th>Date Added</th></tr></thead><tbody>';
    foreach ($rows as $row) {
        $month = htmlspecialchars($row['bill_month']);
        $amount = number_format($row['amount'], 2);
        $status = htmlspecialchars($row['status']);
        $date_added = htmlspecialchars($row['date_added']);
        $meter_number = htmlspecialchars($row['meter_number']);
        echo "<tr><td>{$month}</td><td>\${$amount}</td><td>{$status}</td><td>{meter_number}</td><td>{$date_added}</td></tr>";

    }
    echo '</tbody></table>';
} catch (PDOException $e) {
    echo '<div>Error retrieving bills: ' . htmlspecialchars($e->getMessage()) . '</div>';
}