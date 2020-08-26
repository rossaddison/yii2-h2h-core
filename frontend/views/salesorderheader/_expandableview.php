<?php
use yii\helpers\Html;
use frontend\models\Product;
use frontend\models\Productsubcategory;
use frontend\models\Productcategory;
use frontend\models\Company;
use \supplyhog\ClipboardJs\ClipboardJsWidget;
use Yii;
?>
<div class="salesorderheader-expandable-view">
    <table border="0" class="table transparent">
    <?php
    $rows = $model->salesorderdetails;
    $names = '';
    foreach ($rows as $key => $value)
    {
        $myvalue = $value['product_id'];
        $myvalue2 = $value['productsubcategory_id'];
        $myvalue3 = $value['productcategory_id'];
        $name = Product::find()->where(['id' => $myvalue])->one();
        $streetname = Productsubcategory::find()->where(['id'=>$myvalue2])->one();
        $postalcodename = Productcategory::find()->where(['id'=>$myvalue3])->one();
        $url = "tel:/".$name['contactmobile'];
        $url2 = "https://maps.google.com/maps?q=".ltrim($name['productnumber'], '0')." ".$streetname['name']." ".$postalcodename['name'];
        $url3 = ltrim($name['productnumber'], '0')." ".$streetname['name']." ".$postalcodename['name'];
        $url4 = "tel:/".preg_replace("/[^0-9]/", "",Company::findOne(1)->telephone);
        if ($value['paid'] < $value['unit_price']) {
                    $paid_or_unpaid = Yii::t('app','Unpaid');
                    $green_or_red = 'btn btn-danger btn-lg';} 
                    else {
                    $paid_or_unpaid = Yii::t('app','Paid');    
                    $green_or_red = 'btn btn-success btn-lg';}
        if (($value['paid'] == 0) && ($value['unit_price'] == 0)) {
                    $paid_or_unpaid = Yii::t('app','Ignore');
                    $green_or_red = "";}             
        if ((strlen($name['contactmobile'])<>11) || ($name['contactmobile'] == '07777777777'))
        {$button_or_nobutton = ['class' => 'btn btn-danger btn-lg'];
            $ifmobile = Yii::t('app','No mobile number');
            $url=['product/view/?id='.$myvalue];
        }else {$button_or_nobutton = ['class' => 'btn btn-info btn-lg'];
                               $ifmobile = $name['contactmobile'];}
        if (Yii::$app->user->can('See Prices')) {                      
             echo Html::tag('div',
             Html::tag('tr',
                 '<td >'.
                 $name['name']
                 ."</td><td>". 
                 $name['surname']
                 ."</td><td>". 
                 Html::a($ifmobile,$url,$button_or_nobutton)
                 ."</td><td>". 
                 Html::a($url3,$url2,['class' => 'btn btn-success btn-lg','data-toggle'=>'tooltip','title'=>Yii::t('app','Goto Google maps using this address.')])                 
                 ."</td><td>".
                 ClipboardJsWidget::widget([
                     'text' => $url3,
                     'label' => Yii::t('app','Copy address to clipboard'),
                     'htmlOptions' => ['class' => 'btn btn-lg'],
                     'tag' => 'button',
                 ])  
                 ."</td><td>".
                 Html::a(preg_replace("/[^0-9]/", "",Company::findOne(1)->telephone),$url4,['class' => 'btn btn-warning btn-lg','data-toggle'=>'tooltip','title'=>Yii::t('app','Telephone number of Boss obtained from Other ... Company settings...telephone.')])                 
                 ."</td><td>".
                 $value['unit_price']
                 ."</td><td>".
                 $value['paid']
                 ."</td><td>". 
                 Html::a($paid_or_unpaid, ['salesorderdetail/pay/'.$value['sales_order_detail_id']], ['class' => $green_or_red,'data-toggle'=>'tooltip','title'=>'Switch to paid or unpaid'])
              )
            );
        } else
        {
           echo Html::tag('div',
             Html::tag('tr',
                 '<td >'.
                 $name['name']
                 ."</td><td>". 
                 $name['surname']
                 ."</td><td>".
                 Html::a($url3,$url2,['class' => 'btn btn-success btn-lg','data-toggle'=>'tooltip','title'=>Yii::t('app','Goto Google maps using this address.')])                 
                 ."</td><td>".
                 ClipboardJsWidget::widget([
                     'text' => $url3,
                     'label' => Yii::t('app','Copy address to clipboard'),
                     'htmlOptions' => ['class' => 'btn btn-lg'],
                     'tag' => 'button',
                 ])  
                 ."</td><td>".
                 Html::a(preg_replace("/[^0-9]/", "",Company::findOne(1)->telephone),$url4,['class' => 'btn btn-warning btn-lg','data-toggle'=>'tooltip','title'=>'Telephone number of Boss obtained from Other ... Company ...telephone.']) 
              ) //html tag tr
            ); //html tag div 
        } //else
    } //foreach
    ?>
    </table>
</div>
