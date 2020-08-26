<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Create Cost');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Cost'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
