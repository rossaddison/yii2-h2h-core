<?php
use frontend\components\Utilities;
use frontend\models\Product;

?>
<br>
<div class="site-index">
    <div class="body-content">
        <div class="container">
            <?php
              if ((!Yii::$app->user->isGuest) && (Product::find()->count()) <> 0){
                Utilities::Home_tabs_service();
              }
            ?>
        </div>
    </div>
</div>
