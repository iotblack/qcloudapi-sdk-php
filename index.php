<?php

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>腾讯物联网套件主控端演示</title>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Lato:300,400,700'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.css'>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js'></script>
    <script src="js/index.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
  <body>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2" id='panel_settings'>
        <H3>设备参数</H3>
        <form id="controller-form" method="post" action="bind.php" role="form">
        <div class="controls">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_secret_id">Secret Id *</label>
                <input id="form_secret_id" type="text" name="secret_id" class="form-control" placeholder="请输入 Secret Id*" required="required" data-error="请输入 Secret ID">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_secret_key">Secret Key *</label>
                <input id="form_secret_key" type="text" name="secret_key" class="form-control" placeholder="请输入 Secret Key*" required="required" data-error="请输入 Secret Key">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_product_id">Product Id *</label>
                <input id="form_product_id" type="text" name="product_id" class="form-control" placeholder="请输入 Product ID *" required="required" data-error="请输入 Product ID">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_device_name">Device Name</label>
                <input id="form_device_name" type="text" name="device_name" class="form-control" placeholder="请输入 Device Name">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <input type="submit" class="btn btn-success btn-send" value="开始绑定" id="btn_get_iot_shadow">
              </div>
             </div>
        </div>
        </form>
      </div>
        <strong>[本页面为简化演示而采用的 Secret ID 和 Secret Key 直接传递方式，仅限内部Demo使用，注意保护好您的 Secret Id 和 Secret Key，实际产品请勿照搬。]</strong>
      </div>
  </div>
</body>
</html>
