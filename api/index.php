<?php

// Log raw POST data
$raw_post_data = file_get_contents("php://input");
error_log('Raw POST data: ' . $raw_post_data);

// Log received POST data
error_log('Received POST data: ' . print_r($_POST, true));

/*$merchant_id         = isset($_POST['merchant_id']) ? $_POST['merchant_id'] : '';
$order_id            = isset($_POST['order_id']) ? $_POST['order_id'] : '';
$payhere_amount      = isset($_POST['amount']) ? $_POST['amount'] : '';
$payhere_currency    = isset($_POST['currency']) ? $_POST['currency'] : '';
$status_code         = isset($_POST['status_code']) ? $_POST['status_code'] : '';
$md5sig              = isset($_POST['md5sig']) ? $_POST['md5sig'] : '';*/

/*$merchant_id         = isset($_POST['1225212']) ? $_POST['merchant_id'] : '';
$order_id            = isset($_POST['ItemNo12346']) ? $_POST['order_id'] : '';
$payhere_amount      = isset($_POST['30.00']) ? $_POST['amount'] : '';
$payhere_currency    = isset($_POST['LKR']) ? $_POST['currency'] : '';
$status_code         = isset($_POST['2']) ? $_POST['status_code'] : '';
$md5sig              = isset($_POST['local_md5sig']) ? $_POST['md5sig'] : '';*/

$merchant_id         = $_POST['merchant_id'];
$order_id            = $_POST['order_id'];
$payhere_amount      = $_POST['payhere_amount'];
$payhere_currency    = $_POST['payhere_currency'];
$status_code         = $_POST['status_code'];
$md5sig              = $_POST['md5sig'];

/*$merchant_id         = $_POST['1225212'];
$order_id            = $_POST['ItemNo12346'];
$payhere_amount      = $_POST['30.00'];
$payhere_currency    = $_POST['LKR'];
$status_code         = $_POST['2'];
$md5sig              = $_POST['md5sig'];*/

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

if (empty($_POST)) {
    error_log('No POST data received.');
} elseif (($local_md5sig === $md5sig) AND ($status_code == '2')) {
    error_log('Successful payment for order ID: ' . $order_id);
    error_log('POST data received: ' . print_r($_POST, true));
} else {
    // Log an error or take appropriate action for failed validation
    error_log('Payment validation failed for order ID: ' . $order_id);
    error_log('POST data received: ' . print_r($_POST, true));
}

?>
