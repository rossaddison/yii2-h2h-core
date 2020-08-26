<?php
   use yii\helpers\Url;
   use yii\helpers\Html;
   use frontend\models\Product;
   use frontend\models\Productsubcategory;
   use frontend\models\Productcategory;
?>
<div class="krajeeproducttree-product">
    <br>
        <?php
          if ($node->product_id > 0){
            echo Html::a('<h4>View House Details: ' .$node->name. '</h4>',Url::toRoute(['/product/view','id'=>$node->product_id]));
            $house = Product::find()
                      ->with('productsubcategory','productcategory')
                      ->where(['id'=>$node->product_id])
                      ->one();
            $url1 = ltrim($house['productnumber'], '0').", ".$house['productsubcategory']['name'].", ".$house['productcategory']['name'];
            $url2 = "https://maps.google.com/maps?q=".$url1;
            echo Html::a('<h4>Google Maps: '.$url1.'</h4>',$url2);
          }         
          if ($node->productsubcategory_id > 0){
            echo Html::a('<h4>View Street Details: ' .$node->name. '</h4>',Url::toRoute(['/productsubcategory/view','id'=>$node->productsubcategory_id]));
            $street = Productsubcategory::find()
                      ->with('productcategory')
                      ->where(['id'=>$node->productsubcategory_id])
                      ->one();
            $url1 = $street['name'].", ".$street['productcategory']['name'];
            $url2 = "https://maps.google.com/maps?q=".$url1;
            echo Html::a('<h4>Google Maps: '.$url1.'</h4>',$url2);
          }         
          if ($node->productcategory_id > 0){
            echo Html::a('<h4>View Postcode Details: ' .$node->name. '</h4>',Url::toRoute(['/productcategory/view','id'=>$node->productcategory_id]));
            $postcode = Productcategory::find()
                      ->where(['id'=>$node->productcategory_id])
                      ->one();
            $url1 = $postcode['name'];
            $url2 = "https://maps.google.com/maps?q=".$url1;
            echo Html::a('<h4>Google Maps: '.$url1.'</h4>',$url2);            
          }
        ?>
    <br>
</div>