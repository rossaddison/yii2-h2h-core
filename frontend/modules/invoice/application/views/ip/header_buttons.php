<?php
     use frontend\modules\invoice\application\components\Utilities;
?>
<div class="headerbar-item pull-right">
    <div class="btn-group btn-group-sm">
        <?php if (!$hide_submit_button) : ?>
            <button id="btn-submit" name="btn_submit" class="btn btn-success ajax-loader" value="1" onclick="js:getSubmit()">
                <i class="fa fa-check"></i> <?= Utilities::trans('save'); ?>
            </button>
        <?php endif; ?>
        <?php if (!$hide_cancel_button) : ?>
            <button type="button" onclick="window.history.back()" id="btn-cancel" name="btn_cancel" class="btn btn-danger" value="1">
                <i class="fa fa-times"></i> <?= Utilities::trans('cancel'); ?>
            </button>
        <?php endif; ?>
    </div>
</div>