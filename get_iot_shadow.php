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
        "message" => "当前客户端未初始化或绑定过期，请重新绑定",
        "codeDesc" => "当前客户端未初始化，无法读取客户端设备ID")
    );
    return;
}

$secret_id = $_COOKIE[COOKIE_SECRET_ID];
if (empty($secret_id)) {
    echo json_encode(
        array("code" => 402,
        "message" => "当前客户端sid未初始化或绑定过期，请重新绑定",
        "codeDesc" => "当前客户端未初始化，无法读取secret id")
    );
    return;
}
$secret_key = $_COOKIE[COOKIE_SECRET_KEY];
if (empty($secret_key)) {
    echo json_encode(
        array("code" => 402,
        "message" => "当前客户端skey未初始化或绑定过期，请重新绑定",
        "codeDesc" => "当前客户端未初始化，无法读取secret key")
    );
    return;
}

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

