<?php
use yii\helpers\Html;
use frontend\models\Productsubcategory;
use frontend\models\Productcategory;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use frontend\components\Utilities;
use Yii;
?>
<div class="productsubcategory-expandable-view">
    <table border="0" class="table transparent">
    <?php
    
        $streetname = Productsubcategory::find()->where(['id'=>$street_id])->one();
        $postalcodename = Productcategory::find()->where(['id'=>$postcode_id])->one();
        $array = Productcategory::find()->where(['id'=>$postcode_id])->asArray()->all();
        foreach ($array as $key => $value) {
           $strpcodename = $array[$key]['name'];
           $postalcode_id = $array[$key]['id'];
           $array3=Productsubcategory::find()
           ->where(['productcategory_id'=>$postalcode_id])
           ->andWhere(['name'=>$street_name])
           ->select(['id','name','lat_start','lng_start','lat_finish','lng_finish'])->asArray()->all();
           $totalcount = 0;
            if (!empty($array3)) {
                     $coord = new LatLng(['lat' => 55.8622341, 'lng' => -4.181051]);
                     $map = new Map([
                     'width'=> 256,
                     'height'=>256,
                     'center' => $coord,
                     'zoom' => 4,
                 ]);
                 // Lets configure the polyline that renders the direction
                 $polylineOptions = new PolylineOptions([
                     'strokeColor' => '#FFAA00',
                     'draggable' => true
                 ]);
                 //for all the streets within the postcode
                foreach ($array3 as $key3 => $value3)
                 {
                     //take each street 
                     $street_id = $array3[$key3]['id'];
                     //count the number of houses in each street to add to the totalcount below
                     $count = Utilities::ProdListc($postalcode_id,$street_id);
                     //if the street has coordinates append the street
                     $atleast1 = 0; 
                     if (($array3[$key3]['lat_start']<>0) && ($array3[$key3]['lng_start']<>0) && ($array3[$key3]['lat_finish']<>0) && ($array3[$key3]['lng_finish']<>0)) {
                             $start = new LatLng(['lat' => $array3[$key3]['lat_start'], 'lng' => $array3[$key3]['lng_start']]);
                             $finish = new LatLng(['lat' => $array3[$key3]['lat_finish'], 'lng' => $array3[$key3]['lng_finish']]);
                             $directionsRequest = new DirectionsRequest([
                                 'origin' => $start,
                                 'destination' => $finish,
                                 //'waypoints' => $waypoints,
                                 'travelMode' => TravelMode::DRIVING
                             ]);
                             $directionsRenderer = new DirectionsRenderer([
                                     'map' => $map->getName(),
                                     'polylineOptions' => $polylineOptions
                             ]);                
                             $directionsService = new DirectionsService([
                                 'directionsRenderer' => $directionsRenderer,
                                 'directionsRequest' => $directionsRequest
                             ]);
                             //overlay the street
                             $map->appendScript($directionsService->getJs());
                             $atleast1 = $atleast1 + 1;
                     } 
                     $totalcount = $count + $totalcount;
                 }
                 //display the map only once all the streets have been overlayed and there is at least one street
                 //if ($atleast1>0) echo $map->display();
                 echo $map->display();
                 }
                 echo  "<h4>&nbsp;&nbsp;".$strpcodename." (".$totalcount.")"."</h4>";
                 $url2 = "https://maps.google.com/maps?q=".$streetname['name']." ".$postalcodename['name'];
                 $url3 = $streetname['name']." ".$postalcodename['name'];            
                 echo Html::a($url3,$url2,['class' => 'btn btn-success','data-toggle'=>'tooltip','title'=>Yii::t('app','Goto Google maps using this address.')]);                
           }// not empty$array3
     ?>                  
    </table>
</div>
