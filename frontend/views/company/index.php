<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\models\Company;
$this->title = Yii::t('app','Company');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php 
            if (Company::find()->count() === 0){ 
             Html::a(Yii::t('app','Create Company'), ['create'], ['class' => 'btn btn-success']); 
            }
        ?>
    </p>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
        },
    ]) ?>
</div>
