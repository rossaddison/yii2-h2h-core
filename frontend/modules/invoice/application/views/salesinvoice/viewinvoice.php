<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\Company;
use frontend\models\Salesorderheader;
use frontend\modules\invoice\application\helpers\InvoiceHelper;
use frontend\modules\invoice\application\components\Utilities;
?>
<img src="../frontend/modules/invoice/uploads/<?php echo InvoiceHelper::invoice_logo();?>" height="60" width="60">
<br>
<br>
<h6>
<?php
    $pdf_invoice_footer = '';
    $company = Company::findOne(1);
    $url=Url::toRoute(['company/update', 'id'=>$company->id]);
    echo Html::a(Yii::t('app','Company Address:'), $url,['class' => 'link']);
    if (!empty($this->context->mdl_settings->get_setting('pdf_invoice_footer','',false))){
    $pdf_invoice_footer = $this->context->mdl_settings->get_setting('pdf_invoice_footer','',false);}
    $sum_unit_price = 0;
    $after = '';$before='';$afterspace = '';$currency_symbol='';$currency_symbol_placement='';
    $currency_symbol = $this->context->mdl_settings->get_setting('currency_symbol','',false);
    $currency_symbol_placement = $this->context->mdl_settings->get_setting('currency_symbol_placement','',false);
    if ($currency_symbol_placement === 'before'){ $before = $currency_symbol;}else $before = '';
    if ($currency_symbol_placement === 'after'){ $after = $currency_symbol;}else $after = '';
    if ($currency_symbol_placement === 'afterspace'){ $afterspace = " ".$currency_symbol;}else $afterspace = "";
?>
</h6>
<p> 
    <?php   
            echo "Street: ".$company->address_street."<br>"; 
            echo "Area: ".$company->address_area1."<br>"; 
            echo "City: ".$company->address_area2."<br>"; 
            echo "Postcode: ". $company->address_areacode."<br>"; 
            echo "Telephone: ". $company->telephone."<br>"; 
    ?>                                                
</p>
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
<h4>
    <?php
        if (!empty($model->reference)){
            $invoiceref = $model->reference;
            echo "Ref: ".$invoiceref;
        }    
    ?>    
</h4>
<h6>
    <?php
            $invoicedate = Yii::$app->formatter->asDate($model->invoice_date_created,'php:d mm Y');
            echo $invoicedate;
    ?>    
</h6>
<br>
<table class="table table-striped table-bordered table-condensed">
<tbody>   
<?php
  $details = $model->salesorderdetails;
  echo '<thead><tr><th>Description</th><th class="text-right">Unit Price</th><th class="text-right">Order Quantity</th><th class="text-right">Subtotal</th></tr></thead>';
  $sum_unit_price = 0;
  $sum_total = 0;
  foreach ( $details as $key => $value)
   {
       $getdate_id = $details[$key]['sales_order_id']; 
       $getdate = Salesorderheader::find()->where(['sales_order_id'=>$getdate_id])->one();
       echo '<tr class="bottom-border">';
       $cleandate = Yii::$app->formatter->asDate($getdate['clean_date'],'php:d-m-Y');
       echo '<td>Window Cleaning on '.$cleandate.'</td>';
       echo '<td class="amount text-right">'.$before.$details[$key]['unit_price'].$after.$afterspace.'</td>';
       echo '<td class="amount text-right">'.$details[$key]['order_qty'].$afterspace.'</td>';
       echo '<td class="amount text-right">'.$before.$details[$key]['unit_price'].$after.$afterspace.'</td>';
       echo '</tr>';
       $sum_unit_price += $details[$key]['unit_price'];
       $sum_total +=  $details[$key]['paid'];      
   } 
   $invoice_balance = $sum_unit_price - $sum_total;
?>
        <tr>
            <td colspan="2"></td>
            <td class="text-right"><?= Utilities::trans('subtotal'); ?></td>
            <td class="amount text-right"><?php echo $before.Yii::$app->formatter->asDecimal($sum_unit_price, 2).$after.$afterspace;  ?></td>
        </tr>

        <tr>
            <td class="no-bottom-border" colspan="2"></td>
            <td class="text-right"><?= Utilities::trans('total'); ?>:</td>
            <td class="amount text-right"><?php echo $before.Yii::$app->formatter->asDecimal($sum_unit_price, 2).$after.$afterspace; ?></td>
        </tr>

        <tr>
            <td class="no-bottom-border" colspan="2"></td>
            <td class="text-right"><?= Utilities::trans('paid'); ?></td>
            <td class="amount text-right"><?php echo $before.Yii::$app->formatter->asDecimal($model->salesinvoicetotalpaid, 2).$after.$afterspace; ?></td>
        </tr>
        <tr class="overdue">
            <td class="no-bottom-border" colspan="2"></td>
            <td class="text-right"><?= Utilities::trans('balance'); ?></td>
            <td class="amount text-right"><b><?php echo $before.Yii::$app->formatter->asDecimal($invoice_balance, 2).$after.$afterspace; ?></b>
            </td>
        </tr>
</tbody>
</table>
<table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td><?= Utilities::trans('invoice_date'); ?></td>
                            <td style="text-align:right;">
                                <?php if (!empty($model->invoice_date_created)) {
                                        $invoicedatecreated = Yii::$app->formatter->asDate($model->invoice_date_created,'php:d mm Y');
                                        echo $invoicedatecreated;
                                    }else
                                    {
                                        echo Utilities::trans('invoice_date'); 
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?= Utilities::trans('date_due'); ?></td>
                            <td class="text-right">
                                <?php if (!empty($model->invoice_date_due)) {
                                        $invoicedatedue = Yii::$app->formatter->asDate($model->invoice_date_due,'php:d mm Y');
                                        echo$invoicedatedue;
                                    }else
                                    {
                                        echo Utilities::trans('date_due');
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?= Utilities::trans('amount_due'); ?></td>
                            <td style="text-align:right;">
                                <?php if (!empty($model->salesinvoiceamount->invoice_balance)) {
                                        echo $before.$model->salesinvoiceamount->invoice_balance.$after.$afterspace;
                                    }else
                                    {
                                        echo Utilities::trans('amount_due');
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                                <td><?php echo "Payment method"; ?></td>
                                <td style="text-align:right;">
                                    <?php
                                        echo $model->paymentmethod->payment_method_name;
                                     ?>                                    
                                </td>
                        </tr>
                       </tbody>
</table>

<h6><?= Utilities::trans('terms'); ?></h6>
<h6>
    <?php if ($model->invoice_terms) : ?>
        <div class="notes">
            <b><?php Utilities::trans('terms'); ?></b><br/>
            <?php echo nl2br(Html::encode($model->invoice_terms)); ?>
        </div>
    <?php endif; ?>
</h6>
<p>
    <?php echo $pdf_invoice_footer; ?>
</p>


