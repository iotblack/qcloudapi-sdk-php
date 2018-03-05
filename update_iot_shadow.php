<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once './src/QcloudApi/QcloudApi.php';


$secret_id = $_REQUEST['secretid'];
$secret_key = $_REQUEST['secretkey'];
$product_id = $_REQUEST['productId'];
$device_name = $_REQUEST['deviceName'];
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

header('Content-Type: application/json');

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

