<?php
   use frontend\modules\invoice\application\components\Utilities; 
   use frontend\assets\AppAsset;
   use frontend\modules\invoice\assets\CoreCustomCssJsAsset;
   use frontend\modules\invoice\assets\InvoiceThemeNoMonospaceAsset;
   use frontend\modules\invoice\assets\InvoiceThemeMonospaceAsset;   
   use frontend\modules\invoice\application\helpers\InvoiceHelper;
   use frontend\widgets\Alert;
   use kartik\icons\Icon;
   use yii\helpers\Url;
   use yii\helpers\Html;
   use yii\web\View;
   //register style.css
   AppAsset::register($this);
   //register the javascript 
   CoreCustomCssJsAsset::register($this);   
   InvoiceThemeNoMonospaceAsset::register($this);
?>
<?php $this->beginPage(); ?> 
<!DOCTYPE html>
<html class="no-js" lang="<?= Utilities::trans('cldr'); ?>"> 
<head>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.png']); ?>
    <?php $this->registerCsrfMetaTags(); ?>
    <?php $this->head(); ?>
    <title>
        <?php
        if ($this->context->mdl_settings->get_setting('custom_title') != '') {
            echo Html::encode($this->context->mdl_settings->get_setting('custom_title', '', true));
        } else {
            echo Html::encode('Invoice');
        } ?>
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="NOINDEX,NOFOLLOW">    
    <?php if ($this->context->mdl_settings->get_setting('monospace_amounts') == 1) { 
            //use the invoice theme with monospace.css
            InvoiceThemeMonospaceAsset::register($this);
          }
    ?>
    <?php
        $js = <<< 'SCRIPT'
            $('.simple-select').select2();
        SCRIPT;
        $this->registerJs($js);
    ?>
</head>
<body>
<?php $this->beginBody()?>
<nav class="navbar navbar-default ">
    <div class="container">

        <div class="navbar-brand">
            <?= Utilities::trans('online_payment_for_invoice'); ?> #<?php echo $invoice->invoice_id; ?>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="<?= Url::toRoute(['@web/invoice/invoices/pdf','invoice_id'=>$invoice->invoice_id]); ?>">
                    <i class="fa fa-print"></i> <?= Utilities::trans('download_pdf'); ?>
                </a>
            </li>
        </ul>

    </div>
</nav>

<div class="container">

    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            
            <div class="form-group">
                <div class="info">
                    <?=          
                       Alert::widget();
                    ?>
                </div>
            </div>
            
            <br>
            <?php
            $logo = InvoiceHelper::invoice_logo();
            if ($logo) {
                echo '<img src="'.Yii::$app->request->baseUrl.Utilities::getPlaceholderRelativeUrl().InvoiceHelper::invoice_logo().'" height="60" width="60"><br><br>';            }
            ?>           

            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-7">
                            <h4>
                                <?php
                                    echo Html::encode($invoice->customerdetails->name . " " . $invoice->customerdetails->surname);                                   
                                ?>
                            </h4>
                            <div class="client-address">
                                <?php echo Yii::$app->controller->renderPartial('/clients/partial_client_address',['invoice'=>$invoice]); ?>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-5">
                            <div class="hidden-md hidden-lg"><br></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed no-margin">
                                    <tbody>
                                    <tr>
                                        <td><?= Utilities::trans('invoice_date'); ?></td>
                                        <td class="text-right"><?= $this->context->datehelper->date_from_mysql($invoice->invoice_date_created); ?></td>
                                    </tr>
                                    <tr class="<?php echo($is_overdue ? 'overdue' : '') ?>">
                                        <td><?= Utilities::trans('due_date'); ?></td>
                                        <td class="text-right">
                                            <?= $this->context->datehelper->date_from_mysql($invoice->invoice_date_due); ?>
                                        </td>
                                    </tr>
                                    <tr class="<?=($is_overdue ? 'overdue' : '') ?>">
                                        <td><?= Utilities::trans('total'); ?></td>
                                        <td class="text-right"><?= $this->context->numberhelper->format_currency($balance->invoice_total); ?></td>
                                    </tr>
                                    <tr class="<?=($is_overdue ? 'overdue' : '') ?>">
                                        <td><?= Utilities::trans('balance'); ?></td>
                                        <td class="text-right"><?= $this->context->numberhelper->format_currency($balance->invoice_balance); ?></td>
                                    </tr>
                                    <?php if ($payment_method): ?>
                                        <tr>
                                            <td><?= Utilities::trans('payment_method') . ': '; ?></td>
                                            <td class="text-right"><?php echo Html::encode($payment_method->payment_method_name); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                     <?php if (!empty($invoice->reference)): ?>
                                        <tr>
                                            <td><?= Yii::t('app','Your ref:') ?></td>
                                            <td class="text-right"><?php echo Html::encode($invoice->reference); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if (!empty($invoice->invoice_terms)) : ?>
                            <div class="col-xs-12 text-muted">
                                <br>
                                <h4><?= Utilities::trans('terms'); ?></h4>
                                <div><?php echo nl2br(Html::encode($invoice->invoice_terms)); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($disable_form === false) { ?>
                <br>

                <form action="<?= Url::toRoute('@web/invoice/paymenthandler/makepayment'); ?>" method="post" id="payment-information-form">
                    <input type="hidden" name="<?=Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken(); ?>">
                    <div class="form-group">
                        <input type="hidden" name="invoice_url_key"
                               value="<?= $invoice->invoice_url_key; ?>">

                        <label for="gateway-select"><?= Utilities::trans('online_payment_method'); ?>
                        <?php if (empty($available_gateways)) 
                            echo Yii::t('app',':'.str_repeat("&nbsp;", 2).'None'. Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','You can pay by credit card or by BACS: Details in the footer of your invoice.')]));
                        ?>
                        </label>
                        <?php if (!empty($available_gateways)) 
                           //if the payment method is cash the available gateways will be empty
                        { ?>
                        <select name="gateway" id="gateway-select" class="form-control simple-select">
                            <?php
                            // Display all available gateways
                            foreach ($available_gateways as $gateway) { ?>
                                <option value="<?php echo $gateway; ?>">
                                    <?php echo ucwords(str_replace('_', ' ', $gateway)); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <?php }  ?>
                    </div>

                    <br>

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <?= Utilities::trans('creditcard_details'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="alert alert-info no-margin small">
                                    <?= Utilities::trans('online_payment_creditcard_hint'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    <?= Utilities::trans('creditcard_number'); ?>
                                </label>
                                <input type="text" name="creditcard_number" class="input-sm form-control">
                            </div>

                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="control-label">
                                            <?= Utilities::trans('creditcard_expiry_month'); ?>
                                        </label>
                                        <input type="number" name="creditcard_expiry_month"
                                               class="input-sm form-control"
                                               min="1" max="12">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="control-label">
                                            <?= Utilities::trans('creditcard_expiry_year'); ?>
                                        </label>
                                        <input type="number" name="creditcard_expiry_year"
                                               class="input-sm form-control"
                                               min="<?= date('Y'); ?>" max="<?= date('Y') + 20; ?>">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="control-label">
                                            <?= Utilities::trans('creditcard_cvv'); ?>
                                        </label>
                                        <input type="number" name="creditcard_cvv" class="input-sm form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-lg ajax-loader" type="submit">
                            <i class="fa fa-credit-card fa-margin"></i>
                            <?= Utilities::trans('pay_now') . ': ' . $this->context->numberhelper->format_currency($balance->invoice_balance); ?>
                        </button>
                    </div>
                    <br><br>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

<div id="modal-placeholder"></div>

<?php echo Yii::$app->controller->renderPartial('/layouts/includes/fullpage-loader'); ?>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.Utilities::getAssetholderRelativeUrl().'core/js/scripts.min.js',['position' => View::POS_END, 'async'=>true, 'defer'=>true]); ?>
<?php if (Utilities::trans('cldr') != 'en') { 
         $this->registerJsFile(Yii::$app->request->baseUrl.Utilities::getAssetholderRelativeUrl().'core/js/locales/bootstrap-datepicker.'.Utilities::trans('cldr').'.js',['position' => View::POS_END, 'async'=>true, 'defer'=>false]); 
} ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
