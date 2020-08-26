<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use softark\duallistbox\DualListbox;
use frontend\models\Productsubcategory;
$flagged_street = [];
$flagged_street = Productsubcategory::find()
    ->where(['sort_order'=> 500])
    ->one();
if (empty($flagged_street)) {
    $name = Yii::t('app','None');    
} else {
    $name = $flagged_street['name'];    
}
$this->title = Yii::t('app','Transfer House Numbers to a Street that has its Sequence or Order set to 500.');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Street'), 'url' => ['productsubcategory/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Current Selected Street '). $name];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alert alert-success" role="alert" align="center">
    <?php
      if ($name <> Yii::t('app','None')) {
        echo Html::label($name. Yii::t('app', 'has a sequence value of 500 and is therefore selected for house number transfers.'). '<a href="' . Url::to(['productsubcategory/view/'.$flagged_street->id]) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-hand-right"></i>'.Yii::t('app','Click here').'</a>'.Yii::t('app',' to view.'));
      }
      else {
        echo Html::label(Yii::t('app','Have you setup your Postcodes and Streets? No street has their Order or Sequence ,ie. order of cleaning completion, set to 500. Identify a street and set its Order or Sequence to 500.'). ' <a href="' . Url::to(['productsubcategory/index/']) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-hand-right"></i>'.Yii::t('app','Click here').'</a>'.Yii::t('app',' to go to street.'));
      }
     ?>
</div>

<div class="easy-form">

 <?php $form = ActiveForm::begin([
    'id' => 'favourite-form',
    'enableAjaxValidation' => false,
 ]); ?>
    
<?php echo $form->field($model, 'start')->hiddenInput(['maxlength' => true])->label(false) ?>
    
<?php echo $form->field($model, 'finish')->hiddenInput(['maxlength' => true])->label(false) ?>
    
<?php echo $form->field($model, 'housenumber_ids',[
    'template' => "{input}\n{hint}\n{error}",
    'hintOptions' => ['class' => 'form-text text-muted text-left']])->widget(DualListbox::className(),[
        'items' => $items,
        'options' => [
            'multiple' => true,
            'size' => 20,
        ],
        'clientOptions' => [
            'nonSelectedListLabel' => Yii::t('app','Available House Numbers'),
            'selectedListLabel' => Yii::t('app','Selected House Numbers'),
            'moveOnSelect' => false,
            'btnClass' => 'btn-sm btn-outline-secondary font-weight-bold',
            'nonSelectedListLabel' => Yii::t('pluto', 'Available'),
            'selectedListLabel' => Yii::t('pluto', 'Selected'),
            'filterTextClear' => Yii::t('pluto', 'Show all'),
            'filterPlaceHolder' => Yii::t('pluto', 'Filter'),
            'moveSelectedLabel' => Yii::t('pluto', 'Move selected'),
            'moveAllLabel' => Yii::t('pluto', 'Move all'),
            'removeSelectedLabel' => Yii::t('pluto', 'Remove selected'),
            'removeAllLabel' => Yii::t('pluto', 'Remove all'),
            'infoText' => Yii::t('pluto', "Showing all {0}"),
            'infoTextFiltered' => Yii::t('pluto', "<span class='text-dark bg-warning'>Filtered</span> {0} from {1}"),
            'infoTextEmpty' => Yii::t('pluto', 'Empty list'),
            'btnMoveText' => '&rsaquo;',
            'btnRemoveText' => '&lsaquo;',
            'btnMoveAllText' => '&raquo;',
            'btnRemoveAllText'=> '&laquo;',
            'showFilterInputs'=> true,
        ],
    ])
    ->hint('<br><div class = "alert alert-success"><strong>'.Yii::t('app','Select your house numbers that you wish to include in your current street using the list on the left.'). '<br><br>'.Yii::t('app',' Multiselect by holding down the Ctrl Key and press the single arrow.<br><br>The sequence or order value for the specific street must be set to the maximum of 500. Do not forget to change the sequence or order number back to the default of 99 when you are finished using this facility.').'</strong></div>');
?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('app','Update'), [
        'class' => 'btn btn-primary'
    ]) ?>
</div>
<?php ActiveForm::end(); ?>
</div>