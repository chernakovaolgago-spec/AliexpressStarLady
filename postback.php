<?php
$secret_key = 'MYSECRET';
$log_file = 'postback-log.txt';

$log_entry = "=== Connection at " . date('Y-m-d H:i:s') . " ===\n";
$log_entry .= "Raw GET: " . print_r($_GET, true) . "\n";
$log_entry .= "Raw POST: " . file_get_contents('php://input') . "\n";
$log_entry .= "--------------------------\n";
file_put_contents($log_file, $log_entry, FILE_APPEND);

$clickid = $_GET['clickid'] ?? '';
$payout  = $_GET['payout'] ?? '';
$orderid = $_GET['orderid'] ?? '';
$token   = $_GET['token'] ?? '';

if ($token !== $secret_key) {
    file_put_contents($log_file, "Invalid token: $token\n", FILE_APPEND);
    http_response_code(403);
    echo "Invalid token";
    exit;
}

$log_entry = "Valid request: ClickID=$clickid | Payout=$payout | OrderID=$orderid\n";
file_put_contents($log_file, $log_entry, FILE_APPEND);

echo "OK";
