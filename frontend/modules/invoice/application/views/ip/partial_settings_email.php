<?php
      use frontend\modules\invoice\application\components\Utilities;
      use yii\helpers\ArrayHelper;
?>

<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Utilities::trans('email'); ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">

                        <div class="form-group">
                            <label for="settings[email_pdf_attachment]">
                                <?= Utilities::trans('email_pdf_attachment'); ?>
                            </label>
                            <select disabled name="settings[email_pdf_attachment]" id="settings[email_pdf_attachment]"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity">
                                <option disabled value="0"><?= Utilities::trans('no'); ?></option>
                                <option value="1" <?php $mdl_settings->check_select($mdl_settings->get_setting('email_pdf_attachment'), '1'); ?>>
                                    <?= Utilities::trans('yes'); ?>
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email_send_method">
                                <?= Utilities::trans('email_send_method'); ?>
                            </label>
                            <select disabled name="settings[email_send_method]" id="email_send_method"
                                class="form-control simple-select" data-minimum-results-for-search="Infinity" onchange="js:getTogglesmtpsettings">
                                <option disabled value=""><?= Utilities::trans('none'); ?></option>
                                <option disabled value="phpmail" <?php $mdl_settings->check_select($mdl_settings->get_setting('email_send_method'), 'phpmail'); ?>>
                                    <?= Utilities::trans('email_send_method_phpmail'); ?>
                                </option>
                                <option disabled value="sendmail" <?php $mdl_settings->check_select($mdl_settings->get_setting('email_send_method'), 'sendmail'); ?>>
                                    <?= Utilities::trans('email_send_method_sendmail'); ?>
                                </option>
                                <option value="smtp" <?php $mdl_settings->check_select($mdl_settings->get_setting('email_send_method'), 'smtp'); ?>>
                                    <?= Utilities::trans('email_send_method_smtp'); ?>
                                </option>
                            </select>
                        </div>
                        <div id="div-smtp-settings">
                            <hr>

                            <div class="form-group">
                                <label for="settings[smtp_server_address]">
                                    <?= Utilities::trans('smtp_server_address'); ?>
                                </label>
                                <input disabled type="text" name="settings[smtp_server_address]" id="settings[smtp_server_address]"
                                    class="form-control"
                                    value="">
                            </div>
                            <div class="form-group">
                                <label for="settings[smtp_mail_from]">
                                    <?= Utilities::trans('smtp_mail_from'); ?>
                                </label>
                                <input type="email" name="settings[smtp_mail_from]" id="settings[smtp_mail_from]"
                                    class="form-control"
                                    value="<?php $mdl_settings->get_setting('smtp_mail_from', '', true); ?>">
                            </div>
                            <div class="form-group">
                                <label for="settings[smtp_authentication]">
                                    <?= Utilities::trans('smtp_requires_authentication'); ?>
                                </label>
                                <select name="settings[smtp_authentication]" id="settings[smtp_authentication]"
                                    class="form-control simple-select">
                                    <option value="0">
                                        <?= Utilities::trans('no'); ?>
                                    </option>
                                    <option value="1" <?php $mdl_settings->check_select($mdl_settings->get_setting('smtp_authentication'), '1'); ?>>
                                        <?= Utilities::trans('yes'); ?>
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="settings[smtp_username]">
                                    <?= Utilities::trans('smtp_username'); ?>
                                </label>
                                <input type="text" name="settings[smtp_username]" id="settings[smtp_username]"
                                    class="form-control"
                                    value="<?php $mdl_settings->get_setting('smtp_username', '', true); ?>">
                            </div>

                            <div class="form-group">
                                <label for="smtp_password">
                                    <?= Utilities::trans('smtp_password'); ?>
                                </label>
                                <input type="password" id="smtp_password" class="form-control"
                                    name="settings[smtp_password]"
                                    value="<?php $crypt->decode($mdl_settings->get_setting('settings[smtp_password]')); ?>">
                                <input type="hidden" name="settings[smtp_password_field_is_password]" value="1">
                            </div>

                            <div class="form-group">
                                <div>
                                    <label for="settings[smtp_port]">
                                        <?= Utilities::trans('smtp_port'); ?>
                                    </label>
                                    <input type="number" name="settings[smtp_port]" id="settings[smtp_port]"
                                        class="form-control"
                                        value="<?php $mdl_settings->get_setting('smtp_port'); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="settings[smtp_security]">
                                    <?= Utilities::trans('smtp_security'); ?>
                                </label>
                                <select name="settings[smtp_security]" id="settings[smtp_security]"
                                    class="form-control simple-select">
                                    <option value=""><?= Utilities::trans('none'); ?></option>
                                    <option value="ssl" <?php $mdl_settings->check_select($mdl_settings->get_setting('smtp_security'), 'ssl'); ?>>
                                        <?= Utilities::trans('smtp_ssl'); ?>
                                    </option>
                                    <option value="tls" <?php $mdl_settings->check_select($mdl_settings->get_setting('smtp_security'), 'tls'); ?>>
                                        <?= Utilities::trans('smtp_tls'); ?>
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="settings[smtp_verify_certs]">
                                    <?= Utilities::trans('smtp_verify_certs'); ?>
                                </label>
                                <select name="settings[smtp_verify_certs]" id="settings[smtp_verify_certs]"
                                    class="form-control simple-select">
                                    <option value="1"><?= Utilities::trans('yes'); ?></option>
                                    <option value="0" <?php $mdl_settings->check_select($mdl_settings->get_setting('smtp_verify_certs'), '0'); ?>>
                                        <?= Utilities::trans('no'); ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>