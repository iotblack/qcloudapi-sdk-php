<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Bootstrap contact form with validation and AJAX submit</title>
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
        <H2>参数配置</H2> 
        <form id="controller-form" method="post" action="controller.php" role="form"> 
        <div class="controls">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_secret_id">Secret ID *</label>
                <input id="form_secret_id" type="text" name="secret_id" class="form-control" placeholder="Secret ID *" required="required" data-error="请输入 Secret ID">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_secret_key">Secret Key *</label>
                <input id="form_secret_key" type="text" name="secret_key" class="form-control" placeholder="请输入 Secret Key *" required="required" data-error="请输入 Secret Key">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="row">
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
                <label for="form_shadow">影子数据 *</label>
                <textarea id="form_shadow" name="shadow" class="form-control" placeholder='{"reported":{},"desired":{}}' rows="4" data-error=""></textarea>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <input type="button" class="btn btn-success btn-send" value="读取影子" id="btn_get_iot_shadow">
              </div>
              <div class="get_messages"></div> 
             </div>
        </div>
        </form>
      </div>

      </div>
      <div class="col-lg-8 col-lg-offset-2" id='panel_shadow'>
        <form id="shadow-form" method="post" action="" role="form"> 
            <div class="controls">
            <div class="row">

            <div class="col-md-6">
                    <H2>控制面板</H2>
                    <div class="form-group" id='shadow_container' >
                    </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group">
                    <input type="button" class="btn btn-success btn-send" value="更新影子" id="btn_update_iot_shadow">
                    <div class="update_messages"></div> 
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
