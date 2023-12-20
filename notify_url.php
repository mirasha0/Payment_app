<?php

error_log('Received POST data: ' . print_r($_POST, true));

$merchant_id         = isset($_POST['merchant_id']) ? $_POST['merchant_id'] : '';
$order_id            = isset($_POST['order_id']) ? $_POST['order_id'] : '';
$payhere_amount      = isset($_POST['amount']) ? $_POST['amount'] : '';
$payhere_currency    = isset($_POST['currency']) ? $_POST['currency'] : '';
$status_code         = isset($_POST['status_code']) ? $_POST['status_code'] : '';
$md5sig              = isset($_POST['md5sig']) ? $_POST['md5sig'] : '';

$merchant_secret = 'MjQ0MzY3NDU3NTM1Njg0MDA0NzQyNzU1ODQxOTY0NDEwNDcwMzAzMg==';

$local_md5sig = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        $payhere_amount . 
        $payhere_currency . 
        $status_code . 
        $merchant_secret 
    ) 
);

error_log('Local MD5 Signature: ' . $local_md5sig);
error_log('Received MD5 Signature: ' . $md5sig);

if (($local_md5sig === $md5sig) AND ($status_code == '2')) {
    error_log('Successful payment for order ID: ' . $order_id);
    error_log('POST data received: ' . print_r($_POST, true));
} else {
    // Log an error or take appropriate action for failed validation
    error_log('Payment validation failed for order ID: ' . $order_id);
    error_log('POST data received: ' . print_r($_POST, true));
}

?>
