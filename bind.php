<?php
require 'vendor/autoload.php';
include('const.php');

use chillerlan\QRCode\{QRCode, QROptions};

$options = new QROptions([
        'version'      => 7,
        'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
        'eccLevel'     => QRCode::ECC_L,
        'scale'        => 5,
        'imageBase64'  => false,
]);

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

$secure = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?1:0;

setcookie(COOKIE_SECRET_ID, $secret_id, time()+3600, "", "", $secure);
setcookie(COOKIE_SECRET_KEY, $secret_key, time()+3600, "", "", $secure);

// output: localhost
$host_name = $_SERVER['HTTP_HOST'];

// output: http://
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

echo "<H4>请扫描如下二维码，绑定设备：$product_id/$device_name </H4>";
$data = "$protocol://$host_name/auth.php?product_id=$product_id&device_name=$device_name";
echo "<a href='$data'>绑定</a><p>";
echo '<img src="'.(new QRCode)->render($data).'" />';


