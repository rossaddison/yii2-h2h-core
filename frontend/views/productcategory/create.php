<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Create Postcodes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Postcodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Find Postcode'), 'url' => "http://pcf.raggedred.net/"];
?>
<div class="productcategory-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
