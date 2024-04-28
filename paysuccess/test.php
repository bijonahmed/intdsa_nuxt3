<?php
require __DIR__ . '/vendor/autoload.php';
use Curl\Curl;
$curl = new Curl();
$db=require('config.php');

$api_key="f82b830d09bc92f726b71066be300c50";
$data = [
   "merchant_no" => "3090032", 
   "timestamp" => strtotime("NOW"), 
   "sign_type" => "MD5", 
   
];
$params = [
   "merchant_ref" => str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT), 
   "product" => "USDT-TRC20Deposit", 
   "amount" => 30, 
   "language" => "en_EN" 
]; 
$data["params"] = json_encode($params,320);

$sorted="{$data['merchant_no']}{$data['params']}{$data['sign_type']}{$data['timestamp']}{$api_key}";
$data["sign"]=md5($sorted);
$r=$curl->post('https://api.dppay.vip/api/gateway/pay', $data);

echo "Request Data:<br>";
echo json_encode($data);
echo "<br>Response:<br>";
echo json_encode($r);
 
