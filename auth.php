<?php
include('const.php');
$configs = include('config.php');

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', 
        mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), 
        mt_rand(16384, 20479), mt_rand(32768, 49151), 
        mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

$product_id = $_REQUEST['product_id'];
$device_name = $_REQUEST['device_name'];

$secret_id = $_REQUEST['secret_id'];
$secret_key = $_REQUEST['secret_key'];

if (empty($product_id)) {
    echo "product_id not found";
    return;
}

if (empty($device_name)) {
    echo "device_name not found";
    return;
}

if (empty($secret_id)) {
    echo "secret_id not found";
    return;
}

if (empty($secret_key)) {
    echo "secret_key not found";
    return;
}

$app_did = $_COOKIE[COOKIE_APP_DEVICE_ID];
if (empty($app_did)) {
    $app_did = GUID();
}
session_start([
    'cookie_lifetime' => 86400,
]);

$_SESSION[COOKIE_SECRET_ID] = $secret_id;
$_SESSION[COOKIE_SECRET_KEY] = $secret_key;
// setcookie(COOKIE_SECRET_ID, $secret_id, time()+$configs["secret_expire"], "", "", $secure, 1);
// setcookie(COOKIE_SECRET_KEY, $secret_key, time()+$configs["secret_expire"], "", "", $secure, 1);

echo "设备绑定成功。<br>APP 设备 ID：$app_did<br>产品 ID：$product_id<br> 设备名称：$device_name<br>";
echo "<a href='app.php?product_id=$product_id&device_name=$device_name'>前往控制页面</a>";

$secure = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?1:0;
setcookie(COOKIE_APP_DEVICE_ID, $app_did, time()+ $configs["secret_expire"], "", "", $secure, 1);

