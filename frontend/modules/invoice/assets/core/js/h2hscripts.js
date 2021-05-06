function getPaymentprovider () {
    var driver = $('#online-payment-select').val();
    $('.gateway-settings:not(.active-gateway)').addClass('hidden');
    $('#gateway-settings-' + driver).removeClass('hidden').addClass('active-gateway');
};

function getSubmit () {
    $('#form-settings').submit();
    $.pjax.reload({container:'#form-settings'});  
};

function inject_eml_template(template_fields, email_template) {
    $.each(email_template, function (key, val) {
        // remove prefix from key
        key = key.replace("email_template_", "");
        // if key is in template_fields, apply value to form field
        if (val && template_fields.indexOf(key) > -1) {
            if (key === 'body') {
                $("#" + key).html(val);
            } else if (key === 'pdf_template') {
                $("#" + key).val(val).trigger('change');
            } else {
                $("#" + key).val(val);
            }
        }
    });
}

function getCronkey (){     
    $.post({url:'cronkey'}, function (data) {
                $('#cron_key').val(data);
    });        
}

function getTemplate() {
    var e = document.getElementById("email_template");
    var email_template_id = e.options[e.selectedIndex].value;
    var template_fields = ["body", "subject", "from_name", "from_email", "cc", "bcc", "pdf_template"];
    if (email_template_id === '') { $("#body").html('');return;}
    $.post({type:"GET",url:'/invoice/mailer/tencode',dataType:"json",data:{email_template_id:email_template_id}}, function (data) {
                inject_eml_template(template_fields, JSON.parse(data))
    });     
}

function getTogglesmtpsettings(){
    $(function () {
        toggle_smtp_settings();
        $('#email_send_method').change(function () {
            toggle_smtp_settings();
        });
        function toggle_smtp_settings() {
            email_send_method = $('#email_send_method').val();

            if (email_send_method === 'smtp') {
                $('#div-smtp-settings').show();
            } else {
                $('#div-smtp-settings').hide();
            }
        }
    });
}