<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\Query;
use kartik\icons\Icon;
use frontend\models\Salesorderheader;
use frontend\models\Company;
use Yii;
?>
<div class="product-expandable-viewinvoice">
<br>
<?php
        //an invoice can only be generated under debt if there is an outstanding amount
        //the invoice icon will not enable if an invoice has not been generated under 'debt'
        //the enabled icon has already prefiltered paid < price under index.php so that there is at least
        //one amount on an invoice outstanding hence invoices
        //and an invoice can only be generated if there are outstanding payments.
        //salesorderdetails rows can include more than one invoice so display separate invoices
        //by using the distinct command as below
        //in query t
        $db=\frontend\components\Utilities::userdb();
        $t = new Query;
        $distinct_invoice_id_list = $t->select('invoice_id')
         ->from('works_salesorderdetail')
        ->andWhere('product_id='.$model->id)
        ->andWhere('unit_price>0.00')
        ->andWhere('invoice_id<>"NULL"')
        //remove repetitive invoice_id's so that the final list only contains invoice_id's as per the select statement
        ->distinct('invoice_id')
        ->all($db); 
        //use the distinct invoice id list now to preview all invoices
        //enable the grid below for summary purposes.
?>

<?php foreach ($distinct_invoice_id_list as $key => $value) { 
   $invoice_id =0;
   $distinctinvoice_id = $distinct_invoice_id_list[$key]['invoice_id'];
   //use this invoice id to retrieve the invoice details through a query
    $u = new Query;
    $invoice_details = $u->select('*')
        ->from('works_salesinvoice')
        ->andWhere('invoice_id='.$distinctinvoice_id)
        ->one($db);
    
    $v = new Query;
    $amount_invoice = $v->select('*')
        ->from('works_salesinvoiceamount')
        ->andWhere('invoice_id='.$distinctinvoice_id)
        ->one($db)    
?>

<div class="container">
    <div id="content">

        <div class="webpreview-header">

            <h2><?php
                   echo "Invoice Number";                     
                ?>
                &nbsp;
                <?php echo $distinctinvoice_id; ?></h2>

        </div>

        <hr>

        <?php echo "Layout alerts"; ?>

        <div class="invoice">
            <?php
             echo "Upload logo.png to images folder and edit product/views/expandableviewinvoice";
             $path = "../images/logo.png";
             echo "<img src='$path' width='10' height='10'><br>";
            ?>
            <br><br>
            
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-5">
                    <h4><?php
                             $company = Company::findOne(1);
                             $url=Url::toRoute(['company/update', 'id'=>$company->id]);
                             echo Html::a(Yii::t('app','Company Address:'), $url,['class' => 'link']);                              
                        ?>
                    </h4>
                    <p> 
                        <?php echo "Street: ".$company->address_street."<br>"; ?>
                        <?php echo "Area: ".$company->address_area1."<br>"; ?>
                        <?php echo "City: ".$company->address_area2."<br>"; ?>
                        <?php echo "Postcode: ". $company->address_areacode."<br>"; ?>
                        <?php echo "Telephone: ". $company->telephone."<br>"; ?>                                                
                    </p>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-xs-12 col-md-6 col-lg-5 text-right">
                    <h4><?php
                             $url=Url::toRoute(['product/update', 'id'=>$model->id]);
                             echo Html::a(Yii::t('app','Customer Address:'), $url,['class' => 'link']);
                        ?>
                    </h4>
                    <p> <?php if (empty($model->name) || (empty($model->surname))) { 
                                    echo "Name and Surname:<br>";
                                   }
                              else {
                                    echo $model->name." ".$model->surname. "<br>";
                              }
                        ?>
                        <?php if (empty($model->productsubcategory->name)) { 
                                    echo "Street: <br>";
                                   }
                              else {
                                    echo $model->productnumber." ".$model->productsubcategory->name. "<br>";
                              }
                        ?>
                        <?php if (empty($model->productcategory->name)) { 
                                    echo "Area: <br>";
                                   }
                              else {
                                    echo $model->productcategory->name. "<br>";   
                              }       
                        ?>
                        <?php if (empty($model->postcodefirsthalf)) { 
                                    echo "Postcode: <br>";
                                   }
                              else {
                                    echo $model->postcodefirsthalf. " ". $model->postcodesecondhalf. "<br>"; 
                              }          
                        ?>           
                                   
                        <?php if (empty($model->email)) { 
                                    echo "Email: <br>";
                                   }
                              else {
                                    //https://fontawesome.com/icons?d=gallery&q=email&s=solid    
                                    //Icon::show('file-invoice', ['framework' => Icon::FAS]),
                                    echo '<button id="w447" class = "btn btn-success" onclick="js:getEmailoccupant()">'.Icon::show('paper-plane', ['framework' => Icon::FAS])." ".$model->email.'</button>';
                                    //echo . "<br>"; 
                              }          
                        ?>       
                    </p>

                    <br>

                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td><?php echo "Invoice date"; ?></td>
                            <td style="text-align:right;">
                                <?php if (!empty($invoice_details['invoice_date_created'])) {
                                        echo $invoice_details['invoice_date_created'];
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
                                <?php if (!empty($invoice_details['invoice_date_due'])) {
                                        echo $invoice_details['invoice_date_due'];
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
                                <?php if (!empty($amount_invoice['invoice_balance'])) {
                                        echo $amount_invoice['invoice_balance'];
                                    }else
                                    {
                                        echo "Invoice balance";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                                <td><?php echo "Payment method"; ?></td>
                                <td><?php
                                        $v = new Query;
                                        $paymentmethods = $v->select('*')
                                        ->from('works_salesinvoicemethodpay')
                                        ->where('payment_method_id='.$invoice_details['payment_method_id'])
                                        ->one();
                                        echo $paymentmethods['payment_method_name']; 
                                     ?>
                                </td>
                        </tr>
                       </tbody>
                    </table>

                </div>
            </div>

            <br>

            <div class="invoice-items">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th><?php echo "Item"; ?></th>
                            <th class="text-right"><?php echo "Quantity"; ?></th>
                            <th class="text-right"><?php echo "Price"; ?></th>
                            <th class="text-right"><?php echo "Total"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sum_unit_price = 0;
                            $sum_paid = 0;
                            $invoice_rows = [];
                            $j = [];
                            //get all salesorderdetails that have the current loop's invoice_id
                            $j = new Query;
                            $invoice_rows = $j->select('*')
                                ->from('works_salesorderdetail')
                                ->andWhere('product_id='.$model->id)
                                ->andWhere('unit_price>0.00')
                                //the salesorderdetail is associated with an invoice after invoice generation
                                ->andWhere('invoice_id='.$distinctinvoice_id)
                                ->all($db);
                            //var_dump("Distinctinvoice_id ".$distinctinvoice_id);
                            //var_dump($invoice_rows);
                            foreach ($invoice_rows as $key => $value) {?>
                            <tr class="bottom-border">
                                
                                <td><?php 
                                     //get the sales order id that belongs to the salesorderdetail and 
                                     //use this to retrieve the sales order date a.k.a daily clean
                                     $getdate_id = $invoice_rows[$key]['sales_order_id']; 
                                     $getdate = Salesorderheader::find()->where(['sales_order_id'=>$getdate_id])->one();
                                     echo "Window Cleaning on ". $getdate['clean_date']; ?></td>
                                <td class="amount text-right"><?php echo "1"; ?></td>
                                <td class="amount text-right"><?php echo $invoice_rows[$key]['unit_price']; ?></td>
                                <td class="amount text-right"><?php echo $invoice_rows[$key]['unit_price']; ?></td>
                            </tr>
                            <?php $sum_unit_price += $invoice_rows[$key]['unit_price']; ?>
                            <?php $sum_paid += $invoice_rows[$key]['paid']; ?>
                        <?php } ?>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-right"><?php echo "Subtotal:"; ?></td>
                            <td class="amount text-right"><?php echo Yii::$app->formatter->asDecimal($sum_unit_price, 2);  ?></td>
                        </tr>

                        <tr>
                            <td class="no-bottom-border" colspan="2"></td>
                            <td class="text-right"><?php echo "Total"; ?>:</td>
                            <td class="amount text-right"><?php echo Yii::$app->formatter->asDecimal($sum_unit_price, 2); ?></td>
                        </tr>

                        <tr>
                            <td class="no-bottom-border" colspan="2"></td>
                            <td class="text-right"><?php echo "Paid:"; ?></td>
                            <td class="amount text-right"><?php echo Yii::$app->formatter->asDecimal($sum_paid, 2); ?></td>
                        </tr>
                        <tr class="overdue">
                            <td class="no-bottom-border" colspan="2"></td>
                            <td class="text-right"><?php echo "Balance:"; ?></td>
                            <td class="amount text-right"><b><?php echo Yii::$app->formatter->asDecimal($sum_unit_price, 2); ?></b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <?php
                    echo '<img src="assets/core/img/paid.png" class="paid-stamp">';
                ?>
                <?php 
                    echo '<img src="assets/core/img/overdue.png" class="overdue-stamp">';
                ?>

            </div><!-- .invoice-items -->

            <hr>

            <div class="row">

                
                    <div class="col-xs-12 col-md-6">
                        <h4><?php echo "Terms"; ?></h4>
                        <p><?php echo "Invoice terms"; ?></p>
                    </div>
                <?php //} ?>

            </div>

        </div><!-- .invoice-items -->
    </div><!-- #content -->
</div>
<?php } ?>
<?php
   //var_dump($rows);
?>
<?php
   //var_dump($distinct_invoice_id_list);
?>
</div>