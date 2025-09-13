<?php
$secret_key = 'MYSECRET';
$log_file = 'postback-log.txt';
$log_entry = "=== New Request at " . date('Y-m-d H:i:s') . " ===\n";
$log_entry .= "GET params:\n" . print_r($_GET, true) . "\n";
file_put_contents($log_file, $log_entry, FILE_APPEND);
$clickid = $_GET['clickid'] ?? '';
$payout  = $_GET['payout'] ?? '';
$orderid = $_GET['orderid'] ?? '';
$token   = $_GET['token'] ?? '';
if ($token !== $secret_key) {
    http_response_code(403);
    echo "Invalid token";
    exit;
}
$log_entry = date('Y-m-d H:i:s') . " | ClickID: $clickid | Payout: $payout | OrderID: $orderid\n";
file_put_contents($log_file, $log_entry, FILE_APPEND);
echo "OK";
