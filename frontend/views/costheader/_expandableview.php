<?php
use yii\helpers\Html;
?>
<div class="costheader-expandable-view">
    <table border="1" class="table">
    <?php
    use frontend\models\Cost;
    use frontend\models\Costsubcategory;
    use frontend\models\Costcategory;
    $rows = $model->costdetails;
    $names = '';
    foreach ($rows as $key => $value)
    {
        $myvalue = $value['cost_id'];
        $myvalue2 = $value['costsubcategory_id'];
        $myvalue3 = $value['costcategory_id'];
        $name = Cost::find()->where(['id' => $myvalue])->one();
        $subcostname = Costsubcategory::find()->where(['id'=>$myvalue2])->one();
        $costname = Costcategory::find()->where(['id'=>$myvalue3])->one();
        if ($value['paid'] < $value['unit_price']) {
                    $paid_or_unpaid = Yii::t('app','Unpaid');
                    $green_or_red = ['class' => 'btn btn-danger'];} 
                    else {
                    $paid_or_unpaid = Yii::t('app','Paid');    
                    $green_or_red = ['class' => 'btn btn-success'];}
        if (($value['paid'] == 0) && ($value['unit_price'] == 0)) {
                    $paid_or_unpaid = Yii::t('app','Ignore');
                    $green_or_red = '';}  
        echo Html::tag('div',
             Html::tag('tr',
                 '<td >'.
                 $name['description']
                 ."</td><td>". 
                 $subcostname['name']
                 ."</td><td>". 
                 $costname['name']
                 ."</td><td>". 
                 $value['unit_price']
                 ."</td><td>".
                 $value['paid']
                 ."</td><td>". 
                 Html::a($paid_or_unpaid, ['costdetail/pay/'.$value['cost_detail_id']], ['class' => $green_or_red])
              )
            );
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }
    
    ?>
         
    </table>
</div>
