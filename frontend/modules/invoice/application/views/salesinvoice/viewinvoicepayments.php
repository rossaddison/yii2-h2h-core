<?php
use yii\helpers\Url;
use kartik\icons\Icon;
use yii\helpers\Html;
use frontend\models\Salesorderheader;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
?>
<br>
<h6>
<?php
    $sum_unit_price = 0;
    $mdl_settings = new Mdl_settings();
    $mdl_settings->load_settings();
    $sum_unit_price = 0;
    $after = '';$before='';$afterspace = '';$currency_symbol='';$currency_symbol_placement='';
    $currency_symbol = $mdl_settings->get_setting('currency_symbol','',false);
    $currency_symbol_placement = $mdl_settings->get_setting('currency_symbol_placement','',false);
    if ($currency_symbol_placement === 'before'){ $before = $currency_symbol;}else $before = '';
    if ($currency_symbol_placement === 'after'){ $after = $currency_symbol;}else $after = '';
    if ($currency_symbol_placement === 'afterspace'){ $afterspace = '&nbsp'.$currency_symbol;}else $afterspace = '';
?>
</h6>
<h6>
   <?php
            $customerdetails = $model->customerdetails;
            $url=Url::toRoute(['product/view', 'id'=>$customerdetails->id]);
            echo Html::a(Yii::t('app','Customer Address:'), $url,['class' => 'link']); 
   ?>
</h6>
<p> 
    <?php   
            echo "Name: ".$customerdetails->name." ".$customerdetails->surname."<br>"; 
            echo "Street: ".$customerdetails->productnumber." ".$customerdetails->productsubcategory->name."<br>"; 
            echo "Area: ".$customerdetails->productcategory->name."<br>";
            echo "Telephone: ". $customerdetails->contactmobile."<br>";
            echo "Email: ". $customerdetails->email."<br>";
    ?>                                                
</p>
<br>
<table class="table table-striped table-bordered table-condensed">
<tbody>   
<?php
  $details = $model->salesorderdetails;
  echo '<thead><tr><th>Description</th><th class="text-right">SOD ID</th><th class="text-right">Payment ID</th><th class="text-right">Unit Price</th><th class="text-right">Paid</th></tr></thead>';
  $sum_unit_price = 0;
  $sum_total = 0;
  foreach ( $details as $key => $value)
   {
       $getdate_id = $details[$key]['sales_order_id']; 
       $getdate = Salesorderheader::find()->where(['sales_order_id'=>$getdate_id])->one();
       echo '<tr class="bottom-border">';
       $cleandate = Yii::$app->formatter->asDate($getdate['clean_date'],'php:d-m-Y');
       echo '<td>Window Cleaning on '.$cleandate.'</td>'; 
       echo '<td class="amount text-right">'.Html::a($details[$key]['sales_order_detail_id'],Url::to(['@web/salesorderdetail/view','id'=>$details[$key]['sales_order_detail_id']])).'</td>';
       
       if (empty($details[$key]['payment_id'])) {
         echo '<td class="amount text-right">'.Html::a(Yii::t('app','Assign householder to Online Payer'),Url::to(['@web/product/index'])).$after.$afterspace.'</td>';     
       }
       else 
       {
         echo '<td class="amount text-right">'.Html::a($details[$key]['payment_id'],Url::to(['@web/invoice/salesinvoicepayment/view','id'=>$details[$key]['payment_id']])).'</td>';
       }
       
       echo '<td class="amount text-right">'.$before.$details[$key]['unit_price'].$after.$afterspace.'</td>';
       echo '<td class="amount text-right">'.$before.$details[$key]['paid'].$after.$afterspace.'</td>';
       echo '</tr>';
       $sum_unit_price += $details[$key]['unit_price'];
       $sum_total +=  $details[$key]['paid'];      
   } 
   $invoice_balance = $sum_unit_price - $sum_total;
?>
</tbody>
</table>
<table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td><?php echo "Amount due"; ?></td>
                            <td style="text-align:right;">
                                <?php if (!empty($model->salesinvoiceamount->invoice_balance)) {
                                        echo $before.$model->salesinvoiceamount->invoice_balance.$after.$afterspace;
                                    }else
                                    {
                                        echo "Invoice balance";
                                    }
                                ?>
                            </td>
                        </tr>
                       </tbody>
</table>


