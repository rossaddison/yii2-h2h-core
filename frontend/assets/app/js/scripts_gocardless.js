function getGocardlesspayticks (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/salesorderdetail/takeoneoffpayment/',
        dataType: "json",
        data: {keylist: keys,               
        },
        success: alert("The following Gocardless customer was sent a one-off advance payment requests:" + keys)
    });  
}