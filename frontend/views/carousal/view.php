<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Carousals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carousal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-lg']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-lg',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'image_web_filename',
            'image_source_filename',
            'content_alt',
            'content_title',
            'content_caption',
            'fontcolor',
        ],
    ]) ?>
    
    <?php
            if ($model->image_web_filename!='') {
               if (Yii::$app->user->identity->attributes['name'] === 'demo')
               {    
                    echo '<img src="'.Url::to('@web/images/demo/'.Yii::$app->session['demo_image_timestamp_directory']."/".$model->image_web_filename.'" width=250px" height = "auto"></p>', true);
               } else
               {
                    echo '<img src="'.Url::to('@web/images/'.$model->image_web_filename.'" width=250px" height = "auto">', true);
               }
            }  
    ?>
</div>
