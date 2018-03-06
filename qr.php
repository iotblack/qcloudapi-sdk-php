<?php
require 'vendor/autoload.php';

use chillerlan\QRCode\{QRCode, QROptions};

$data = $_REQUEST['data'];
if (empty($data)) {
    echo "data for qr code not given.";
    return;
}

$options = new QROptions([
        'version'      => 7,
        'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
        'eccLevel'     => QRCode::ECC_L,
        'scale'        => 5,
        'imageBase64'  => false,
]);

header('Content-type: image/png');

echo (new QRCode($options))->render($data);
