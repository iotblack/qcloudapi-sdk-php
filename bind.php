<?php
require 'vendor/autoload.php';

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

if (empty($product_id)) {
    echo "product_id not found";
    return;
}

if (empty($device_name)) {
    echo "device_name not found";
    return;
}

echo "<H4>请扫描如下二维码，绑定设备：$product_id/$device_name </H4>";
$data = "http://iot.devhost/auth.php?product_id=$product_id&device_name=$device_name";
echo "<a href='$data'>绑定</a><p>";
echo '<img src="'.(new QRCode)->render($data).'" />';


