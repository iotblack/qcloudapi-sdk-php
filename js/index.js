$(function() {

    $("#controller-form").validator();

    var productId  = $('#form_product_id').val();
    var deviceName = $('#form_device_name').val();

    var aj = $.ajax( {
        url:'/get_iot_shadow.php',
        data:{
            productId : productId,
            deviceName : deviceName
        },
        type:'post',
        // cache:false,
        datatype:'json',
        success:function(data) {
            if(data.code == 0 ){
                $('#shadow_container').empty();
                var reported = data.data.state.reported;
                for (var property in reported) {
                    if (reported.hasOwnProperty(property)) {
                        var data_type = typeof reported[property];
                        var ctl_text = '';

                        if (data_type == 'boolean') {
                            var checkstatus = '';
                            if (reported[property]) {
                                checkstatus = 'checked';
                            }

                            ctl_text = 'property<br><label class="switch"><input id="form_sp_property" name="property" data-type="boolean" checkstatus '
                                + 'type="checkbox"> <span class="slider round"></span> </label><br>';
                            ctl_text = ctl_text.replace(/property/g, property).replace(/checkstatus/g, checkstatus);
                        } else if (data_type == 'number') {
                            ctl_text = '<label for="form_sp_' + property + '">'
                                + property + '</label> <input id="form_sp_'
                                + property + '" type="number" name="'
                                + property + '" class="form-control" data-type="'
                                + data_type +'" value="'
                                + reported[property] + '"> ';
                        } else {
                            ctl_text = '<label for="form_sp_' + property + '">'
                                + property + '</label> <input id="form_sp_'
                                + property + '" type="text" name="'
                                + property + '" class="form-control" data-type="'
                                + data_type +'" value="'
                                + reported[property] + '"> ';
                        }
                        $('#shadow_container').append(ctl_text);
                    }
                }

            }else{
                show_update_alert("alert-danger", data.message);
            }
        },
        error : function() {
            show_update_alert("alert-danger", "未知错误。");
        }
    });

    // update iot shadow
    $("#btn_update_iot_shadow").on("click", function(e) {
        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var productId  = $('#form_product_id').val();
            var deviceName = $('#form_device_name').val();
            var shadowObj = {}; 
            shadowObj['desired'] = {};

            $('#shadow-form input, #shadow-form select').each(
                function(index){
                    var input = $(this);
                    if (input.attr('type') == 'button') {
                        return;
                    }
                    //alert('Type: ' + input.attr('type') + 'Name: ' + input.attr('name') + 'Value: ' + input.val());
                    if (input.attr('data-type') == 'boolean') {
                        shadowObj['desired'][input.attr('name')] = input.is(':checked'); 
                    } else if (input.attr('data-type') == 'number') {
                        shadowObj['desired'][input.attr('name')] = Number(input.val()); 
                    } else {
                        shadowObj['desired'][input.attr('name')] = input.val(); 
                    }
                }
            );

            var shadow = JSON.stringify(shadowObj);

            var aj = $.ajax( {
                url:'/update_iot_shadow.php',
                data:{
                    productId : productId,
                    deviceName : deviceName,
                    shadow : shadow,
                },
                type:'post',
                // cache:false,
                datatype:'json',
                success:function(data) {
                    if(data.code == 0 ){
                        show_update_alert("alert-success", "更新成功。");
                    }else{
                        show_update_alert("alert-danger", data.message);
                    }
                },
                error : function() {
                    show_update_alert("alert-danger", "未知错误。");
                }
            });

            return false;
        }
    });

});


function show_update_alert(message_alert, message_text)
{

    // let's compose Bootstrap alert box HTML
    var alert_box =
        '<div class="alert ' +
        message_alert +
        ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
        message_text +
        "</div>";

    // If we have messageAlert and messageText
    if (message_alert && message_text) {
        // inject the alert to .messages div in our form
        $("#box_update_messages").html(alert_box);
    }
}

