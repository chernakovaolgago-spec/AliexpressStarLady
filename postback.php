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

$country = $_GET['country'] ?? '';
$platform = $_GET['platform'] ?? '';
$item_id = $_GET['item_id'] ?? '';
$new_buyer_bonus = $_GET['new_buyer_bonus'] ?? '';
$is_not_product = $_GET['is_not_product'] ?? '';
$base_commission_rate = $_GET['base_commission_rate'] ?? '';
$order_platform = $_GET['order_platform'] ?? '';

if ($token !== $secret_key) {
    file_put_contents($log_file, "Invalid token: $token\n", FILE_APPEND);
    http_response_code(403);
    echo "Invalid token";
    exit;
}

$log_entry = "Valid request: ClickID=$clickid | Payout=$payout | OrderID=$orderid | Country=$country | Platform=$platform | ItemID=$item_id | Bonus=$new_buyer_bonus | IsNotProduct=$is_not_product | BaseRate=$base_commission_rate | OrderPlatform=$order_platform\n";
file_put_contents($log_file, $log_entry, FILE_APPEND
