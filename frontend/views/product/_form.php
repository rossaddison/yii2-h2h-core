 <?php 
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use frontend\models\Productcategory;
    use frontend\models\Salesorderheader;
    use kartik\depdrop\DepDrop;
    use Yii;
?>
<div class="product-form">
    <?php $form = ActiveForm::begin([
                'options' => [
                    //id for modal used in product/create action
                    //essential for bootstrap modal to work.
                    'id' => 'create-product-form'
                ]
    ]); ?>
    <?= $form->field($model, 'productcategory_id')->dropDownList(ArrayHelper::map(Productcategory::find()->orderBy('name')->all(),'id','name'),['prompt'=>'Select...','id'=>'cat_id']) ?>
    <?= $form->field($model, 'productsubcategory_id')->widget(DepDrop::classname(),
        ['options'=>['id'=>'subcat_id'],
         'pluginOptions'=>['depends'=>['cat_id'],
                           'url'=> Url::to(['product/subcat']),
                          ],
        ]
        ); 
    ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'productnumber')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'postcodefirsthalf')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'postcodesecondhalf')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'contactmobile')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'specialrequest')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'frequency')->dropDownList([Yii::t('app','Weekly') =>Yii::t('app','Weekly'),Yii::t('app','Fortnightly')=>Yii::t('app','Fortnightly'),Yii::t('app','Monthly')=>Yii::t('app','Monthly'),Yii::t('app','Every two months')=>Yii::t('app','Every two months'),Yii::t('app','Not Applicable')=>Yii::t('app','Not Applicable')], ['prompt' => Yii::t('app','Select')]) ?>
    <?= $form->field($model, 'listprice')->textInput(['maxlength' => true]) ?>
    <?php //form->field($model, 'sellstartdate')->widget(\yii\jui\DatePicker::classname(),[ 'dateFormat' => 'yyyy-MM-dd','inline'=>'true']) ?>
    <?= $form->field($model, 'sellstartdate')->widget(\kartik\datecontrol\DateControl::classname(),['displayFormat' => 'php:Y-m-d',
                                'saveFormat' => 'php:Y-m-d',
                                'options' => [
                                    'pluginOptions' => ['autoclose' => true],
                                    'convertFormat'=>true 
                                ]]) ?> 
    <?php  ///$form->field($model, 'discontinueddate')->widget(\yii\jui\DatePicker::classname(),[ 'dateFormat' => 'yyyy-MM-dd','inline'=>'true',]) ?>
    <?= $form->field($model, 'isactive')->checkbox() ?>
    <?= $form->field($model, 'jobcode')->dropDownList(ArrayHelper::map(Salesorderheader::find()->orderBy('status')->asArray()->all(),'status','status'), ['prompt' => 'Select']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

