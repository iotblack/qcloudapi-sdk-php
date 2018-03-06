<?php
$product_id=$_GET['product_id'];
$device_name=$_GET['device_name'];
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
      <div class="col-lg-8 col-lg-offset-2" id='panel_shadow'>
        <form id="shadow-form" method="post" action="" role="form"> 
            <div class="controls">
            <div class="row">
            <div class="col-md-12">
                    <strong>控制面板</strong>
                    <div class="form-group" id='shadow_container' >
                    </div>
            </div>
            <div class="col-md-12">
                    <div class="form-group">
                    <input id="form_product_id" type="hidden" name="product_id" value="<?php echo $product_id;?>">
                    <input id="form_device_name" type="hidden" name="device_name" value="<?php echo $device_name;?>">

                    <input type="button" class="btn btn-success btn-send" value="提交" id="btn_update_iot_shadow">
                    <div class="update_messages" id="box_update_messages"></div> 
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                    <p class="text-muted">演示页面</p>
                    </div>
                    </div>
            </div>
            </div>
        </form>

      </div>

    </div>

  </div>
</body>
</html>
