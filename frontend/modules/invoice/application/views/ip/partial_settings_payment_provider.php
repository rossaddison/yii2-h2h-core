<?php 
    use Yii;
    use frontend\modules\invoice\application\components\Utilities;
?>
 <div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php
                   Utilities::trans('online_payment');
                ?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="settings[enable_online_payments]" value="0">
                            <input type="checkbox" name="settings[enable_online_payments]" value="1"
                                <?php 
                                   $mdl_settings->check_select($mdl_settings->get_setting('enable_online_payments'), 1, '==', true) 
                                ?>>
                            <?= Utilities::trans('enable_online_payments'); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="online-payment-select">
                        <?php echo Yii::t('app','Add payment provider'); ?>
                    </label>
                    <select id="online-payment-select" class="form-control" onchange="js:getPaymentprovider()">
                        <option value=""><?php echo Yii::t('app','None'); ?></option>
                            <?php foreach ($gateway_drivers as $driver => $fields) {
                                $d = strtolower($driver);
                            ?>
                            <option value="<?php echo $d; ?>">
                                <?php echo ucwords(str_replace('_', ' ', $driver)); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <?php
        foreach ($gateway_drivers as $driver => $fields) :
            $d = strtolower($driver);
            ?>
            <div id="gateway-settings-<?php echo $d; ?>"
                class="gateway-settings panel panel-default <?php
                   //
                   echo $mdl_settings->get_setting('gateway_' . $d . '_enabled') ? 'active-gateway' : 'hidden'; 
                ?>">
                <div class="panel-heading">
                    <?php echo ucwords(str_replace('_', ' ', $driver)); ?>
                    <div class="pull-right">
                        <div class="checkbox no-margin">
                            <label>
                                <input type="hidden" name="settings[gateway_<?php echo $d; ?>_enabled]" value="0">
                                <input type="checkbox" name="settings[gateway_<?php echo $d; ?>_enabled]" value="1"
                                    id="settings[gateway_<?php echo $d; ?>_enabled]"
                                    <?php
                                       $mdl_settings->check_select($mdl_settings->get_setting('gateway_' . $d . '_enabled'), 1, '==', true) 
                                    ?>>
                                <?= Utilities::trans('enabled').Utilities::trans('enable_online_payment'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="panel-body small">
                    <?php foreach ($fields as $key => $setting) { ?>
                        <?php if ($setting['type'] == 'checkbox') : ?>
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="settings[gateway_<?php echo $d; ?>_<?php echo $key ?>]"
                                        value="0">
                                    <input type="checkbox" name="settings[gateway_<?php echo $d; ?>_<?php echo $key ?>]"
                                        value="1"
                                        <?php 
                                           $mdl_settings->check_select($mdl_settings->get_setting('gateway_' . $d . '_' . $key), 1, '==', true) 
                                        ?>>
                                    <?= Utilities::trans('online_payment_'.$key); ?>
                                </label>
                            </div>
                        <?php else : ?>
                            <div class="form-group">
                                <label for="settings[gateway_<?php echo $d; ?>_<?php echo $key ?>]">
                                    <?= Utilities::trans('online_payment_'.$key); ?>
                                </label>
                                <input type="<?php echo $setting['type']; ?>" class="input-sm form-control"
                                    name="settings[gateway_<?php echo $d; ?>_<?php echo $key ?>]"
                                    id="settings[gateway_<?php echo $d; ?>_<?php echo $key ?>]"
                                    <?php if ($setting['type'] == 'password') : ?>
                                        value="<?php echo $crypt->decode($mdl_settings->get_setting('gateway_' . $d . '_' . $key)); ?>"
                                    <?php else : ?>
                                        value="<?php echo $mdl_settings->get_setting('gateway_' . $d . '_' . $key); ?>"
                                    <?php endif; ?>
                                >
                                <?php if ($setting['type'] == 'password') : ?>
                                    <input type="hidden" value="1"
                                        name="settings[gateway_<?php echo $d . '_' . $key ?>_field_is_password]">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php } ?>
                    <hr>
                    <div class="form-group">
                        <label for="settings[gateway_<?php echo $d; ?>_currency]">
                            <?php echo Yii::t('app','Currency'); ?>
                        </label>
                        <select name="settings[gateway_<?php echo $d; ?>_currency]"
                            id="settings[gateway_<?php echo $d; ?>_currency]"
                            class="input-sm form-control simple-select">
                            <?php foreach ($gateway_currency_codes as $val => $key) { ?>
                                <option value="<?php echo $val; ?>"
                                    <?php 
                                       $mdl_settings->check_select($mdl_settings->get_setting('gateway_' . $d . '_currency'), $val); 
                                    ?>>
                                    <?php echo $val; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="settings[gateway_<?php echo $d; ?>_payment_method]">
                            <?php echo Utilities::trans('online_payment_method'); ?>
                        </label>
                        <select name="settings[gateway_<?php echo $d; ?>_payment_method]"
                            id="settings[gateway_<?php echo $d; ?>_payment_method]"
                            class="input-sm form-control simple-select">
                            <option value=""><?php echo Yii::t('app','None'); ?></option>
                            <?php foreach ($payment_methods as $payment_method) { ?>
                                <option value="<?php echo $payment_method->payment_method_id; ?>"
                                    <?php 
                                      $mdl_settings->check_select($mdl_settings->get_setting('gateway_' . $d . '_payment_method'), $payment_method->payment_method_id) 
                                    ?>>
                                    <?php 
                                       echo $payment_method->payment_method_name; 
                                    ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
 </div> 
</form>
