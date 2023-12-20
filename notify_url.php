<?php

$merchant_id         = $_POST['1225212'];
$order_id            = $_POST['ItemNo12346'];
$payhere_amount      = $_POST['30.00'];
$payhere_currency    = $_POST['LKR'];
$status_code         = $_POST['2'];
$md5sig              = $_POST['local_md5sig'];

$merchant_secret = 'MjQ0MzY3NDU3NTM1Njg0MDA0NzQyNzU1ODQxOTY0NDEwNDcwMzAzMg=='; // Replace with your Merchant Secret

$local_md5sig = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        $payhere_amount . 
        $payhere_currency . 
        $status_code . 
        strtoupper(md5($merchant_secret)) 
    ) 
);
       
if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
    error_log('Successful payment for order ID: ' . $order_id);
    error_log('POST data received: ' . print_r($_POST, true));

} else {
    // Log an error or take appropriate action for failed validation
    error_log('Payment validation failed for order ID: ' . $order_id);
    error_log('POST data received:12 ' . print_r($_POST, true));

}

?>