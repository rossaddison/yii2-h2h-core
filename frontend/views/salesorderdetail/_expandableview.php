<?php
use yii\helpers\Html;
use Yii;
?>
<div class="salesorderdetail-expandable-view">
    <table border="0" class="table transparent">
    <?php
    use frontend\models\Productsubcategory;
    use frontend\models\Productcategory;
        $streetname = Productsubcategory::find()->where(['id'=>$street_id])->one();
        $postalcodename = Productcategory::find()->where(['id'=>$postcode_id])->one();
         echo Html::tag('div',
             Html::tag('tr',
                 '<td >'.
                 Yii::t('app','Postcode Name (Set under Postcode)')
                 ."</td><td>". 
                 Yii::t('app','Street Name (Set under Street)')
                 ."</td><td>".
                 Yii::t('app','Sort Order (Set under Street)')
                 ."</td>"
              )
            );
        echo Html::tag('div',
             Html::tag('tr',
                 '<td >'.
                 $postalcodename['name']
                 ."</td><td>". 
                 $streetname['name']
                 ."</td><td>".
                  $streetname['sort_order']
                 ."</td>"
              )
            );
    ?>
    </table>
</div>
