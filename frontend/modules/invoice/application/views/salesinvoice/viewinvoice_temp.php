<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\Company;
use frontend\models\Salesorderheader;
use frontend\modules\invoice\application\helpers\InvoiceHelper;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
use frontend\modules\invoice\application\libraries\Lang;
use frontend\modules\invoice\application\components\Utilities;
?>
<img src="../frontend/modules/invoice/uploads/<?php echo InvoiceHelper::invoice_logo();?>" height="60" width="60">
<br>
<br>
<h6>
<?php
    $pdf_invoice_footer = '';
    $company = Company::findOne(1);
    $mdl_settings = new Mdl_settings();
    $mdl_settings->load_settings();
    $language = $mdl_settings->get_setting('default_language');
    $lang = [];
    $lang = new Lang();
    $lang->load('ip', $language);
    $lang->load('gateway', $language);
    $lang->load('custom',$language);
    $lang->load('merchant',$language);
    $lang->load('form_validation',$language);
    $this->currency_spacing();
    $dictionary = $lang->_language;
    $url=Url::toRoute(['company/update', 'id'=>$company->id]);
    echo Html::a(Yii::t('app','Company Address:'), $url,['class' => 'link']);
    if (!empty($mdl_settings->get_setting('pdf_invoice_footer','',false))){
    $pdf_invoice_footer = $mdl_settings->get_setting('pdf_invoice_footer','',false);}
    $sum_unit_price = 0;    
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
            echo Utilities::trans('client_name'). ":".$customerdetails->name." ".$customerdetails->surname."<br>"; 
            echo Utilities::trans('street'). ":".$customerdetails->productnumber." ".$customerdetails->productsubcategory->name."<br>"; 
            echo Utilities::trans('street_address_2'). ":".$customerdetails->productcategory->name."<br>";
            echo Utilities::trans('phone'). ":". $customerdetails->contactmobile."<br>";
            echo Utilities::trans('email_address'). ":". $customerdetails->email."<br>";
    ?>                                                
</p>
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
       echo '<td class="amount text-right">'.$this->before.$details[$key]['unit_price'].$this->after.$this->afterspace.'</td>';
       echo '<td class="amount text-right">'.$details[$key]['order_qty'].$this->afterspace.'</td>';
       echo '<td class="amount text-right">'.$this->before.$details[$key]['unit_price'].$this->after.$this->afterspace.'</td>';
       echo '</tr>';
       $sum_unit_price += $details[$key]['unit_price'];
       $sum_total +=  $details[$key]['paid'];      
   } 
   $invoice_balance = $sum_unit_price - $sum_total;
?>
        <tr>
            <td colspan="2"></td>
            <td class="text-right"><?php echo "Subtotal:"; ?></td>
            <td class="amount text-right"><?php echo $this->before.Yii::$app->formatter->asDecimal($sum_unit_price, 2).$this->after.$this->afterspace;  ?></td>
        </tr>

        <tr>
            <td class="no-bottom-border" colspan="2"></td>
            <td class="text-right"><?php echo "Total"; ?>:</td>
            <td class="amount text-right"><?php echo $this->before.Yii::$app->formatter->asDecimal($sum_unit_price, 2).$this->after.$this->afterspace; ?></td>
        </tr>

        <tr>
            <td class="no-bottom-border" colspan="2"></td>
            <td class="text-right"><?php echo "Paid:"; ?></td>
            <td class="amount text-right"><?php echo $this->before.Yii::$app->formatter->asDecimal($model->salesinvoicetotalpaid, 2).$this->after.$this->afterspace; ?></td>
        </tr>
        <tr class="overdue">
            <td class="no-bottom-border" colspan="2"></td>
            <td class="text-right"><?php echo "Balance:"; ?></td>
            <td class="amount text-right"><b><?php echo $this->before.Yii::$app->formatter->asDecimal($invoice_balance, 2).$this->after.$this->afterspace; ?></b>
            </td>
        </tr>
</tbody>
</table>
<table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td><?php echo "Invoice date"; ?></td>
                            <td style="text-align:right;">
                                <?php if (!empty($model->invoice_date_created)) {
                                        $invoicedatecreated = Yii::$app->formatter->asDate($model->invoice_date_created,'php:d mm Y');
                                        echo $invoicedatecreated;
                                    }else
                                    {
                                        echo "Invoice date created"; 
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo "Due date"; ?></td>
                            <td class="text-right">
                                <?php if (!empty($model->invoice_date_due)) {
                                        $invoicedatedue = Yii::$app->formatter->asDate($model->invoice_date_due,'php:d mm Y');
                                        echo$invoicedatedue;
                                    }else
                                    {
                                        echo "Invoice date due";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo "Amount due"; ?></td>
                            <td style="text-align:right;">
                                <?php if (!empty($model->salesinvoiceamount->invoice_balance)) {
                                        echo $this->before.$model->salesinvoiceamount->invoice_balance.$this->after.$this->afterspace;
                                    }else
                                    {
                                        echo "Invoice balance";
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

<h6><?php echo "Invoice Terms:"; ?></h6>
<h6><?php
        if (!empty($this->mdl_settings->get_setting('default_invoice_terms','',false))) {
          echo $this->mdl_settings->get_setting('default_invoice_terms','',false); 
         }
     ?>
</h6>
<br>
<p><?php
       $days = $this->mdl_settings->get_setting('invoice_due_after','',false);
       if (!empty($days)) {          
          echo "Payment is due after ". $days. " days"; 
       }
       else 
          echo "Payment is due."
?></p>
<br>
<p>
    <?php echo $pdf_invoice_footer; ?>
</p>


