<?php
Namespace frontend\components;
    
use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use frontend\models\Productcategory;
use frontend\models\Productsubcategory;
use frontend\models\Product;
use frontend\models\Salesorderdetail;
use frontend\models\Salesorderheader;
use frontend\models\Costcategory;
use frontend\models\Costsubcategory;
use frontend\models\Cost;
use frontend\models\Costheader;
use frontend\models\Costdetail;
use frontend\models\Quicknote;
use frontend\models\Messaging;
use frontend\models\Carousal;
use frontend\models\SessionDetail;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Tabs;
use frontend\models\Company;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\services\DirectionsRequest;
use frontend\modules\subscription\models\paypalagreement;
use frontend\modules\subscription\components\Configpaypal;
  
class Utilities extends Component
{

//delete records that the demo user inputs. This is linked to the beforeLogout event under frontend/config/main.php	
public static function delete_records()
{
    //records are deleted in reverse to the order that they were entered
    Carousal::deleteAll();
    Salesorderdetail::deleteAll(); 
    Salesorderheader::deleteAll();
    Product::deleteAll();
    Productsubcategory::deleteAll(); 
    Productcategory::deleteAll(); 
    
    Costdetail::deleteAll(); 
    Costheader::deleteAll(); 
    Cost::deleteAll();
    Costsubcategory::deleteAll(); 
    Costcategory::deleteAll();
    Quicknote::deleteAll(); 
    Messaging::deleteAll(); 
}
//delete records that the demo user inputs. This is linked to the beforeLogout event under frontend/config/main.php
public static function create_demotimestamp_directory()
{
    $basepath = \Yii::getAlias('@webroot');
    $date=date_create();
    Yii::$app->session['demo_image_timestamp_directory'] = date_timestamp_get($date);
    $dir = $basepath . "/images/demo/".Yii::$app->session['demo_image_timestamp_directory'];
    if (!is_dir($dir)){FileHelper::createDirectory($dir,0775,true);}
}

public static function delete_demotimestamp_directory()
{
    $basepath = \Yii::getAlias('@webroot');
    $dir = $basepath . "/images/demo/".Yii::$app->session['demo_image_timestamp_directory'];
    $options = [];
    Carousal::deleteAll();
    if (is_dir($dir)){FileHelper::removeDirectory($dir,$options);}
}	
	
public static function SubCatListb($postalcode_id) {
       //find all the streets in the postal area 
        $data=Productsubcategory::find()
       ->where(['productcategory_id'=>$postalcode_id])
       ->select(['id','name','lat_start','lng_start','lat_finish','lng_finish'])->asArray()->all();
       return $data;
       
}
	
public static function Street_map($map,$array,$key)
{
        $start = new LatLng(['lat' => $array[$key]['lat_start'], 'lng' => $array[$key]['lng_start']]);
        $finish = new LatLng(['lat' => $array[$key]['lat_finish'], 'lng' => $array[$key]['lng_finish']]);
        $directionsRequest = new DirectionsRequest([
              'origin' => $start,
              'destination' => $finish,
              //'waypoints' => $waypoints,
              'travelMode' => TravelMode::DRIVING
        ]);
        $polylineOptions = new PolylineOptions([
            'strokeColor' => '#FFAA00',
            'draggable' => true
        ]);
        $directionsRenderer = new DirectionsRenderer([
                'map' => $map->getName(),
                'polylineOptions' => $polylineOptions
        ]);                
        $directionsService = new DirectionsService([
              'directionsRenderer' => $directionsRenderer,
              'directionsRequest' => $directionsRequest
        ]);
        $map->appendScript($directionsService->getJs());
        
         // Display the map -finally :)
        if (!empty($array[$key]['lat_start']) && !empty($array[$key]['lng_start']) && !empty($array[$key]['lat_finish']) && !empty($array[$key]['lng_finish']))
            {
              return $map;
            }
}

public static function ProdListc($cat_id, $subcat_id) {
        //find all the houses in the street
        $data=\frontend\models\Product::find()
       ->where(['productcategory_id'=>$cat_id])
       ->andWhere(['productsubcategory_id'=>$subcat_id])      
       ->select(['id'])->count();
       return $data;
       
}

public static function ProdListd($cat_id, $subcat_id) {
        //find all the houses in the street and put the house id into the data array
        $data=\frontend\models\Product::find()
        //use the postcode ie. productcategory
       ->where(['productcategory_id'=>$cat_id])
        //use the street ie. productsubcategory
       ->andWhere(['productsubcategory_id'=>$subcat_id])
       ->andWhere(['isactive'=>1])
       ->all();
       return $data;
}

public static function productsubcategoryarray()
{
        $productcategory_id = ArrayHelper::map(Productcategory::find()->all(), 'id','id'); 
	$productcategory_name = ArrayHelper::map(Productcategory::find()->all(), 'id','name'); 
	//$productcategory_fkid = ArrayHelper::map(Productcategory::find()->all(), 'id','productsubcategory_id'); 
	$productsubcategory_id = ArrayHelper::map(Productsubcategory::find()->all(), 'id','id'); 
	$productsubcategory_name = ArrayHelper::map(Productsubcategory::find()->all(), 'id','name'); 
	$productsubcategory_fkid = ArrayHelper::map(Productsubcategory::find()->all(), 'id','productcategory_id'); 
	$arr=array();
	$i = 0;$j = 1;
	
        //go through each product category id
	foreach ($productcategory_id as $id_productcategory){
                            //assign the product name to i
		            $i= $productcategory_name[$id_productcategory];
                            //assign this product name to the array
		            $arr[$i][$j] = $productcategory_name[$id_productcategory];
                            //find each productsubcategory whose foreign key points to the productcategory
		            foreach ($productsubcategory_id as $id_productsubcategory)
		            {
		                //the foreign key psg points to pg
                                if ($productsubcategory_fkid[$id_productsubcategory] == $id_productcategory) {
		                    //echo  $id_productsubcategory . "\n";
		                    //echo  $productsubcategory_name[$id_productsubcategory] . "\n";
		                    $arr[$i][$j] = $productsubcategory_name[$id_productsubcategory]; 
		                    //echo "<br>";
		                    $j = $j+1;
		                }
		            }
		   }
	 return $arr;
}

public static function weeklycleansoverdueexample()
   {
      $dateminus = strtotime("-7 day");
      $comparedate = date("Y-m-d", $dateminus);
      $weekly = Salesorderdetail::find()
     ->joinWith('product',true)
     ->joinWith('salesOrder',true)
     ->andFilterWhere(['works_product.frequency'=>'Weekly'])
     ->andFilterWhere(['<','works_salesorderheader.clean_date',$comparedate])
     ->all();
     return $weekly;
   }

//$transid is value passed from dropdownbox on salesorderdetail/index 'transadv'
public static function soi2soi($prodid,$transid,$amounttotransfer)
{
   $arr = Product::find()->where(['id'=>$prodid])->one();
   $allsales = $arr->salesorderdetails;
   ##foreach ($allsales as $key => $value)
   foreach ($allsales as $value)
   {
       if (($value['sales_order_id']) == $transid)
       {
           $sid = $value['sales_order_detail_id'];
           $model2 = Salesorderdetail::findOne($sid);
           $model2->pre_payment = $amounttotransfer;
           $model2->save();
       };
   }
}

public static function check_for_mandates_approved()
{
    //query sessiondetails using the current user_id
    $db = Utilities::userdb_database_code();
    $all = SessionDetail::find()->where(['user_id'=>Yii::$app->user->id])
                                ->Andwhere(['customer_approved'=>1])
                                ->Andwhere(['db'=>$db])
                                ->Andwhere(['administrator_acknowledged'=>0])
                                ->count();
    return $all;    
}

public static function check_for_mandates_to_acknowledge()
{
    //query sessiondetails using the current user_id
    $db = Utilities::userdb_database_code();
    $all = Sessiondetail::find()->where(['user_id'=>Yii::$app->user->id])
                                 ->Andwhere(['customer_approved'=>1])
                                ->Andwhere(['db'=>$db])
                                ->Andwhere(['administrator_acknowledged'=>0])
                                ->all();
    return $all;    
}

public static function userLogin_set_database()
{
                if (\Yii::$app->user->can('Access db')) {
                    return \Yii::$app->db;
                }                
}

//use by every model
public static function userdb(){
      return Yii::$app->session['currentdatabase'];
}

public static function userdb_database_code(){
    
 $dbase = '';
 if ( \Yii::$app->user->can('Access db')){ $dbase = 'db';}
 return $dbase;
}

public static function subscription_exist()
{
    $one = paypalagreement::find()
    ->where(['=','user_id',Yii::$app->user->id]) 
    //the subscription has not been terminated
    ->Andwhere(['=','terminated_at',null])
    //the subscription has been created
    ->Andwhere(['<>','created_at',null])
    //the subscription has been approved by user and redirected to us
    ->Andwhere(['<>','executed_at',null])    
    //->Andwhere(['>','end_at',date('Y-m-d H:i:s', time())])
    ->one();
    if (!empty($one->agreement_id)) {
        $agreement_id = $one->agreement_id;
        //use the api to determine if subscription exists with paypal
        $newapicontext = new Configpaypal();
        $apiContext = $newapicontext->paypalconfig(); 
        $agreement = \PayPal\Api\Agreement::get($agreement_id, $apiContext);
        $status = displayRecursiveResults($agreement,'status');
        if ($status === 'verified') {return true;} else {return false;}
    }
    else {return false;}    
}

public static function displayRecursiveResults($arrayObject,$searchkey) {
    foreach($arrayObject as $key => $data) {
        if(is_array($data)) {
            \frontend\components\Utilities::displayRecursiveResults($data,$searchkey);
        } elseif(is_object($data)) {
            \frontend\components\Utilities::displayRecursiveResults($data,$searchkey);
        } else if ($key === $searchkey) {return $data;}
    }
}

public static function setLanguage()
{
  //if (!empty(Company::findOne(1)->language->one())) (Yii::$app->language = Company::findOne(1)->language;) 
  if  (!empty(Company::findOne(1)->language)){Yii::$app->language = Company::findOne(1)->language;} 
} 

public static function returnLastSignup()
{
    $array4 = Product::find()->all();
    foreach ($array4 as $key4 => $value4)
    {
        $last_cust = $array4[$key4]['id'];
    }
    return $lastcustomer = Product::findOne($last_cust);
}

public static function home_tab1_content_a()
{
    $tab1_content_a = Html::tag('tr',
                  "<td>".
                  "Last modified"
                  ."</td><td>". 
                  "Customer name "
                  ."</td><td>". 
                  "Postcode"
                  ."</td><td>".
                  "Listprice"
                  ."</td>" 
              ); //html tag tr   
    
    return $tab1_content_a;
}

public static function home_tab1_content_b()
{
    $lastcustomer = Utilities::returnLastSignup();
    $name = $lastcustomer->name;
    $url=  Url::toRoute(['product/view', 'id' => $lastcustomer->id]);
    $url_postcode =  Url::toRoute(['productcategory/view', 'id' => $lastcustomer->productcategory->id]);
    $buttonclass = ['class' => 'btn btn-info btn-lg'];
    $tab1_content_b = 
             Html::tag('tr',
                  "<td>".
                 $lastcustomer->modifieddate
                 ."</td><td>".
                 Html::a($name,$url,$buttonclass)
                 ."</td><td>". 
                 Html::a($lastcustomer->productcategory->name,$url_postcode,$buttonclass)
                 ."</td><td>".
                $lastcustomer->listprice
                 ."</td>"
              ); //html tag tr
    return $tab1_content_b;
}

public static function home_tab2_content()
{
   $tab2_content =  '';
   $todaydate = date("Y-m-d");
   $dateminus = strtotime("-33 day");
   $bottomdate = date("Y-m-d", $dateminus);
   //next clean date retrieved from product
   $duecleans = Salesorderdetail::find()->joinWith(['product'])
                               ->where(['<=','nextclean_date',$todaydate])
                               ->andFilterWhere(['>=','nextclean_date',$bottomdate])
                               //remove the bi-weekly cleans
                               ->andWhere(['<>','frequency','Not applicable'])
                               //->groupBy('sales_order_id')
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
              $tab2_content .= Html::a($duecleans[$key]['product']['name']." ".$duecleans[$key]['product']['surname']. " " .$duecleans[$key]['productcategory']['name'] ." ". $duecleans[$key]['productsubcategory']['name'], $url). Html::tag('br');
          }
          $i = $i + 1;
    } 
    return $tab2_content;
}        

public static function home_tab3_content()
{
    $todayscleans = Salesorderheader::find()
                     ->joinWith('salesorderdetails')
                     ->where(['clean_date'=>Date('Y-m-d')])
                     ->groupBy(['sales_order_id'])
                     ->all();
    $tab3_content = "";
    $tab3_content .= Html::tag('tr',
                      "<td>".
                     "Date"
                     ."</td><td>".
                     "Job Code / Run"
                     ."</td><td>"
                     ."Map to Trigger House" 
                     ."</td>"
                  );
    //html tag tr
                     
    foreach ($todayscleans as $key => $value) {
        //get the first clean in the sub array relation 'salesorderdetails' as the trigger house
        $get_productid = $todayscleans[$key]['salesorderdetails'][0]['product_id'];
        $get_productsubcategoryid = $todayscleans[$key]['salesorderdetails'][0]['productsubcategory_id'];
        $get_productcategoryid = $todayscleans[$key]['salesorderdetails'][0]['productcategory_id'];
        $name = Product::find()->where(['id' => $get_productid])->one();
        $streetname = Productsubcategory::find()->where(['id'=>$get_productsubcategoryid])->one();
        $postalcodename = Productcategory::find()->where(['id'=>$get_productcategoryid])->one();
        $url2 = "https://maps.google.com/maps?q=".ltrim($name['productnumber'], '0')." ".$streetname['name']." ".$postalcodename['name'];
        $url3 = ltrim($name['productnumber'], '0')." ".$streetname['name']." ".$postalcodename['name'];
        
        $tab3_content .= Html::tag('tr',
                          "<td>".
                         $todayscleans[$key]['clean_date']
                         ."</td><td>".
                         Html::a($todayscleans[$key]['status'],Url::toRoute(['salesorderdetail/index', 'id' => $todayscleans[$key]['sales_order_id']]))
                         ."</td><td>".
                         Html::a($url3,$url2,['class' => 'btn btn-success btn-lg','data-toggle'=>'tooltip','title'=>Yii::t('app','Goto Google maps using this address to the first house in this run.')])
                         ."</td>"
                         ); //html tag tr
        } 
    
    return $tab3_content;
}

public static function home_tab4_content()
{
    $array = Productcategory::find()->all(); 
                        $tab4_content = "";
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
                                'zoom' => 1,
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
                                $street_name = $array3[$key3]['name'];
                                //count the number of houses in each street
                                $count = Utilities::ProdListc($postalcode_id,$street_id);
                                //get all the houses numbers in the street
                                $all_houses_in_street = Utilities::ProdListd($postalcode_id,$street_id);
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
                                        //get all the house numbers in the street and concatenate
                                        $my_content = "<b>" . $street_name ."</b>" . "<br>";
                                        $url =  "https://maps.google.com/maps?q=".$street_name;
                                        foreach ($all_houses_in_street as $key =>$value){
                                            if (Yii::$app->user->can('See Prices')){
                                                $seeprices = $all_houses_in_street[$key]['listprice'];
                                            } else { $seeprices = 0;}
                                            $my_content = $my_content 
                                            . " "
                                            ."<b>"
                        . Html::a($all_houses_in_street[$key]['productnumber'],Url::toRoute(['product/view/','id'=>$all_houses_in_street[$key]['id']]))
                                            ."</b>"
                                            ." " 
                                            .$seeprices
                                            . " "
                                            . $all_houses_in_street[$key]['specialrequest']
                                            . " "
                                            . "<br>";
                                        }
                                       $final_content = $my_content
                                        .Html::a(Html::img(Url::to('@web/images/directions.png')).'  Directions',$url,['class'=>'container pt-20 rounded-square btn','style'=>['background'=>'lightblue']])
                                        ;
                                        $informationWindow = new InfoWindow([
                                           'content'=>$final_content,
                                           'position'=>$start,
                                        ]);
                                        $marker = new Marker([
                                           'position' => $start,
                                           'zIndex'=>999,
                                           'title' => $street_name,
                                        ]);
                                        $marker->attachInfoWindow($informationWindow);
                                        // Add marker to the map       
                                        $map->addOverlay($marker);
                                        $map->appendScript($directionsService->getJs());
                                        $atleast1 = $atleast1 + 1;
                                } 
                                $totalcount = $count + $totalcount;
                            }
                            //the map will not display 
                            if ($atleast1>0) 
                                {
                                   $tab4_content .= "<tr><td><h1>&nbsp&nbsp".$map->display()."</h1></td></tr>";                                   
                                }
                            }//if (!empty($array3))
                            $tab4_content .=  "<tr><td><h1>&nbsp&nbsp".$stripcodename." (".$totalcount.")"."</h1></td></tr>";
                        }//
                        $totcount = Product::find()->where(['>=','sellenddate',Date("Y-m-d")])->count();
                        $tab4_content .= "<tr><td><h5>Total cleans: ".$totcount. "</h5><tr><td>";
                        return $tab4_content;
}//tab4 function//tab4 function  

public static function  Home_tabs_service() 
{
        $font_size = 'font-size:20px ';
        $header_options = ['style'=> $font_size];
        $options = ['style'=> $font_size];
        echo Tabs::widget([
        'items' => [
           [
                'label' => 'Last Customer',
                'headerOptions' => $header_options,
                'options'=> $options,
                //the admininstrator can only see the Last Customer
                'visible' => Yii::$app->user->can('Manage Admin'),
                'content' => '<table border="1" class="table striped bordered">'
                             . Utilities::home_tab1_content_a() 
                             . Utilities::home_tab1_content_b()
                             .'</table>', 
                'active' => true
           ],
           [
               'label' => 'Cleans Due',
               'headerOptions' => $header_options,               
               'options'=> $options,
               //the employee can see the Cleans Due
               'visible' => Yii::$app->user->can('Manage Basic'),
               'content' => '<table border="1" class="table striped bordered">'
                            .'<tr><td>'
                            . Utilities::home_tab2_content()
                            .'</td></tr>'
                            .'</table>',
           ],
           [
               'label' => 'Todays Cleans',
               'headerOptions'=> $header_options,               
               'options'=> $options,
                //the employee can see Todays Cleans
               'visible' => Yii::$app->user->can('Manage Basic'),
               'content' =>  '<table border="1" class="table striped bordered">'
                              .Utilities::home_tab3_content()
                              .'</table>',
           ],
           [
               'label' => 'Postcode Maps',
               'headerOptions'=> $header_options,
                //the employee can see the Postcode Maps where he has to go to
               'visible' => Yii::$app->user->can('Manage Basic'),
               'options'=> $options,
               'content' =>  '<table border="1" class="table striped bordered">'
                              .Utilities::home_tab4_content()
                              .'</table>',
           ], 
           [
               'label' => 'Customer Search',
               'headerOptions'=> $header_options,
               'visible' => Yii::$app->user->can('Manage Basic'),
               'options'=> $options,
               'url'=> Url::toRoute(['product/search']),
           ],
           [
               'label' => 'Tree',
               'headerOptions'=> $header_options,
               'visible' => Yii::$app->user->can('Manage Basic'),
               'options'=> $options,
               'url'=> Url::toRoute(['krajeeproducttree/index']),
           ],  
           [
               'label' => 'Postcode Finder',
               'headerOptions'=> $header_options,
               'options'=> $options,
               'url'=> "http://pcf.raggedred.net/",
           ],  
        ],
        ]);       
}
}// class