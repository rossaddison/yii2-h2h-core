<?php 
  use frontend\modules\invoice\application\helpers\CountryHelper;
  use yii\helpers\Html;
?>
<span class="client-address-street-line">
    <?php echo($invoice->customerdetails->productnumber ? Html::encode($invoice->customerdetails->productnumber).str_repeat("&nbsp;", 2).Html::encode($invoice->customerdetails->productsubcategory->name). '<br>' : ''); ?>
</span>
<span class="client-address-street-line">
    <?php echo($invoice->customerdetails->productcategory->name ? Html::encode($invoice->customerdetails->productcategory->name) . '<br>' : ''); ?>
</span>
<span class="client-adress-country-line">
    <?php //echo($client->client_country ? '<br>' . CountryHelper::get_country_name(trans('cldr'), $client->client_country) : ''); ?>
</span>
