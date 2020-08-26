<?php
use kartik\icons\FontAwesomeAsset;
use Yii;
FontAwesomeAsset::register($this);
$this->title = Yii::t('app','Houses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Houses'), 'url' => ['product/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
    echo $this->render('_search', ['model' => $searchModel]); 
?>  



