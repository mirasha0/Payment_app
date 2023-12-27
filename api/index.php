<?php

$merchant_id         = $_POST['merchant_id'];
$order_id            = $_POST['order_id'];
$payhere_amount      = $_POST['payhere_amount'];
$payhere_currency    = $_POST['payhere_currency'];
$status_code         = $_POST['status_code'];
$md5sig              = $_POST['md5sig'];

$merchant_secret = 'MzE4MjcwNTIzMDI1OTkwNDkwMjExMDUyOTQ1ODQzMjk3MzQ0MDE5Mg=='; // Replace with your Merchant Secret

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
       
if (empty($_POST)) {
    error_log('No POST data received...........');
} elseif (($local_md5sig === $md5sig) AND ($status_code == '2')) {
    echo('Successful payment for order ID: ' . $order_id);
    echo('POST data received: ' . print_r($_POST, true));
} else {
    // Log an error or take appropriate action for failed validation
    echo('Payment validation failed for order ID: ' . $order_id);
    echo('POST data received: ' . print_r($_POST, true));

}

?>