<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Cancelled');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?php echo Yii::t('app','Your payment has been cancelled. Please try again.') ?></p>
</div>
