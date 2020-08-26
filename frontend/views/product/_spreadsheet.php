<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use frontend\models\Productcategory;
use Yii;
$this->title = Yii::t('app','Houses Import');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Houses'), 'url' => ['product/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-import">
    <?php $form = ActiveForm::begin([
        'action' => ['spreadsheet'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'productcategory_id')->dropDownList(ArrayHelper::map(Productcategory::find()->orderBy('name')->all(),'id','name'),['id'=>'cat_id','prompt'=>'Select...']) ?>
    <?= $form->field($model, 'productsubcategory_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat_id'],
        'pluginOptions'=>[
        'depends'=>['cat_id'],   
        'loading'=>true,  
        'placeholder'=>Yii::t('app','Select...'),
        'url'=>Url::to(['/site/subcat'])        
    ]
    ]); ?>
    <?= Html::tag('label',Yii::t('app','Select your filename that you uploaded under import houses  ')) ?>
    <br>
    <?= $form->field($model, 'importfile')->widget(FileInput::classname(), [
    'options' => ['accept' => 'file/*'],
]);
?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Update'), ['class' => 'btn btn-primary', 'value'=>'spreadsheet_value']) ?>
    </div>
</div>
