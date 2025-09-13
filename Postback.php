<?php
$secret_key = 'MYSECRET'; // токен для защиты

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
file_put_contents('postback_log.txt', $log_entry, FILE_APPEND);

echo "OK";
