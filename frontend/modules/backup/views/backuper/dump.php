<?php
use \kartik\icons\Icon;
use \kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'mySql';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Your Backup Details')];
$this->params['breadcrumbs'][] = $this->title;   

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
    <?php if ($created_directory_successfully === true) {?>
        <h2>
            <?= Html::a(Yii::t('app','Download'), Url::to($model->save_from_path_and_filename), ['class' => 'btn btn-success','data-toggle'=>'tooltip','title'=>Yii::t('app','Save your backup to your local drive in a safe place.')]) ?>
            <?php //var_dump($dumpit); ?>
        </h2>
    <?php } ?>
    <?php if ($created_directory_successfully === false) {?>
        <h2>
            <?php echo Yii::t('app','Your backup sql file could not be saved due to the following error:  '). $resultmessage; ?>
            <?php echo Yii::t('app','Your backup sql file would have been saved to: '). $path_and_filename; ?>
        </h2>
    <?php } ?>
    </div>     
</div>

<div class="backuper-controls">
    <a href="<?= Url::to(['index']) ?>" class="btn btn-info btn-lg pull-left ladda-button" data-style="expand-left">
        <?= Icon::show('arrow-left') ?>
        <?= Yii::t('app', 'Back') ?>
    </a>
</div>

<?php
ActiveForm::end();
$js = <<<JS
Ladda.bind( 'input[type=submit]' );
Ladda.bind( '.btn' );
JS;
$this->registerJs($js);
?>
