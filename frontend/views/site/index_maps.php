<?php
use frontend\models\Productcategory;
use frontend\models\Product;
use frontend\models\Salesorderdetail;
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\Ic;
use frontend\models\Productsubcategory;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;
use kartik\icons\Icon;
use kartik\tree\TreeView;
use frontend\models\Tree;
use yii\bootstrap\carousel;
use frontend\models\Carousal;
use frontend\models\Company;
use yii\web\JqueryAsset;
use Twilio\Rest\Client;
use yii\widgets\MaskedInput;
use Twilio\Exceptions\TwilioException;
use frontend\components\Utilities;
\yii\web\JqueryAsset::register($this);

$this->registerJsFile('@web/js/scripts2.js',['depends' => [\yii\web\JqueryAsset::className()]]);
//'itemView' => function ($model, $key, $index, $widget) {
//                        return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
//                        },
/* @var $this yii\web\View */
$this->title = 'RA Window Cleaning';
?>
<?php 
   //echo "basepath " . Yii::$app->basePath;
   //echo "<br>";     
?>
<?php
   //echo "webroot " . Yii::getAlias('@webroot');
   //echo "<br>";
?>
<?php
   //echo "frontend " . Yii::getAlias('@frontend');
   //echo "<br>";
?>
<?php
   //echo "web " . Yii::getAlias('@web');
   //echo "<br>";
?>



<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-xs-4" style ="background:paleturquoise" >
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    
                    <div class="form-group"
                            
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="6WYTX6GA45V3N">
                            <table>
                            <tr><td><input type="hidden" name="on0" value="pricedropdown">Price you pay</td></tr><tr><td>
                            <?= Html::dropDownList('os0','',
                                    ['£5 clean'=>'£5 clean £5.00 GBP',
                                     '£6 clean'=>'£6 clean £6.00 GBP',
                                     '£7 clean'=>'£7 clean £7.00 GBP',
                                     '£8 clean'=>'£8 clean £8.00 GBP',
                                     '£9 clean'=>'£9 clean £9.00 GBP',
                                     '£10 clean'=>'£10 clean £10.00 GBP',
                                     '£11 clean'=>'£11 clean £11.00 GBP',
                                     '£12 clean'=>'£12 clean £12.00 GBP',
                                     '£13 clean'=>'£13 clean £13.00 GBP', 
                                     '£14 clean'=>'£14 clean £14.00 GBP',
                                     '£15 clean'=>'£15 clean £15.00 GBP',
                                     '£20 clean'=>'£20 clean £20.00 GBP',
                                     '£25 clean'=>'£25 clean £25.00 GBP',
                                     '£30 clean'=>'£30 clean £30.00 GBP', 
                                     '£35 clean'=>'£35 clean £35.00 GBP', 
                                     '£40 clean'=>'£40 clean £40.00 GBP', 
                                     '£45 clean'=>'£45 clean £45.00 GBP',
                                     '£50 clean'=>'£50 clean £50.00 GBP',  
                                    ],['class'=>'form-control']) ?>  </td></tr>
                         </div>   
                         <div class="form-group"    
                            <tr><td><input type="hidden" name="on1" value="Firstname" class="form-control">Firstname</td></tr>
                            <br>
                            <tr><td><input type="text" name="os1" maxlength="200" class="form-control"></td></tr>
                            <br>
                            <tr><td><input type="hidden" name="on2" value="Street" class="form-control">Street</td></tr>
                            <br>
                            <tr><td><input type="text" name="os2" maxlength="200" class="form-control"></td></tr>
                            </table>
                            <br>
                            <input type="hidden" name="currency_code" value="GBP">
                            <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                         </div>
                     </form>
                <hr>
            </div>
        </div>
        <div class="row">
            
            <div class="col-xs-4" style ="background:paleturquoise">
                <h1><?php echo "Window Cleaning ".Company::findOne(1)->address_area2 ?></h1>
                <div>
                    <?php echo Company::findOne(1)->homepage ?>
                </div> 
                <hr>
                <div style ="background:lightblue">
                    <p>Hi. My name is <input type="text" name="custname" value="" size="25" /> I am in your listed postcode areas, and am interested in having my windows cleaned. </p>
                    <p> 
                    <p>Please contact me on 
                    <?php
                            echo MaskedInput::widget([
                            'name' => 'custtel',
                            'mask' => '099-99-99-99-99',
                            'options' =>['style'=>['class'=>"col-sm-3", 'background'=>"lightblue"]],
                            ]);
                    ?> between 6 pm and 8 pm tonight.
                </p>
                </div>
                
                <button id="w41" class = "btn btn-success" onclick="js:getSitemessage()">Send</button>
                <hr>
            </div>
            <div class="col-xs-6">
                <?php
                  $images = [];
                  $images = Carousal::find()->all();
                  $count = Carousal::find()->count();
                  $items = [];
                  foreach ($images as $key => $value)
                  {
                   $items[$key]['content'] = Html::img('@web/images/'.$images[$key]['image_web_filename']);
                   $items[$key]['alt'] = $images[$key]['content_alt']; 
                   $items[$key]['caption'] = '<font color="'. $images[$key]['fontcolor'].'"><small>'.$images[$key]['content_title'].'</small><p><small>'.$images[$key]['content_caption'].'</small></font></p>';
                   $items[$key]['options'] = ['class'=>"img-fluid",'interval'=>50,'keyboard'=>true];
                  }
                  echo Carousel::widget(
                    ['items' => $items,
                     'showIndicators'=>true,
                     'controls' =>false,
                    ]);
                ?>
           </div>
           
            <div class="col-xs-12">   
                <p>
                <?php
                    $string = '<div class="row"><div class="col-sm-3">{wrapper}</div>';
                    $footer = '{toolbar}';
                   if (!\Yii::$app->user->can('Create Daily Clean')){
                       //can('Create Daily Clean')) {
                      $string = '<div class="row"><div class="col-sm-3">{wrapper}</div>';
                      $footer = '';
                      }
                   else {
                      $string = '<div class="row"><div class="col-sm-3">{wrapper}</div><div class="col-sm-7">{detail}</div>'; 
                      $footer = '{toolbar}';
                   };
                   echo TreeView::widget([
                    
                    'query'             => Tree::find()->addOrderBy('root, lft'), 
                    'headingOptions'    => ['label' => 'Post Codes'],
                    'isAdmin'           => false,
                    'treeOptions' => ['style' => 'height:500px'],// optional (toggle to enable admin mode)
                    'rootOptions' => ['label'=>'<span class="text-primary">Glasgow</span>'],
                    //'fontAwesome' => true,
                    'footerTemplate' => $footer,
                    'wrapperTemplate' => "{header}\n{tree}{footer}",
                    'mainTemplate'=> $string,
                    'displayValue' => 0,
                    'allowNewRoots'=>false,
                    
                ]); ?>
                
               </p>  
            </div>
            
            
            <div class="col-xs-4">
                <h1>Post Codes</h1>
                <p1><?= Html::a('Post Code Finder', "http://pcf.raggedred.net/", ['class' => 'btn btn-success']) ?></p1>
                <br>
                <h1>Postcode</h1>
                <p1><?= Html::a ('Areas Currently Served',['productcategory/index'],['class' => 'btn btn-info']); ?></p1>
                <?php $array = Productcategory::find()->all(); 
                        foreach ($array as $key => $value) {
                            $strpcodename = $array[$key]['name'];
                            $stripcodename = substr($strpcodename,6);
                            //return Html::a(Html::encode($value), ['view', 'id' => $key]);
                            $postalcode_id = $array[$key]['id'];
                            //pass the id of the postcode into below to get all the streets
                            $array3 = Utilities::SubCatListb($postalcode_id);
                            //get a count of all the houses in each street
                            $totalcount = 0;
                            //go through all the streets associated with that postcode
                           
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
                                //count the number of houses in each street
                                $count = Utilities::ProdListc($postalcode_id,$street_id);
                                //if the street has house coordinates
                                $atleast1 = 0;
                                if (($array3[$key3]['lat_start']<>0) & ($array3[$key3]['lng_start']<>0) & ($array3[$key3]['lat_finish']<>0) & ($array3[$key3]['lng_finish']<>0)) {
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
                            //the map will not display 
                            if ($atleast1>0) 
                                {
                                    echo $map->display();                                   
                                }
                            }//if (!empty($array3))
                            echo  "<h1>&nbsp&nbsp".$stripcodename." (".$totalcount.")"."</h1>";
                        }//$array end of top loop
                        $totcount = Product::find()->where(['>=','sellenddate',Date("Y-m-d")])->count();
                        $array4 = Product::find()->all();
                        foreach ($array4 as $key4 => $value4)
                        {
                            $last_cust = $array4[$key4]['id'];
                        }
                        $lastcustomer = Product::findOne($last_cust);
                        echo "<h5>Total cleans: ".$totcount. "</h5></br>";
                        
                        
                ?>
                
                <div class="container" style ="background:lightblue">
                <h5>Latest customer: <?php echo $lastcustomer->modifieddate ?> </h5>
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <?php
                            echo "<h5>Firstname: ".$lastcustomer->name."</h5>";
                            echo "<h5>Postcode: ". $lastcustomer->productcategory->name."</h5>";
                            echo "<h5>Price: £".$lastcustomer->listprice."</h5>";          
                        ?>
                         </div>
                     </div>                     
                </div>
                <br>
                <div class="container" style ="background:lightblue">
                    <h5>Cleans due:</h5>
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <?php                             
                                $todaydate = date("Y-m-d");
                                //echo "today date".$todaydate;
                                $dateminus = strtotime("-33 day");
                                //echo "date minus ".$dateminus;
                                $bottomdate = date("Y-m-d", $dateminus);
                                //echo "bottom date ".$bottomdate;
                                //next clean date retrieved from product
                                $duecleans = Salesorderdetail::find()->joinWith(['product'])
                               ->where(['<=','nextclean_date',$todaydate])
                               ->andFilterWhere(['>=','nextclean_date',$bottomdate])
                               //remove the bi-weekly cleans
                               ->andWhere(['<>','frequency','Not applicable'])
                               ->groupBy('sales_order_id')
                               ->all();
                               $i = 1;
                               //groupby sales order header id
                               foreach ($duecleans as $key => $value)
                                   {
                                         $product_id = $duecleans[$key]['product_id'];
                                         $salesorderdetail_id = $duecleans[$key]['sales_order_detail_id'];
                                         $salesorder_id = $duecleans[$key]['sales_order_id'];
                                         $url=Url::toRoute(['salesorderdetail/view', 'id' => $salesorderdetail_id]);
                                         if (!Yii::$app->user->isGuest){
                                         echo Html::a("Clean due: ".$i,  $url);
                                         echo "<br>";
                                         }
                                         $i = $i + 1;
                                   }                                
                           ?>
                        </div>
                    </div>    
                </div>
                <p1><?= Html::a ('Provide a review',['review/create'],['class' => 'btn btn-info']); ?></p1>
                <p1><?= Html::a ('View reviews',['review/index'],['class' => 'btn btn-info']); ?></p1>
                <br>
                <br>
                <h2>Quotation</h2>
                <p1><?= Html::a ('Email me a rough quote (£)',['quotation/create'],['class' => 'btn btn-info']); ?></p1>
                <br>
                <h2>Quick Links</h2>
                <p1><?= Html::a('Window Cleaning Supplies',"http://www.windowcleaningwarehouse.co.uk/unger-grade-a-scrim.html", ['class' => 'btn btn-info']) ?></p1>
                 
                
            </div>
        </div>
        
    </div>
</div>
