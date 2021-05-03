<?php
namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ContactForm;
use frontend\models\Company;
use frontend\models\Sessiondetail;
use yii\helpers\Json;
use frontend\components\Utilities;
use Yii;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    
                ],
            ],
        ];
    }
    
    public $layout = 'main';

    public function actionIndex()
    {
        $layout = 'main';
        return $this->render('index');
    }
    
    public function actionMaintenance()
    {
      return $this->render('maintenance');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', Yii::t('app','Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app','There was an error sending your message.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionGocardlesscustomercreated($redirect_flow_id)
    {
        //customer passback retrieve details
        $redirectflowid = Sessiondetail::find()->where('redirect_flow_id=:redirect_flow_id',['=',':redirect_flow_id',$redirect_flow_id])->one();
        $redirectflowid->customer_approved = 1;
        $redirectflowid->save();
        return $this->render('gocardlesscustomercreated');
    }
    
    public static function getSubCatList($postalcode_id) {
       //find all the streets in the postal area 
        $data=\frontend\models\Productsubcategory::find()
       ->where(['productcategory_id'=>$postalcode_id])
       ->select(['id','name AS name'])->asArray()->orderBy('name')->all();
       return $data;
       
    }
    
    public static function getSubCatCostList($postalcode_id) {
       //find all the streets in the postal area 
        $data=\frontend\models\Costsubcategory::find()
       ->where(['costcategory_id'=>$postalcode_id])
       ->select(['id','name AS name'])->asArray()->orderBy('name')->all();
       return $data;       
    }
    
    public static function getSubCatListb($postalcode_id) {
       //find all the streets in the postal area 
        $data=\frontend\models\Productsubcategory::find()
       ->where(['productcategory_id'=>$postalcode_id])
       ->select(['id'])->asArray()->all();
       return $data;
       
    }
    
    public static function getProdList($cat_id, $sub_id) {
        
        $data = [];
        $data=\frontend\models\Product::find()
       ->where(['productcategory_id'=>$cat_id])
       ->andWhere(['productsubcategory_id'=>$sub_id])
       ->select(['id','name'])->asArray()->orderBy('name')->all();
       return $data;
       
    }
    
    public static function getProdListb($cat_id, $subcat_id) {
        //find all the houses in the street
        $data = [];
        $data=\frontend\models\Product::find()
       ->where(['productcategory_id'=>$cat_id])
       ->andWhere(['productsubcategory_id'=>$subcat_id])      
       ->select(['id', 'productnumber AS name'])->asArray()->orderBy('name')->all();
       return $data;
       
    }
    
    public static function getCostListb($cat_id, $subcat_id) {
        //find all the houses in the street
        $data = [];
        $data=\frontend\models\Cost::find()
       ->where(['costcategory_id'=>$cat_id])
       ->andWhere(['costsubcategory_id'=>$subcat_id])      
       ->select(['id', 'costnumber AS name'])->asArray()->orderBy('name')->all();
       return $data;
       
    }
    
    public static function getProdListc($cat_id, $subcat_id) {
        //find all the houses in the street
        $data = 0;
        $data=\frontend\models\Product::find()
       ->where(['productcategory_id'=>$cat_id])
       ->andWhere(['productsubcategory_id'=>$subcat_id])      
       ->select(['id'])->count();
       return $data;
       
    }
    
    public function actionSubcat() 
    {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $cat_id = $parents[0];
            $out = self::getSubCatList($cat_id); 
            return Json::encode(['output'=>$out, 'selected'=>'']);
        }
    }
    return Json::encode(['output'=>$out, 'selected'=>'']);
    }
    
    public function actionSubcatcost() 
    {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $cat_id = $parents[0];
            $out = self::getSubCatcostList($cat_id); 
            return Json::encode(['output'=>$out, 'selected'=>'']);
        }
    }
    return Json::encode(['output'=>$out, 'selected'=>'']);
    }
    
    public function actionCos() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $ids = $_POST['depdrop_parents'];
        $cat_id = empty($ids[0]) ? null : $ids[0];
        $subcat_id = empty($ids[1]) ? null : $ids[1];
        if ($cat_id != null) {
            $out = self::getCostListb($cat_id,$subcat_id); 
            return Json::encode(['output'=>$out, 'selected'=>'']);
        }
    }
    return Json::encode(['output'=>'', 'selected'=>'']);
    }
      
    public function actionError()
    {
    $exception = Yii::$app->errorHandler->exception;
    if ($exception !== null) {
        return $this->render('error', ['exception' => $exception]);
    }
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
       
   public function actionSitemessage()
   {
       $cfirstname = Yii::$app->request->get('custfirstname');
       $cmobile = Yii::$app->request->get('custmobile');
       if (!empty($cfirstname) & !empty($cmobile) & (strlen($cmobile)==15))
       {
            $twilioService = Yii::$app->Yii2Twilio->initTwilio();
            try {
                date_default_timezone_set("Europe/London");
                $date = date('d/m/Y h:i:s a', time());
                $completemessage = $date. Yii::t('app',' Hi '). $cfirstname .Yii::t('app',' , Clean Request: ') .$cmobile;
                $message = $twilioService->account->messages->create(
                substr(Company::findOne(1)->twilio_telephone,0,3) .substr($cmobile,1), // To a number that you want to send sms
                            array(
                                "from" => Company::findOne(1)->twilio_telephone,   // From a number that you are sending
                                "body" => $completemessage, 
                            ));
                           } catch (\Twilio\Exceptions\RestException $e) {
                                echo $e->getMessage();
                                var_dump($e->getMessage());
                           }
       }
   }
   
  public function actionPayments()
  {
        return $this->render('payments');
  }
  
  public function actionReceived()
  {
      return $this->render('received');
  }

  public function actionCancelled()
  {
      return $this->render('cancelled');
  }

  public function actionPrivacypolicy()
  {
      return $this->render('privacypolicy');
  }
}
