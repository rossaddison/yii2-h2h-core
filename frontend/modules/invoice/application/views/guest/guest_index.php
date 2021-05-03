<?php
  use frontend\modules\invoice\application\components\Utilities;
?>

<div id="headerbar">
    <h1 class="headerbar-title"><?= Utilities::trans('dashboard'); ?></h1>
</div>

<div id="content">

    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Utilities::trans('overdue_invoices'); ?>
        </div>
        <div class="panel-body no-padding">
            <?php echo Yii::$app->controller->renderPartial('partial_invoices_table', ['invoices' => $overdue_invoices,'numberHelper'=>$this->context->numberHelper,'dateHelper'=>$this->context->dateHelper]); ?>
            <?php if ($overdue_invoices) { ?>
                <div class="alert text-success no-margin"><?php Utilities::trans('no_overdue_invoices'); ?></div>
            <?php } ?>

        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading">
            <?= Utilities::trans('open_invoices'); ?>
        </div>

        <div class="panel-body no-padding">
            <?php echo Yii::$app->controller->renderPartial('partial_invoices_table', ['invoices' => $open_invoices,'numberHelper'=>$this->context->numberHelper,'dateHelper'=>$this->context->dateHelper]); ?>
        </div>

    </div>

</div>