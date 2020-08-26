<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use frontend\models\Productcategory;
use yii\helpers\Url;
use Yii;
?>
<div class="product-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?php //= $form->field($model, 'id') ?>
    <?= $form->field($model, 'productcategory_id')->dropDownList(ArrayHelper::map(Productcategory::find()->orderBy('name')->all(),'id','name'),['id'=>'cat_id','prompt'=>'Select...']) ?>
    <?= $form->field($model, 'productsubcategory_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat_id'],
        'pluginOptions'=>[
        'depends'=>['cat_id'],   
        'loading'=>true,  
        'placeholder'=>Yii::t('app','Select ...'),
        'url'=>Url::to(['/product/subcat'])        
    ]
    ]); ?>
    <?= $form->field($model, 'id')->widget(DepDrop::classname(),[
        'options'=>['id'=>'id'],
        'pluginOptions'=>[
        //'depends'=>[Html::getInputId($model, 'productcategory_id'), Html::getInputId($model, 'productsubcategory_id')],
        'depends'=>['cat_id', 'subcat_id'],
        'loading'=>true,
        'placeholder'=>Yii::t('app','Select ...'),
        'url'=>Url::to(['/product/customer']),
        'initialize'=>true,
    ]
    ]); ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'surname') ?>
    <?= $form->field($model, 'contactmobile') ?>
    <?php // echo $form->field($model, 'specialrequest') ?>
    <?php // echo $form->field($model, 'listprice') ?>
    <?php // echo $form->field($model, 'productsubcategory_id') ?>
    <?php // echo $form->field($model, 'sellstartdate') ?>
    <?php // echo $form->field($model, 'sellenddate') ?>
    <?php // echo $form->field($model, 'discontinueddate') ?>
    <?php // echo $form->field($model, 'modifieddate') ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
