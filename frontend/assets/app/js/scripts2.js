function getKeys (){
    var keys = $('#w1').yiiGridView('getSelectedRows'); 
    var e = document.getElementById("w9");
    //the sales order id value of the date selected in dropdownlist
    var value = e.options[e.selectedIndex].value;
    $.post({ type: "GET",
             url: '/product/doit/',
        dataType: "json",
        data: {keylist: keys,
               sorder: value
               //salesorder: sord
        },
        success: alert("The following records were copied: " + keys)
    });
}

function getKeyscost (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    var e = document.getElementById("w59");
    //the cost header id value of the date selected in dropdownlist
    var value = e.options[e.selectedIndex].value;
    $.post({ type: "GET",
             url: '/cost/doit/',
        dataType: "json",
        data: {keylist: keys,
               ccost: value
               //salesorder: sord
        },
        success: alert("The following records were copied: " + keys)
    });
}


function getYearmonth (){
    var e = document.getElementById("w89");
    var f = document.getElementById("w79");
    //the sales order id value of the date selected in dropdownlist
    var value1 = e.options[e.selectedIndex].value;
    var value2 = f.options[f.selectedIndex].value;
    $.post({ type: "GET",
             url: '/salesorderheader/totalmonthlyrevenue/',
        dataType: "json",
        data: {sordermonth: value1,
               sorderyear: value2
               //salesorder: sord
        },
        //success: $.pjax.reload({container:'#kv-unique-id-0'})
        success: location.reload(true)
    });

}

function getYearsrevenue (){
    var g = document.getElementById("w467");
    var value = g.options[g.selectedIndex].value;
    $.post({ type: "GET",
             url: '/salesorderheader/totalannualrevenue/',
        dataType: "json",
        data: {sorderyear2: value
        },
        success: $.pjax.reload({container:'#kv-unique-id-0'})
    });

}

function getYearmonthcost (){
    var e = document.getElementById("w189");
    var f = document.getElementById("w179");
    //the sales order id value of the date selected in dropdownlist
    var value1 = e.options[e.selectedIndex].value;
    var value2 = f.options[f.selectedIndex].value;
    $.post({ type: "GET",
             url: '/costheader/totalmonthlyexpenditure/',
             
        dataType: "json",
        data: {costmonth: value1,
               costyear: value2
               //salesorder: sord
        },
        success: $.pjax.reload({container:'#kv-unique-id-0'})
        //success: alert("Refresh page")
        //success: location.reload(true)
    });
    
}

function getCreategocardlesscustomer (){
    var keys = $('#w1').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/product/creategocardlesscustomer/',
        dataType: "json",
        data: {keylist: keys,
               
        },
        success: alert("Sending emails to:  " + keys)
    });  

}

function getRequestgocardlesspayment (){
    var keys = $('#w1').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/product/requestpayment/',
        dataType: "json",
        data: {keylist: keys,
               
        },
        success: alert("Sending payment request to: " + keys)
    });  

}

function getPaidticks (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/salesorderdetail/paidticked/',
        dataType: "json",
        data: {keylist: keys
                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-1'})        
    });

}

function getUnpaidticks (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/salesorderdetail/unpaidticked/',
        dataType: "json",
        data: {keylist: keys
                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-1'})
    });

}

function getPaidcostticks (){
    var keys = $('#w1').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/costdetail/paidticked/',
        dataType: "json",
        data: {keylist: keys
                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-1'})        
    });

}

function getUnpaidcostticks (){
    var keys = $('#w1').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/costdetail/unpaidticked/',
        dataType: "json",
        data: {keylist: keys
                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-1'})
    });

}

function getDeleteticks (){
    var keys = $('#w1').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/salesorderdetail/deleteticked/',
        dataType: "json",
        data: {keylist: keys                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-1'}) 
        
    });

}

function getDeletecostticks (){
    var keys = $('#w1').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/costdetail/deleteticked/',
        dataType: "json",
        data: {keylist: keys                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-1'}) 
        
    });

}

function getCleanedticks (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/salesorderdetail/cleanedticked/',
        dataType: "json",
        data: {keylist: keys
                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-1'})        
    });

}



function getNotcleanedticks (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/salesorderdetail/notcleanedticked/',
        dataType: "json",
        data: {keylist: keys
                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-1'})        
    });

}



function getMissedticks (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    
    $.post({ type: "GET",
             url: '/salesorderdetail/missedticked/',
        dataType: "json",
        data: {keylist: keys},
        success: $.pjax.reload({container:'#kv-unique-id-1'})        
    });
}

function getAddpretopaid (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/salesorderdetail/addpretopaidticked/',
        dataType: "json",
        data: {keylist: keys},
        success: $.pjax.reload({container:'#kv-unique-id-1'})        
    });
}

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

function getTransferticks (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    var m = document.getElementById("w61");
    //the sales order id value of the date selected in dropdownlist
    var value = m.options[m.selectedIndex].value;
    $.post({ type: "GET",
             url: '/salesorderdetail/transferticked/',
        dataType: "json",
        data: {keylist: keys,transadv: value},
        //success: alert("The following records were copied: " + value)
        success: $.pjax.reload({container:'#kv-unique-id-1'}) 
    });

}

function getCopyitbybimonthly (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/salesorderheader/copyticked/4',
        dataType: "json",
        data: {keylist: keys,          
        },
        success: $.pjax.reload({container:'#kv-unique-id-0'}) 
    });
}


function getCopyitbyfrequency (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/salesorderheader/copyticked/2',
        dataType: "json",
        data: {keylist: keys,          
        },
        success: $.pjax.reload({container:'#kv-unique-id-0'}) 
    });
}


function getCopyitbyfortnight (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/salesorderheader/copyticked/3',
        dataType: "json",
        data: {keylist: keys,          
        },
        success: $.pjax.reload({container:'#kv-unique-id-0'}) 
    });
}

function getCopyitbyweek (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/salesorderheader/copyticked/5',
        dataType: "json",
        data: {keylist: keys,          
        },
        success: $.pjax.reload({container:'#kv-unique-id-0'}) 
    });
 }

function getCopyitbytodaysdate (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/salesorderheader/copyticked/1',
        dataType: "json",
        data: {keylist: keys,          
        },
        success: $.pjax.reload({container:'#kv-unique-id-0'}) 
    });
}

function getCopyitbytodaysdatesalesorderdetail (){
    $.post({ type: "GET",
             url: '/salesorderheader/copyticked/1',
        dataType: "json",
        success: alert("Created!")  
    });
}

function getCopyitbyfrequencysalesorderdetail (){
    $.post({ type: "GET",
             url: '/salesorderheader/copyticked/2',
        dataType: "json",
         success: alert("Created!")  
    });
}


function getCopycostitbytodaysdate (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/costheader/copyticked/1',
        dataType: "json",
        data: {keylist: keys,          
        },
        success: $.pjax.reload({container:'#kv-unique-id-0'}) 
    });
}

function getCopycostitbyfrequency (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/costheader/copyticked/2',
        dataType: "json",
        data: {keylist: keys,          
        },
        success: $.pjax.reload({container:'#kv-unique-id-0'}) 
    });
}

function getSitemessage (){
    var cfn = document.getElementsByName("custname")[0].value;
    var cml = document.getElementsByName("custtel")[0].value;
    $.post({ type: "GET",
             url: '/site/sitemessage/',
        dataType: "json",
        data: {custfirstname: cfn, custmobile: cml},          
        success: alert("Text sent! Thank you " + cfn)  
    });
}


function getPaidall (){
    var keys = $('#w333').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/salesorderdetail/paidticked/',
        dataType: "json",
        data: {keylist: keys                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-5'})  
    });
}

//product/_expendableviewdebtsheet
function getPaidallowing (){
    var keys = $('#w1').yiiGridView('getSelectedRows'); 
    $.post({ type: "GET",
             url: '/product/paidticked/',
        dataType: "json",
        data: {keylist: keys                                    
        },
        success: $.pjax.reload({container:'#kv-unique-id-7'})   
    });

}

function getProcessticked (){
    var keys = $('#w0').yiiGridView('getSelectedRows'); 
    var d = document.getElementById("cat_id");
    var e = document.getElementById("subcat_id");
    var value1 = d.options[d.selectedIndex].value;
    var value = e.options[e.selectedIndex].value;
    $.post({ type: "GET",
             url: '/importhouses/process/',
        dataType: "json",
        data: {keylist: keys,
               productcategory_id: value1,
               productsubcategory_id: value
        },
       success: alert("The following file ID was copied: " + keys) 
    });

}
