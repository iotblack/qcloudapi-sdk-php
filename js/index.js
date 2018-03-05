$(function() {

    $("#controller-form").validator();

    // get iot shadow
    $("#btn_get_iot_shadow").on("click", function(e) {
        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = "controller.php";
            var messageAlert = "alert-success";
            var messageText = "请求成功。";

            // let's compose Bootstrap alert box HTML
            var alertBox =
                '<div class="alert ' +
                messageAlert +
                ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                messageText +
                "</div>";

            // If we have messageAlert and messageText
            if (messageAlert && messageText) {
                // inject the alert to .messages div in our form
                $("#controller-form").find(".messages").html(alertBox);
            }

            var secretid = $('#form_secret_id').val();
            var secretkey  = $('#form_secret_key').val();
            var productId  = $('#form_product_id').val();
            var deviceName = $('#form_device_name').val();

            var aj = $.ajax( {
                url:'/get_iot_shadow.php',
                data:{
                    secretid :  secretid,
                    secretkey : secretkey, 
                    productId : productId, 
                    deviceName : deviceName
                },
                type:'post',
                // cache:false,
                datatype:'json',
                success:function(data) {
                    if(data.code == 0 ){
                        // alert("读取成功！");
                        $('#form_shadow').val(JSON.stringify(data.data.state));
                    }else{
                        alert(data.message);
                    }
                },
                error : function() {
                    // view("异常！");
                    alert("异常！");
                }
            });

            return false;
        }
    });

    // update iot shadow
    $("#btn_update_iot_shadow").on("click", function(e) {
        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = "controller.php";

            var messageAlert = "alert-success";
            var messageText = "请求成功。";

            // let's compose Bootstrap alert box HTML
            var alertBox =
                '<div class="alert ' +
                messageAlert +
                ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                messageText +
                "</div>";

            // If we have messageAlert and messageText
            if (messageAlert && messageText) {
                // inject the alert to .messages div in our form
                $("#controller-form").find(".messages").html(alertBox);
            }

            var secretid = $('#form_secret_id').val();
            var secretkey  = $('#form_secret_key').val();
            var productId  = $('#form_product_id').val();
            var deviceName = $('#form_device_name').val();
            var shadow = $('#form_shadow').val();

            var aj = $.ajax( {
                url:'/update_iot_shadow.php',
                data:{
                    secretid :  secretid,
                    secretkey : secretkey, 
                    productId : productId, 
                    deviceName : deviceName,
                    shadow : shadow,
                },
                type:'post',
                // cache:false,
                datatype:'json',
                success:function(data) {
                    if(data.code == 0 ){
                        alert("更新成功！");
                        // $('#form_shadow').val(JSON.stringify(data.data.state));
                    }else{
                        alert(data.message);
                    }
                },
                error : function() {
                    // view("异常！");
                    alert("异常！");
                }
            });

            return false;
        }
    });

});
