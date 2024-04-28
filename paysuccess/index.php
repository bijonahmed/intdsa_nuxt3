<?php
$merchant_key="f82b830d09bc92f726b71066be300c50";
 function get_sign($data = array(), $key = '')
{
    $merchant_no = isset($data['merchant_no']) ? $data['merchant_no'] : '';
    $params = isset($data['params']) ? $data['params'] : '';
    $sign_type = isset($data['sign_type']) ? $data['sign_type'] : '';
    $timestamp = isset($data['timestamp']) ? $data['timestamp'] : '';
    $sign_str = $merchant_no . $params . $sign_type . $timestamp . $key;
    $sign = md5($sign_str);
    return $sign;
}
$db=require('config.php');
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') {
    $file = strtotime("NOW").'GET.txt';
    file_put_contents($file, json_encode($_GET));
    
}
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $file = strtotime("NOW").'post.txt';
    $pdata=$_POST;
    if(empty($_POST)){
        $pdata=file_get_contents("php://input");
        $pdata=json_decode($pdata,1);
    }
    file_put_contents($file, json_encode($pdata));
    $request = $pdata; //POST参数 POST parameters
    if(!empty($request['test'])){
        $txt=file_get_contents('./test.json');
        $request=json_decode($txt,1);
        //print_r($request);
    }
    $mysign = get_sign($request, $merchant_key);
    $params = isset($request['params']) ? json_decode($request['params'], true) : [];
    $sign = isset($request['sign']) ? $request['sign'] : '';
    if ($sign == $mysign) {
        $status = isset($params['status']) ? (int)$params['status'] : 0;
        if ($status == 1) {
            $text = "SUCCESS";
            $db->query("UPDATE `deposit` SET status='1' WHERE depositID='{$params['merchant_ref']}' AND status='0'");
        } else {
            $text = "FAIL";
        }
    } else {
        $text = "SIGN_ERROR";
    }
    exit($text);
}
