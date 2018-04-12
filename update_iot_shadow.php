<?php
error_reporting(E_ALL ^ E_NOTICE);
include('const.php');
require_once './src/QcloudApi/QcloudApi.php';
$configs = include('config.php');

header('Content-Type: application/json');

$product_id = $_REQUEST['productId'];
$device_name = $_REQUEST['deviceName'];

session_start();
$secret_id = $_SESSION[KEY_SECRET_ID];
if (empty($secret_id)) {
    echo json_encode(
        array("code" => 402,
        "message" => "secret id not found",
        "codeDesc" => "当前客户端未初始化，无法读取secret id")
    );
    return;
}
$secret_key = $_SESSION[KEY_SECRET_KEY];
if (empty($secret_key)) {
    echo json_encode(
        array("code" => 402,
        "message" => "secret key not found",
        "codeDesc" => "当前客户端未初始化，无法读取secret key")
    );
    return;
}

$shadow = $_REQUEST['shadow'];

$config = array('SecretId'       => $secret_id,
                'SecretKey'      => $secret_key,
                'RequestMethod'  => 'POST',
                'DefaultRegion'  => 'gz');

$iotsuite = QcloudApi::load(QcloudApi::MODULE_IOT, $config);

$package = array('productId' => $product_id,
    'deviceName' => $device_name,
    'shadow' => $shadow,
    'SignatureMethod' =>'HmacSHA256');

$a = $iotsuite->UpdateIotShadow($package);


if ($a === false) {
    $error = $iotsuite->getError();
    echo json_encode(
        array("code" => $error->getCode(),
        "message" => $error->getMessage(),
        "codeDesc" => $error->getExt())
    );

} else {
    echo $iotsuite->getLastResponse();
}

