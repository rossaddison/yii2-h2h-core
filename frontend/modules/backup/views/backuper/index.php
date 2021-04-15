<?php
use \kartik\icons\Icon;
use yii\helpers\Url;
use yii\helpers\Html;
use \kartik\form\ActiveForm;
$this->title = 'mySql Backup';
$this->params['breadcrumbs'][] = Html::encode($this->title);

?>
<?= \frontend\modules\backup\widgets\Alert::widget() ?>
<?php
$form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_LARGE]
]);
?>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<?php if ($minPhpVersion === false): ?>
    <div class="alert alert-danger">
        <strong><?= Yii::t('app', 'Your PHP version {0} is lower then required 5.5+', [PHP_VERSION]) ?></strong>
    </div>
<?php endif; ?>

<?php if ($docRoot === false): ?>
    <div class="alert alert-danger">
        <strong><?= Yii::t('app', 'Your DocumentRoot below is not correctly set. ') ?></strong>
        <code><?php echo realpath(Yii::getAlias('@webroot')) ?></code>.  
    </div>
<?php endif; ?>
</div>
</div>
<div class="backuper-controls">
    <?php if ($minPhpVersion === true): ?>  
    <div class="alert alert-info">
        <strong><?= Yii::t('app', 'Your PHP version '.phpversion().' is suitable ie. > 5.5', [PHP_VERSION]) ?></strong>
    </div>
    <?php endif; ?>
    <?php if ($docRoot === true): ?>
    <div class="alert alert-info">
    <p>
            <?= Yii::t('app', 'Your document root is correctly set to: ') ?>
            <code><?php echo realpath(Yii::getAlias('@webroot')) ?></code>.
    </p>
    </div>
    <?php endif; ?>
    <a href="<?= Url::toRoute(['dump']) ?>" class="btn btn-primary btn-lg pull-right ladda-button" data-style="expand-left">
        <?= Yii::t('app', 'Next') ?>
        <?php echo Icon::show('arrow-right') ?>
    </a>
</div>
