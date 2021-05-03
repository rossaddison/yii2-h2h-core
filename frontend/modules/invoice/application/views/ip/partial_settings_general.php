<?php
   use frontend\modules\invoice\application\components\Utilities;
   use frontend\modules\invoice\application\helpers\NumberHelper;
   use kartik\icons\Icon;
   use yii\helpers\Html;
?>
<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Utilities::trans('general'); ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="settings[default_language]">
                                <?php 
                                    Utilities::trans('default_language');
                                ?>
                            </label>
                            <select name="settings[default_language]" id="settings[default_language]"
                                class="input-sm form-control simple-select">
                                <?php foreach ($default_languages as $key => $value) { ?>
                                    <option value="<?php echo $value['name']; ?>"
                                        <?php $mdl_settings->check_select($mdl_settings->get_setting('default_language'), $value['name']); ?>>
                                        <?php echo $value['name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Utilities::trans('amount_settings'); ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="settings[currency_symbol]">
                                <?= Utilities::trans('currency_symbol')." eg. £"; ?>
                            </label>
                            <input type="text" style="text-indent: 15px" name="settings[currency_symbol]" id="settings[currency_symbol]" 
                                class="form-control"
                                value="<?php echo $mdl_settings->get_setting('currency_symbol');?>">
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="settings[currency_symbol_placement]">
                                <?= Utilities::trans('currency_symbol_placement'); ?>
                            </label>
                            <select name="settings[currency_symbol_placement]" id="settings[currency_symbol_placement]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option value="before" <?php $mdl_settings->check_select($mdl_settings->get_setting('currency_symbol_placement'), 'before'); ?>>
                                    <?= Utilities::trans('before_amount'); ?>
                                </option>
                                <option value="after" <?php $mdl_settings->check_select($mdl_settings->get_setting('currency_symbol_placement'), 'after'); ?>>
                                    <?= Utilities::trans('after_amount'); ?>
                                </option>
                                <option value="afterspace" <?php $mdl_settings->check_select($mdl_settings->get_setting('currency_symbol_placement'), 'afterspace'); ?>>
                                    <?= Utilities::trans('after_amount_space'); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="settings[currency_code]">
                                <?= Utilities::trans('currency_code'). str_repeat("&nbsp;", 2). Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','Gateway Currency Codes.')]); 
                                ?>
                            </label>
                            <select name="settings[currency_code]"
                                id="settings[currency_code]"
                                class="input-sm form-control simple-select">
                                <?php foreach ($gateway_currency_codes as $val => $key) { ?>
                                    <option value="<?php echo $val; ?>"
                                        <?php $mdl_settings->check_select($mdl_settings->get_setting('currency_code'), $val); ?>>
                                        <?php echo $val; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Utilities::trans('interface'); ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="disable_sidebar">
                                <?= Utilities::trans('disable_sidebar'); ?>
                            </label>
                            <select name="settings[disable_sidebar]" class="form-control simple-select"
                                id="disable_sidebar" data-minimum-results-for-search="Infinity">
                                <option value="0">
                                    <?= Utilities::trans('no'); ?>
                                </option>
                                <option value="1" <?php $mdl_settings->check_select($mdl_settings->get_setting('disable_sidebar'), '1'); ?>>
                                    <?= Utilities::trans('yes'); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="monospace_amounts">
                                <?= Utilities::trans('monospaced_font_for_amounts'); ?>
                            </label>
                            <select name="settings[monospace_amounts]" class="form-control simple-select"
                                id="monospace_amounts" data-minimum-results-for-search="Infinity">
                                <option value="0"><?= Utilities::trans('no'); ?></option>
                                <option value="1" <?php $mdl_settings->check_select($mdl_settings->get_setting('monospace_amounts'), '1'); ?>>
                                    <?= Utilities::trans('yes'); ?>
                                </option>
                            </select>

                            <p class="help-block">
                                <?= Utilities::trans('example'); ?>:
                                <span style="font-family: Monaco, Lucida Console, monospace">
                                    <?php echo NumberHelper::format_currency(123456.78); ?>
                                </span>
                            </p>
                        </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-6">

                        
                    </div>
                    <div class="col-xs-12 col-md-6">
                    </div>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Utilities::trans('system_settings'); ?>
            </div>
            <div class="panel-body">

                <div class="row">
                   <div class="col-xs-12 col-md-6">

                        <div class="form-group">
                            <label for="cron_key">
                                <?= Utilities::trans('cron_key'); ?>
                            </label>
                            <div class="input-group">
                                <input type="text" name="settings[cron_key]" id="cron_key" class="form-control" readonly
                                    value="<?php echo $mdl_settings->get_setting('cron_key'); ?>">
                                <div class="input-group-btn">
                                    <button id="btn_generate_cron_key" type="button" class="btn btn-primary btn-block" onclick="js:getCronkey()">
                                        <?php echo Icon::show('recycle', ['framework' => Icon::FAS]); 
                                              Utilities::trans('generate'); 
                                        ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>