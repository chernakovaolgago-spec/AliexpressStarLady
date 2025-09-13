<?php
// Токен для защиты
$secret_key = 'MYSECRET';

// Логируем всё, что пришло
$log_file = 'postback-log.txt';
$log_entry = "=== New Request at " . date('Y-m-d H:i:s') . " ===\n";
$log_entry .= "GET params: " . print_r($_GET, true) . "\n";
file_put_contents($log_file, $log_entry, FILE_APPEND);

// Получаем параметры
$clickid = $_GET['clickid'] ?? '';
$payout  = $_GET['payout'] ?? '';
$orderid = $_GET['orderid'] ?? '';
$token   = $_GET['token'] ?? '';

// Проверка токена
if ($token !== $secret_key) {
    http_response_code(403);
    echo "Invalid token";
    exit;
}

// Записываем основную информацию
$log_entry = date('Y-m-d H:i:s') . " | ClickID: $clickid | Payout: $payout | OrderID: $orderid\n";
file_put_contents($log_file, $log_entry, FILE_APPEND);

// Отправляем ответ AliExpress
echo "OK";
