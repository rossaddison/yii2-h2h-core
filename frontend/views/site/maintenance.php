<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Maintenance');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-maintenance">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><><?php echo Yii::t('app','This site is under maintenance. You may modify the following file to customize its content') ?></p>
    <code><?= __FILE__ ?></code>
</div>
