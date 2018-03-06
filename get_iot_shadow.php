<?php
error_reporting(E_ALL ^ E_NOTICE);
include('const.php');
require_once './src/QcloudApi/QcloudApi.php';
$configs = include('config.php');

$product_id = $_REQUEST['productId'];
$device_name = $_REQUEST['deviceName'];
header('Content-Type: application/json');

$app_did = $_COOKIE[COOKIE_APP_DEVICE_ID];
if (empty($app_did)) {
    echo json_encode(
        array("code" => 401, 
        "message" => "当前客户端未初始化", 
        "codeDesc" => "当前客户端未初始化，无法读取客户端设备ID")
    );
    return;
}

$redis = new Redis();
$redis->connect($configs['redis_host'], $configs['redis_port']);

$bind_product = $redis->hget("app_client_$app_did", $device_name);
if (empty($bind_product)) {
    echo json_encode(
        array("code" => 402, 
        "message" => "未绑定任何设备", 
        "codeDesc" => "设备未绑定")
    );
    return;
}

if (($product_id != $bind_product)) {
    echo json_encode(
        array("code" => 403, 
        "message" => "绑定关系错误", 
        "codeDesc" => "客户端未绑定设备不对")
    );
    return;
}

$secret_id = $redis->get("secretid");
$secret_key = $redis->get("secretkey");

$config = array('SecretId'       => $secret_id,
                'SecretKey'      => $secret_key,
                'RequestMethod'  => 'POST',
                'DefaultRegion'  => 'gz');

$iotsuite = QcloudApi::load(QcloudApi::MODULE_IOT, $config);

$package = array('productId' => $product_id, 'deviceName' => $device_name, 'SignatureMethod' =>'HmacSHA256');

$a = $iotsuite->GetIotShadow($package);

if ($a === false) {
    $error = $iotsuite->getError();
    echo json_encode(
        array("code" => $error->getCode(), 
        "message" => $error->getMessage(), 
        "codeDesc" => $error->getExt())
    );
    return;

} else {
    echo $iotsuite->getLastResponse();
    return;
}

