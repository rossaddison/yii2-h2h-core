function getGoogle3translateclientticks (){
    var keys = $('#w2').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/google3translateclient/google3translateclient/google3translateclient',
        dataType: "json",
        data: {keylist: keys,
        },
        //success: alert("The following records were translated: " + keys)
        success: $.pjax.reload({container:'#kv-unique-id-43'})    
    });
}

