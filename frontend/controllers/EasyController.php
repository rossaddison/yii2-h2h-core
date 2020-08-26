<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Easy;
use frontend\models\Productsubcategory;
use frontend\models\Product;
use yii\web\Controller;
use yii\filters\VerbFilter;

class EasyController extends Controller
{
    
    public function behaviors()
    {
        return [
                'verbs' => 
                            [
                            'class' => VerbFilter::className(),
                            'actions' =>    [
                                                'delete' => ['POST'],
                                            ],
                            ],
                'access' => 
                            [
                            'class' => \yii\filters\AccessControl::className(),
                            'only' => ['selectedhousenumbers','index'],
                            'rules' => [
                            [
                              'allow' => true,
                              'verbs' => ['POST']
                            ],
                            [
                              'allow' => true,
                              'roles' => ['@'],
                            ],
                            ],
                            ],            
        ];
         
    }
    public function actionInitialize()
    {
            $model = new Easy();
            $street = Productsubcategory::find()
                        ->where(['sort_order'=>500])
                        ->count();
            //$housenumbers = $model->housenumber_ids;
            $housenumbers = [];
            if ($model->load(Yii::$app->request->post())) {
                    //determine if only one street has been flagged 
                    if ($street === '1'){
                         $street_house = Productsubcategory::find()
                        ->where(['sort_order'=>500])
                        ->one();
                         $housenumber = 0;
                         $housenumbers = $_POST['Easy']['housenumber_ids'];
                         if (is_array($housenumbers) && (!empty($housenumbers))) {
                            foreach($housenumbers as $key => $value) {
                                $product = new Product();
                                $product->productcategory_id = $street_house->productcategory_id;
                                $product->productsubcategory_id = $street_house->id;
                                $product->name="Firstname";
                                $product->surname="Surname";
                                if (($value+1) < 10){
                                    $housenumber = '00'.($value+1);}
                                if ((($value+1) > 10) && (($value+1) < 100)){
                                    $housenumber = '0'.($value+1);}
                                if ((($value+1) > 100) || (($value+1) == 100)){
                                    $housenumber = $value+1;}
                                $product->productnumber=$housenumber;
                                $product->postcodefirsthalf="";
                                $product->postcodesecondhalf="";
                                $product->contactmobile='09999999999';
                                $product->email='email@email.com';
                                $product->specialrequest="";
                                $product->frequency= "Monthly";
                                $product->listprice=0;
                                $product->sellstartdate=date("Y-m-d"); 
                                $product->isactive=true;
                                $product->jobcode=null;
                                $product->save();
                            }
                        } //if (is_array($housenumbers) && (!empty($housenumbers)))
                    } //If ($street === 1){
                    else 
                    {
                        Yii::$app->session->setFlash('warning', 'More than one record contains a flag of 99999 for your sort_order field.');
                    }
                    return $this->redirect(['/product/index']);
                    //return $this->render('testing',['street_house' => $street_house,'housenumbers'=>$housenumbers,'housenumber'=>$housenumber]);
            }// if ($model->load(Yii::$app->request->post()))
            //initialise default items list 1 to 2000
            //this should be sufficient for most neighbourhoods
            $items = range($model->start, $model->finish);
            return $this->render('favourite', [
                'model' => $model,
                'items' => $items
            ]);
    }
}
