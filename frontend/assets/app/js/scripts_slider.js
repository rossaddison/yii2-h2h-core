
function getSlider (){
    var sf = document.getElementById("w88").value;
    $.post({ type: "GET",
             url: '/salesorderheader/slider/',
        dataType: "json",
        data: {sliderfont: sf},
        success: $.pjax.reload({container:'#kv-unique-id-0'})    
    });
}

function getSlidercostheader (){
    var sf = document.getElementById("w673").value;
    $.post({ type: "GET",
             url: '/costheader/slider/',
        dataType: "json",
        data: {sliderfontcostheader: sf},
        success: $.pjax.reload({container:'#kv-unique-id-0'})    
    });
}

function getSlidercostdetail (){
    var sf = document.getElementById("w701").value;
    $.post({ type: "GET",
             url: '/costdetail/slider/',
        dataType: "json",
        data: {sliderfontcostdetail: sf},
        success: $.pjax.reload({container:'#kv-unique-id-1'})    
    });
}


function getSlidersalesdetail (){
    var sf = document.getElementById("w528").value;
    $.post({ type: "GET",
             url: '/salesorderdetail/slider/',
        dataType: "json",
        data: {sliderfontsalesdetail: sf},
        success: $.pjax.reload({container:'#kv-unique-id-1'})    
    });
}

function getSliderproduct (){
    var sf = document.getElementById("w128").value;
    $.post({ type: "GET",
             url: '/product/slider/',
        dataType: "json",
        data: {sliderfontproduct: sf},
        success: $.pjax.reload({container:'#kv-unique-id-7'})    
    });
}

function getSlidercost (){
    var sf = document.getElementById("w928").value;
    $.post({ type: "GET",
             url: '/cost/slider/',
        dataType: "json",
        data: {sliderfontcost: sf},
        success: $.pjax.reload({container:'#kv-unique-id-47'})    
    });
}

function getSliderhistoryline (){
    var sf = document.getElementById("w328").value;
    $.post({ type: "GET",
             url: '/historyline/slider/',
        dataType: "json",
        data: {sliderfonthistoryline: sf},
        success: $.pjax.reload({container:'#kv-unique-id-75'})    
    });
}