<?php
   //use frontend\modules\invoice\application\libraries\Sumex;
   use frontend\modules\invoice\application\components\Utilities;
   use yii\helpers\ArrayHelper;
   use yii\helpers\Html;
   use kartik\icons\Icon;
   use kartik\widgets\FileInput;
?>

<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Utilities::trans('invoices');  ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="settings[default_invoice_terms]">
                                <?= Utilities::trans('default_terms');  ?>
                            </label>
                            <textarea name="settings[default_invoice_terms]" id="settings[default_invoice_terms]"
                                class="form-control" rows="4"
                                ><?php echo $mdl_settings->get_setting('default_invoice_terms'); ?></textarea>
                        </div>

                    </div>
                    <div class="col-xs-12 col-md-6">

                        <div class="form-group">
                            <label for="settings[invoice_default_payment_method]">
                                <?= Utilities::trans('default_payment_method');  ?>
                            </label>
                            <select name="settings[invoice_default_payment_method]" class="form-control simple-select"
                                id="settings[invoice_default_payment_method]" data-minimum-results-for-search="Infinity">
                                <option value=""><?= Utilities::trans('none');  ?></option>
                                <?php
                                foreach ($payment_methods as $payment_method) { ?>
                                    <option value="<?php echo $payment_method->payment_method_id; ?>"
                                        <?php $mdl_settings->check_select($payment_method->payment_method_id, $mdl_settings->get_setting('invoice_default_payment_method')) ?>>
                                        <?php echo $payment_method->payment_method_name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="settings[invoices_due_after]">
                                <?= Utilities::trans('invoices_due_after');  ?>
                            </label>
                            <input type="number" name="settings[invoices_due_after]" id="settings[invoices_due_after]"
                                class="form-control" value="<?php echo $mdl_settings->get_setting('invoices_due_after'); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Utilities::trans('other_settings'); ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">

                        <div class="form-group">
                            <label for="settings[read_only_toggle]">
                                <?= Utilities::trans('set_to_read_only').str_repeat("&nbsp;", 2). Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','Toggle to prevent the invoice from being updated once it has been sent, viewed, or paid.')]); ?>
                            </label>
                            <select name="settings[read_only_toggle]" id="settings[read_only_toggle]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option value="2" <?php $mdl_settings->check_select($mdl_settings->get_setting('read_only_toggle'), '2'); ?>>
                                    <?= Utilities::trans('sent'); ?>
                                </option>
                                <option value="3" <?php $mdl_settings->check_select($mdl_settings->get_setting('read_only_toggle'), '3'); ?>>
                                    <?= Utilities::trans('viewed'); ?>
                                </option>
                                <option value="4" <?php $mdl_settings->check_select($mdl_settings->get_setting('read_only_toggle'), '4'); ?>>
                                    <?= Utilities::trans('paid'); ?>
                                </option>
                            </select>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Utilities::trans('pdf_settings'); ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">

                        <div class="form-group">
                            <label for="settings[mark_invoices_sent_pdf]">
                                <?= Utilities::trans('mark_invoices_sent_pdf').str_repeat("&nbsp;", 2). Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','Customers can only view invoices online that are marked as sent. Pdf archiving occurs automatically when emailing and invoices are automatically marked as sent. If we choose not to email, by default, invoices must still be marked as sent so they can be viewed by customers. So instead of emailing them, just archive them by pdf generation via Sales Invoices and the user will be able to view them online. This setting should be set to No if emailing is the default.')]); ?>
                            </label>
                            <select name="settings[mark_invoices_sent_pdf]" id="settings[mark_invoices_sent_pdf]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option value="0">
                                    <?= Utilities::trans('no'); ?>
                                </option>
                                <option value="1" <?php $mdl_settings->check_select($mdl_settings->get_setting('mark_invoices_sent_pdf'), '1'); ?>>
                                    <?= Utilities::trans('yes'); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">

                        <div class="form-group">
                            <label for="settings[pdf_watermark]">
                                <?= Utilities::trans('pdf_watermark'); ?>
                            </label>
                            <select name="settings[pdf_watermark]" id="settings[pdf_watermark]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option value="0">
                                    <?= Utilities::trans('no'); ?>
                                </option>
                                <option value="1" <?php $mdl_settings->check_select($mdl_settings->get_setting('pdf_watermark'), '1'); ?>>
                                    <?= Utilities::trans('yes'); ?>
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= Utilities::trans('invoice_logo'); ?><?= str_repeat("&nbsp;", 2) ?><?= '*.jpg,jpeg,gif,png' ?></label>
                            <?php if ($mdl_settings->get_setting('invoice_logo')) { ?>
                                <br/>
                                <label><?php echo $mdl_settings->get_setting('invoice_logo'); ?></label>
                                <br>
                            <?php } ?> 
                            <?php echo FileInput::widget( 
                               ['name'=>'invoice_logo', 
                                'options'=>['accept'=>'image/*'],
                                'pluginOptions'=>['allowedFileExtensions'=>['jpg', 'jpeg', 'gif','png'], 
                                'showUpload'=>false,
                                'showRemove'=>false,
                                'multiple'=>false,
                                'resizeimages'=>true,
                                'browseClass' => 'btn btn-success btn-sm',
                                'uploadClass' => 'btn btn-info btn-sm',
                                'removeClass' => 'btn btn-danger btn-sm',
                                'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '    
                              ]]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Utilities::trans('invoice_templates'); ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="settings[pdf_invoice_template]">
                                <?= Utilities::trans('default_pdf_template'); ?>
                            </label>
                            <select name="settings[pdf_invoice_template]" id="settings[pdf_invoice_template]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option value=""><?= Utilities::trans('none'); ?></option>
                                <?php foreach ($pdf_invoice_templates as $invoice_template) { ?>
                                    <option value="<?php echo $invoice_template; ?>"
                                        <?php $mdl_settings->check_select($mdl_settings->get_setting('pdf_invoice_template'), $invoice_template); ?>>
                                        <?php echo $invoice_template; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="settings[pdf_invoice_template_paid]">
                                <?= Utilities::trans('pdf_template_paid'); ?>
                            </label>
                            <select name="settings[pdf_invoice_template_paid]" id="settings[pdf_invoice_template_paid]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option value=""><?= Utilities::trans('none'); ?></option>
                                <?php foreach ($pdf_invoice_templates as $invoice_template) { ?>
                                    <option value="<?php echo $invoice_template; ?>"
                                        <?php $mdl_settings->check_select($mdl_settings->get_setting('pdf_invoice_template_paid'), $invoice_template); ?>>
                                        <?php echo $invoice_template; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="settings[pdf_invoice_template_overdue]">
                                <?= Utilities::trans('pdf_template_overdue'); ?>
                            </label>
                            <select name="settings[pdf_invoice_template_overdue]" class="form-control simple-select"
                                id="settings[pdf_invoice_template_overdue]" data-minimum-results-for-search="Infinity">
                                <option value=""><?= Utilities::trans('none'); ?></option>
                                <?php foreach ($pdf_invoice_templates as $invoice_template) { ?>
                                    <option value="<?php echo $invoice_template; ?>"
                                        <?php $mdl_settings->check_select($mdl_settings->get_setting('pdf_invoice_template_overdue'), $invoice_template); ?>>
                                        <?php echo $invoice_template; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="settings[public_invoice_template]">
                                <?= Utilities::trans('default_public_template'); ?>
                            </label>
                            <select name="settings[public_invoice_template]" id="settings[public_invoice_template]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option value=""><?= Utilities::trans('none'); ?></option>
                                <?php foreach ($public_invoice_templates as $invoice_template) { ?>
                                    <option value="<?php echo $invoice_template; ?>"
                                        <?php $mdl_settings->check_select($mdl_settings->get_setting('public_invoice_template'), $invoice_template); ?>>
                                        <?php echo $invoice_template; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="settings[email_invoice_template]">
                                <?= Utilities::trans('default_email_template'); ?>
                            </label>
                            <select name="settings[email_invoice_template]" id="settings[email_invoice_template]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option value=""><?= Utilities::trans('none'); ?></option>
                                <?php foreach ($all_email_invoice_templates as $email_template) { ?>
                                    <option value="<?php echo ArrayHelper::getValue($email_template,'email_template_id'); ?>"
                                        <?php $mdl_settings->check_select($mdl_settings->get_setting('email_invoice_template'), ArrayHelper::getValue($email_template,'email_template_id')); ?>>
                                        <?php echo ArrayHelper::getValue($email_template,'email_template_title'); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="settings[email_invoice_template_paid]">
                                <?= Utilities::trans('email_template_paid'); ?>
                            </label>
                            <select name="settings[email_invoice_template_paid]" id="settings[email_invoice_template_paid]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option value=""><?= Utilities::trans('none'); ?></option>
                                <?php foreach ($all_email_invoice_templates as $email_template) { ?>
                                    <option value="<?php echo ArrayHelper::getValue($email_template,'email_template_id'); ?>"
                                        <?php $mdl_settings->check_select($mdl_settings->get_setting('email_invoice_template_paid'), ArrayHelper::getValue($email_template,'email_template_id')); ?>>
                                        <?php echo ArrayHelper::getValue($email_template,'email_template_title'); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="settings[email_invoice_template_overdue]">
                                <?= Utilities::trans('email_template_overdue'); ?>
                            </label>
                            <select name="settings[email_invoice_template_overdue]" class="form-control simple-select"
                                id="settings[email_invoice_template_overdue]" data-minimum-results-for-search="Infinity">
                                <option value=""><?= Utilities::trans('none'); ?></option>
                                <?php foreach ($all_email_invoice_templates as $email_template) { ?>
                                    <option value="<?php echo ArrayHelper::getValue($email_template,'email_template_id'); ?>"
                                        <?php $mdl_settings->check_select($mdl_settings->get_setting('email_invoice_template_overdue'), ArrayHelper::getValue($email_template,'email_template_id')); ?>>
                                        <?php echo ArrayHelper::getValue($email_template,'email_template_title'); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="settings[pdf_invoice_footer]">
                                <?= Utilities::trans('pdf_invoice_footer'); ?>
                            </label>
                            <textarea name="settings[pdf_invoice_footer]" id="settings[pdf_invoice_footer]"
                                class="form-control no-margin"><?php echo $mdl_settings->get_setting('pdf_invoice_footer'); ?></textarea>
                            <p class="help-block"><?= Utilities::trans('pdf_invoice_footer_hint'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
