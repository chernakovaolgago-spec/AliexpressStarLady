<?php
$secret_key = 'MYSECRET';
$log_file = 'postback-log.txt';

// Log every connection
$log_entry = "=== Connection at " . date('Y-m-d H:i:s') . " ===\n";
$log_entry .= "Raw GET: " . print_r($_GET, true) . "\n";
$log_entry .= "Raw POST: " . file_get_contents('php://input') . "\n";
file_put_contents($log_file, $log_entry, FILE_APPEND);

// Get parameters
$clickid = $_GET['clickid'] ?? '';
$payout  = $_GET['payout'] ?? '';
$orderid = $_GET['orderid'] ?? '';
$token   = $_GET['token'] ?? '';

// Token check
if ($token !== $secret_key) {
    file_put_contents($log_file, "Invalid token: $token\n", FILE_APPEND);
    http_response_code(403);
    echo "Invalid token";
    exit;
}

// Log main data
$log_entry = "Valid request: ClickID=$clickid | Payout=$payout | OrderID=$orderid\n";
file_put_contents($log_file, $log_entry, FILE_APPEND);

// Send response
echo "OK";
