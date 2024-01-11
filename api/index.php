<?php

$merchant_id = isset($_POST['merchant_id']) ? $_POST['merchant_id'] : null;
$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;
$payhere_amount = isset($_POST['payhere_amount']) ? $_POST['payhere_amount'] : null;
$payhere_currency = isset($_POST['payhere_currency']) ? $_POST['payhere_currency'] : null;
$status_code = isset($_POST['status_code']) ? $_POST['status_code'] : null;
$md5sig = isset($_POST['md5sig']) ? $_POST['md5sig'] : null;

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
        //TODO: Update your database as payment success
}

?>