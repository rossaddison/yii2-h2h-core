<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Company;
use frontend\models\Product;
use frontend\models\Salesorderdetail;
use frontend\models\Salesorderheader;
use frontend\models\Instruction;
use frontend\models\Paymentrequest;
use GoCardlessPro\Core\Exception\InvalidStateException;
use frontend\components\Utilities;
use frontend\models\ProductSearch;
use frontend\models\Sessiondetail;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\behaviors\TimestampBehavior;
use yii\di\ServiceLocator;


class ProductController extends Controller
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
                'timestamp' => 
                            [
                            'class' => TimestampBehavior::className(),
                            'attributes' => [
                                                ActiveRecord::EVENT_BEFORE_INSERT => ['nextclean_date',
                                                'modified_date'],
                                                ActiveRecord::EVENT_BEFORE_UPDATE => ['modified_date'],
                                            ],
                            ],
                'access' => 
                            [
                              'class' => \yii\filters\AccessControl::className(),
                              'only' => ['index','create','view','update','delete','creategocardlesscustomer','doit','spreadsheet','subcat','getSubcatlist'],
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
    
    public function actionSubcat() 
    {
        if (!\Yii::$app->user->can('Create House')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to create a house.'));
        }
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::Subcatlist($cat_id);
                return Json::encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return Json::encode(['output'=>$out, 'selected'=>'']);
    }
    
    public static function Subcatlist($postalcode_id) {
       //find all the streets in the postal area 
       $data=\frontend\models\Productsubcategory::find()
       ->where(['productcategory_id'=>$postalcode_id])
       ->select(['id','name AS name'])->asArray()->orderBy('name')->all();
       return $data;
    } 
    
    public function actionIndex()
    {   
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'productcategory_id' => [
                    'asc' => ['productcategory_id' => SORT_ASC],
                    'desc' => ['productcategory_id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
              'productcategory_id' => SORT_ASC,
            ]
          ]); 
        
        if (Yii::$app->request->post('hasEditable')) {
        $editablekey = Yii::$app->request->post('editableKey');
        $model = Product::findOne($editablekey);
        $out = Json::encode(['output'=>'', 'message'=>'']);
        $post = [];
        $posted = current($_POST['Product']);
        $post = ['Product' => $posted];
        if ($model->load($post)) {
            $model->save();
        }
        $output = '';
        if (isset($posted['listprice'])) {
           $output = Yii::$app->formatter->asDecimal($model->listprice, 2);
        }
        return Json::encode(['output'=> $output, 'message'=>'']);
       }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCondensed()
    {   
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=0;
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'productcategory_id' => [
                    'asc' => ['productcategory_id' => SORT_ASC],
                    'desc' => ['productcategory_id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
              'productcategory_id' => SORT_ASC,
            ]
          ]); 
        
        if (Yii::$app->request->post('hasEditable')) {
        $editablekey = Yii::$app->request->post('editableKey');
        $model = Product::findOne($editablekey);
        $out = Json::encode(['output'=>'', 'message'=>'']);
        $post = [];
        $posted = current($_POST['Product']);
        $post = ['Product' => $posted];
        if ($model->load($post)) {
            $model->save();
        }
        $output = '';
        if (isset($posted['listprice'])) {
           $output = Yii::$app->formatter->asDecimal($model->listprice, 2);
        }
        return Json::encode(['output'=> $output, 'message'=>'']);
       }
        return $this->render('condensed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionSearch()
    {   
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'productcategory_id' => [
                    'asc' => ['productcategory_id' => SORT_ASC],
                    'desc' => ['productcategory_id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
              'productcategory_id' => SORT_ASC,
            ]
          ]); 
        
        if (Yii::$app->request->post('hasEditable')) {
        $editablekey = Yii::$app->request->post('editableKey');
        $model = Product::findOne($editablekey);
        $out = Json::encode(['output'=>'', 'message'=>'']);
        $post = [];
        $posted = current($_POST['Product']);
        $post = ['Product' => $posted];
        if ($model->load($post)) {
            $model->save();
        }
        $output = '';
        if (isset($posted['listprice'])) {
           $output = Yii::$app->formatter->asDecimal($model->listprice, 2);
        }
        return Json::encode(['output'=> $output, 'message'=>'']);
       }
        
        return $this->render('search_for_customer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('Create House')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to create a house.'));
        }
        $model = new Product();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->jobcode <> null){
                //find the latest jobcode
                $rows = Salesorderheader::find()->where(['status'=>$model->jobcode])->all();
                $latest_salesorder_id = 0;
                foreach ($rows as $key => $value)
                {
                  $latest_salesorder_id = $rows[$key]['sales_order_id'];
                  $latest_cleandate = $rows[$key]['clean_date'];
                }
                if ($latest_salesorder_id > 0){
                    $model3 = new Salesorderdetail();
                    $model3->sales_order_id = $latest_salesorder_id;
                    $model3->cleaned = "Not Cleaned";
                    if ($model->frequency == "Weekly")
                     {
                             $date = strtotime("+7 day");
                             $addeddate = date($latest_cleandate , $date);
                             $model3->nextclean_date = $addeddate;
                     };
                     if ($model->frequency == "Monthly")
                         {
                            $date = strtotime("+30 day");
                            $addeddate = date($latest_cleandate , $date);
                            $model3->nextclean_date = $addeddate;
                         };
                     if ($model->frequency == "Fortnightly")
                         {
                            $date = strtotime("+15 day");
                            $addeddate = date($latest_cleandate , $date);
                            $model3->nextclean_date = $addeddate;
                         };
                     if ($model->frequency == "Every two months")
                         {
                            $date = strtotime("+60 day");
                            $addeddate = date($latest_cleandate , $date);
                            $model3->nextclean_date = $addeddate;
                         }; 
                    if ($model->frequency == "Not applicable")
                         {
                            $model3->nextclean_date = date($latest_cleandate); 
                         };          
                    $model3->productcategory_id = $model->productcategory_id;
                    $model3->productsubcategory_id = $model->productsubcategory_id;
                    if (Instruction::find()->count() === 0 ) {$model3->instruction_id = 0;}
                    else {$model3->instruction_id = 1;}
                    $model3->product_id = $model->id;
                    $model3->unit_price = $model->listprice;
                    $model3->line_total = $model->listprice;
                    $model3->paid =0;
                    $model3->save();
                    Yii::$app->session->setFlash('kv-detail-success', Yii::t('app','Saved record successfully to latest daily clean '). Salesorderheader::findOne($latest_salesorder_id)->clean_date . Yii::t('app','with jobcode ').Salesorderheader::findOne($latest_salesorder_id)->status . Yii::t('app','Daily Job Sheet: <a href="') . Url::to(['salesorderdetail/index/'.$latest_salesorder_id]) . '" class="btn btn-sm btn-info">
                                                                      .<i class="glyphicon glyphicon-hand-right"></i>  '.Yii::t('app','Click here</a> to proceed.'));
                } else {
                    Yii::$app->session->setFlash('kv-detail-warning', Yii::t('app','Jobcode ').$model->jobcode . Yii::t('app',' not found. House saved but not saved to latest daliy clean. Copy the house to the daily clean once you have created the daily clean.'));
                }
                
            }
                         return $this->redirect(['view', 'id' => $model->id]);
        } else {
        $model->sellstartdate = date('Y-m-d');
        //https://www.yiiframework.com/wiki/806/render-form-in-popup-via-ajax-create-and-update-with-ajax-validation-also-load-any-page-via-ajax-yii-2-0-2-3#how-to-use-a-modal-with-ajax-below-is-any-item-via-ajax
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('create', [
                            'model' => $model
                ]);
            } else {
                return $this->render('create', [
                        'model' => $model,
                ]); 
            }
      }
    }
    
    public function actionView($id) {
        $model=$this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', Yii::t('app','Saved record successfully'));
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('view', ['model'=>$model]);
        }
    }
    
    public function actionImport() {
        
        $searchModel = new ProductSearch();
        
        return $this->render('_import', ['model' => $searchModel]);
    }
        
    public function actionDelete() {
        if (!\Yii::$app->user->can('Delete House')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete a house.'));
        }        
        try {
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['housedelete'])) {
            $id = $post['id'];
            //https://github.com/yiisoft/yii2/issues/15782
            if ($this->findModel($id)->delete()) {
              Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
              Yii::$app->response->content = Json::encode([
              'success' => true,
              'messages' => ['kv-detail-info' => Yii::t('app','The house # ') . $id . Yii::t('app',' was successfully deleted.')]
              ]);
            } 
          }
       }
        catch (\Exception $e)
       {
              Yii::$app->response->content  = Json::encode([
                   'success' => false,
                   'messages' => [
                       'kv-detail-error' => Yii::t('app','Cannot delete the house # ') . $id . Yii::t('app','. It exists on Daily Clean')
                     . Yii::t('app',' schedule(s) already. Delete this house on these Daily Cleans first please.')
                    ]
               ]);
       }
   } 
   
   public function actionDoit()
   {
      //sorder is the dropdownbox specific date's (w9:product/index) sales order id
      $dailyclean_id = Yii::$app->request->get('sorder');
      $keylist = Yii::$app->request->get('keylist');
      //work through the houses that have been selected to be copied
      foreach ($keylist as $key => $value)
      {
                    $model = Product::findOne($value);
                    //prevent house duplicates
                    $q = new Query();
                    if  ($q->select('*')->from('works_salesorderdetail')->where(['sales_order_id' => $dailyclean_id])->andWhere(['product_id'=>$value])->exists()) 
                          {
                            Yii::$app->session->setFlash('kv-detail-success',$dailyclean_id ); 
                            exit();
                          }
                    else {
                    $model2 = new Salesorderdetail();
                    //the sales order id for the specific daily clean that we are copying to
                    $model2->sales_order_id = $dailyclean_id;
                    //create the next clean date
                    if ($model->frequency == "Weekly")
                    {
                            $date = strtotime("+7 day");
                            $addeddate = date("Y-m-d" , $date);
                            $model2->nextclean_date = $addeddate;
                    };
                    if ($model->frequency == "Monthly")
                        {
                           $date = strtotime("+30 day");
                           $addeddate = date("Y-m-d" , $date);
                           $model2->nextclean_date = $addeddate;
                        };
                    if ($model->frequency == "Fortnightly")
                        {
                           $date = strtotime("+15 day");
                           $addeddate = date("Y-m-d" , $date);
                           $model2->nextclean_date = $addeddate;
                        };
                    if ($model->frequency == "Every two months")
                        {
                           $date = strtotime("+60 day");
                           $addeddate = date("Y-m-d" , $date);
                           $model2->nextclean_date = $addeddate;
                        }; 
                    if ($model->frequency == "Not applicable")
                        {
                           $model2->nextclean_date = date("Y-m-d"); 
                        };     
                    $model2->order_qty=1;
                    $model2->unit_price = $model->listprice;
                    $model2->line_total = $model2->unit_price;
                    $model2->product_id = $value;
                    $model2->paid = 0;
                    $model2->productcategory_id = $model->productcategory_id;
                    $model2->productsubcategory_id = $model->productsubcategory_id;
                    if (Instruction::find()->count() === 0 ) {$model2->instruction_id = 0;}
                    else {$model2->instruction_id = 1;}
                    $model2->save();
                    }
      }
      return;
   }
       
   public function actionCreategocardlesscustomer()
    {
       $keylist = Yii::$app->request->get('keylist');
       //closure error here ....$comp = Company::findOne(1)->one();
       $source = Url::to('@frontend/images/gocardless.jpg');
       $sessionid = Yii::$app->session->getId();
       $message = '';
       $message_all = '';
       if (!empty($keylist)){
       foreach ($keylist as $key => $value)
       {
         $model = $this->findModel($value);
         if ($model !== null) 
         { 
             if ((empty($model->email)||(empty(Company::findOne(1)->email)))){throw new NotFoundHttpException(Yii::t('app','Either From: Company Email address does not exit or To: Customer Email address does not exist for House ID: ').$model->id. Yii::t('app',' Please make sure both are filled in. Company email address can be entered here. ').Url::toRoute('company/index'));}
             $client = new \GoCardlessPro\Client([
             'access_token' => Company::findOne(1)->gc_accesstoken,
            //'environment' => $comp->gc_live_or_sandbox == 'SANDBOX' ? \GoCardlessPro\Environment::SANDBOX : \GoCardlessPro\Environment::LIVE ,
             'environment' => Company::findOne(1)->gc_live_or_sandbox == 'SANDBOX' ? \GoCardlessPro\Environment::SANDBOX : \GoCardlessPro\Environment::LIVE ,
            ]);
            $redirectFlow = $client->redirectFlows()->create([
              'params' => [
                "description" => Yii::t('app','Clean'),
                "session_token" => $sessionid,
                "success_redirect_url" => Company::findOne(1)->gc_live_or_sandbox == 'SANDBOX' ? Url::to(['site/gocardlesscustomercreated'], 'http') : Url::to(['site/gocardlesscustomercreated'], 'https') ,
                "prefilled_customer" => [
                "given_name" => $model->name,
                "family_name" => $model->surname,
                "email" => $model->email,
                "address_line1" => $model->productnumber." ".$model->productsubcategory->name,
                "city" => Company::findOne(1)->address_area2,
                "postal_code" => $model->postcodefirsthalf." ".$model->postcodesecondhalf,
                ]//prefilled customer
             ] //params
           ]);//$redirectFlow
           
         } //$model null
         $model->mandate = $redirectFlow->redirect_url;
         $model_sessiondetail = New Sessiondetail();
         //$model_sessiondetail->session_detail_id;
         $model_sessiondetail->session_id = $sessionid;
         $model_sessiondetail->redirect_flow_id = $redirectFlow->id;  
         $model_sessiondetail->db =  Utilities::userdb_database_code();
         $model_sessiondetail->product_id = $model->id;
         $model_sessiondetail->user_id = Yii::$app->user->id;
         $model_sessiondetail->save();
         
         ///////////////////////////////////////////////////////
         
       if (!empty(Company::findOne(1)->smtp_transport_host) && !empty(Company::findOne(1)->smtp_transport_username) && !empty(Company::findOne(1)->password) && !empty(Company::findOne(1)->port) && !empty(Company::findOne(1)->encryption))  
       {
           $locator = new ServiceLocator;
           $locator->set('mailer', [
              'class' => 'yii\swiftmailer\Mailer',
              'enableSwiftMailerLogging' =>false,
              'useFileTransport' => false,
              'transport' => ['class' => 'Swift_SmtpTransport',
                                'host' => Company::findOne(1)->smtp_transport_host,
                                'username' => Company::findOne(1)->smtp_transport_username,
                                'password' => Company::findOne(1)->password,
                                'port' => Company::findOne(1)->port,
                                'encryption' => Company::findOne(1)->encryption,
                             ]
                ]);
                $mymailer = $locator->mailer;
                $send = $mymailer->compose()
                ->setFrom(Company::findOne(1)->email)
                ->setTo($model->email)
                ->setBcc(Company::findOne(1)->email)
                ->setSubject(Company::findOne(1)->name. Yii::t('app',': Cleaning Direct Debit mandate needs to be approved by you within 30 minutes from this time: '). date('Y-m-d H:i:s'))
                //->setTextBody('Hello. We have created a variable direct debit mandate through Gocardless that you will approve each time payment is required from you.')
                ->setHtmlBody(Yii::t('app','Dear Customer,')
                    .'<br>'
                    . Yii::t('app','We have created a variable direct debit mandate link to Gocardless for you.')
                    . '<br>'
                    . Yii::t('app','Here is the link to the Gocardless secure Website where you will be required to enter your details. Please click on this link.')
                     .'<br>'
                     .'<br>'
                    . Html::a(Yii::t('app','Gocardless Variable Direct Debit Mandate'),$redirectFlow->redirect_url)
                    .'<br>'
                     .'<br>'
                    . Yii::t('app','At no stage do we store any of your bank details. This is handled by Gocardless. Once you have approved the direct debit mandate we will, in the future, be able to issue you with a payment amount request through the Gocardless website. </b>')
                    . Yii::t('app','We will send you an acknowledgment confirmation email once you have approved this once-off mandate. You should be redirected to our website once you have approved the mandate. </b>')
                    .'<br>'
                    .'<br>'
                    . Yii::t('app','Regards')
                    .'<br>'
                    .'<br>'
                    . Yii::t('app','Director of ').Company::findOne(1)->name)
                     .'<br>'
                    .'<br>'
                    . Yii::t('app','More information on how GoCardless processes your personal data and your data protection rights, including your right to object, is available at '). Html::a('Gocardless',Url::to('https://www.gocardless.com/legal/privacy/')) 
                ->send();
                $model->save();
                $message = Yii::t('app','Gocardless Variable Direct Debit Mandate Request sent from ') . Company::findOne(1)->email . Yii::t('app',' to ').  $model->email . Yii::t('app',' for customer ID: '). Html::a($model->id,Url::to(['Product/View/'.$model->id])). Yii::t('app',' The customer will be redirected to this site once they have approved the Mandate. A simple flash message will be displayed to them. You will acknowledge receipt of the mandate by pressing a button on the main menu above House. This updates your records and sends an acknowledgement of receipt of mandate confirmation email to the customer with a confirmation link within their email.');
                $message_all = $message_all ."  ".$message;
       } //foreach
       else 
       {
           $send = Yii::$app->mailer->compose()
            ->setFrom(Company::findOne(1)->email)
                ->setTo($model->email)
                ->setBcc(Company::findOne(1)->email)
                ->setSubject(Company::findOne(1)->name. Yii::t('app',': Cleaning Direct Debit mandate needs to be approved by you within 30 minutes from this time: '). date('Y-m-d H:i:s'))
                //->setTextBody('Hello. We have created a variable direct debit mandate through Gocardless that you will approve each time payment is required from you.')
                ->setHtmlBody(Yii::t('app','Dear Customer,')
                    .'<br>'
                    . Yii::t('app','We have created a variable direct debit mandate link to Gocardless for you.')
                    . '<br>'
                    . Yii::t('app','Here is the link to the Gocardless secure Website where you will be required to enter your details. Please click on this link.')
                     .'<br>'
                    . Html::a('Gocardless Variable Direct Debit Mandate',$redirectFlow->redirect_url)
                    .'<br>'
                    . Yii::t('app','At no stage do we store any of your bank details. This is handled by Gocardless. Once you have approved the direct debit mandate we will be able to issue you with a payment amount request through the Gocardless website. </b>')
                    . Yii::t('app','Please reply to this email once you have approved the mandate. ')
                    .'<br>'
                    .'<br>'
                    . Yii::t('app','Regards')
                    .'<br>'
                    .'<br>'
                    . Yii::t('app','Director of ').Company::findOne(1)->name)
                    .'<br>'
                    .'<br>'
                    . Yii::t('app','More information on how GoCardless processes your personal data and your data protection rights, including your right to object, is available at '). Html::a('Gocardless',Url::to('https://www.gocardless.com/legal/privacy/')) 
                ->send();
                $model->save();
                $message = Yii::t('app','Gocardless Variable Direct Debit Mandate Request sent from ') .Company::findOne(1)->email . Yii::t('app',' to ').  $model->email . Yii::t('app',' for customer ID: '). Html::a($model->id,Url::to(['Product/View/'.$model->id])). Yii::t('app',' The customer will be redirected to this site once they have approved the Mandate. A simple flash message will be displayed to them. You will acknowledge receipt of the mandate by pressing a button on the main menu above House. This button will only appear once the mandate has been approved. This updates your records and sends an acknowledgement of receipt of mandate confirmation email to the customer with a confirmation link within their email.');
                $message_all = $message_all ."  ".$message . "<br><br>";
       } //else      
      } //foreach
      Yii::$app->session->setFlash('kv-detail-success',$message_all ); 
      return $this->redirect(['view', 'id' => $model->id]);
      } //not empty keylist
      else {throw new NotFoundHttpException(Yii::t('app','No tick selected.'));}
   }
   
   //https://developer.gocardless.com/api-reference/#payments-create-a-payment
   
   public function actionRequestpayment()
   {
      if (!\Yii::$app->user->can('Update Daily Job Sheet')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update a daily jobsheet.'));
      } 
   $keylist = Yii::$app->request->get('keylist'); 
   $message = '';
   $message_all = '';
   if (!empty($keylist)){
       foreach ($keylist as $key => $value)
       {
         $model = $this->findModel($value);
         if ($model !== null) 
         { 
             if ((empty($model->email)||(empty(Company::findOne(1)->email)))){throw new NotFoundHttpException(Yii::t('app','Either From: Company Email address does not exit or To: Customer Email address does not exist for House ID: ').$model->id. Yii::t('app',' Please make sure both are filled in. Company email address can be entered here. ').Url::toRoute('company/index'));}
             if ((empty($model->mandate) || (empty($model->gc_number)))){throw new NotFoundHttpException(Yii::t('app','Either Mandate or Gocardless Customer Number does not exist for House ID: ').$model->id. Yii::t('app',' Payments must be made against a valid mandate and customer registered on Gocardless.com'));}       
                    $rows_2  = $model->salesorderdetails;
                    $minitotal = 0.00;
                    $print = "";
                    foreach ($rows_2 as $key_2 => $value_2)
                             {
                               if ($rows_2[$key_2]['paid'] < $rows_2[$key_2]['unit_price'])
                               {
                                   $minitotal += $rows_2[$key_2]['unit_price']; 
                                   $getdate_id = $rows_2[$key_2]['sales_order_id']; 
                                   $getdate = Salesorderheader::find()->where(['sales_order_id'=>$getdate_id])->one();
                                   $print .= $getdate['clean_date'] . "    &pound " . $rows_2[$key_2]['unit_price']. "<br>";
                                   
                                   //if customers do not always pay full amount $subtotal -= $rows[$key]['paid'];
                               }
                             }
                     $minitotal = Yii::$app->formatter->asDecimal($minitotal, 2); 
                     if ($minitotal < 1) {throw new NotFoundHttpException(Yii::t('app','Your total of ') . $minitotal . Yii::t('app','does not equal or exceed the minimum of 1 local currency.'));}
                      $client = new \GoCardlessPro\Client(array(
                      'access_token' => Company::findOne(1)->gc_accesstoken,
                      'environment'  => Company::findOne(1)->gc_live_or_sandbox == 'SANDBOX' ? \GoCardlessPro\Environment::SANDBOX : \GoCardlessPro\Environment::LIVE ,
                    ));
                    try { 
                    $client->payments()->create([
                      "params" => [
                                   //convert to pound
                                   //amount is in pence
                                   "amount" =>  $minitotal * 100,
                                   //change the currency code in frontend/config/main.php
                                   "currency" => \Yii::$formatter->currencyCode,
                                   "metadata" => [
                                     "order_dispatch_date" => date('Y-m-d'), 
                                   ],
                                   "links" => [
                                     "mandate" => $model->mandate,
                                   ]],
                                   "headers" => [
                                    "Idempotency-Key" => "IK".random_int(1000000,9999999)
                                  ]
                    ]);
                    //record the payment request id in the payment request table
                    $rows_2  = $model->salesorderdetails;
                    foreach ($rows_2 as $key_2 => $value_2)
                             {
                                   $paymentrequest = New Paymentrequest();
                                   $paymentrequest->gc_payment_request_id = $client->id;
                                   $paymentrequest->sales_order_detail_id = $rows_2[$key_2]['sales_order_detail_id'];
                                   $paymentrequest->status = $client->status;
                                   $paymentrequest->save();
                             }
                             
                    //https://github.com/gocardless/gocardless-pro-php
                    } catch (InvalidStateException $e){
                        $message = Yii::t('app','System message: ') . $e->getMessage();
                        $message_all = $message_all ."  ". $message . "<br><br>";
                        throw new \yii\web\HttpException(424,$message );
                    } catch (ValidationFailedException $e){
                        $message = Yii::t('app','System message: ') . $e->getMessage();
                        $message_all = $message_all ."  ". $message . "<br><br>";
                        throw new \yii\web\HttpException(424,$message );
                    }
        } //  if ($model !== null)
        if (!empty(Company::findOne(1)->smtp_transport_host) && !empty(Company::findOne(1)->smtp_transport_username) && !empty(Company::findOne(1)->password) && !empty(Company::findOne(1)->port) && !empty(Company::findOne(1)->encryption))  
       {
           $locator = new ServiceLocator;
           $locator->set('mailer', [
              'class' => 'yii\swiftmailer\Mailer',
              'enableSwiftMailerLogging' =>false,
              'useFileTransport' => false,
              'transport' => [  
                                'class' => 'Swift_SmtpTransport',
                                'host' => Company::findOne(1)->smtp_transport_host,
                                'username' => Company::findOne(1)->smtp_transport_username,
                                'password' => Company::findOne(1)->password,
                                'port' => Company::findOne(1)->port,
                                'encryption' => Company::findOne(1)->encryption,
                             ]
                ]);
                $mymailer = $locator->mailer;
                $send = $mymailer->compose()
                ->setFrom(Company::findOne(1)->email)
                ->setTo($model->email)
                ->setBcc(Company::findOne(1)->email)
                ->setSubject(Company::findOne(1)->name. Yii::t('app',': Payment request: '). date('Y-m-d'))
                //->setTextBody('Hello. We have created a variable direct debit mandate through Gocardless that you will approve each time payment is required from you.')
                ->setHtmlBody(Yii::t('app','Dear Customer,')
                    . '<br>'
                    . '<br>'
                    . Yii::t('app','Payment is due now for: ')
                    . '<br>'
                    . $print
                    . '<br>'
                    . '<br>'
                    . Yii::t('app','Total:     '). Company::findOne(1)->currency_prefix . $minitotal
                    . '<br>'
                    . Yii::t('app','Gocardless will be emailing you shortly with a 3 day Direct Debit Advance Notice in order for you to arrange for any cancellation if you are not happy with the above amount. ')
                    . Yii::t('app','Please contact us on '). Company::findOne(1)->telephone . Yii::t('app','should you wish to cancel within the next 3 days.  ')
                    . '<br>'
                    . Yii::t('app','Regards')
                    . '<br>'
                    . '<br>'
                    . Yii::t('app','Director of ').Company::findOne(1)->name
                    . '<br>'
                    . '<br>'
                    . Yii::t('app','We use GoCardless to process your Direct Debit payments. More information on how GoCardless processes your personal data and your data protection rights, including your right ')
                    . Yii::t('app','to object, is available at '). Html::a('Gocardless',Url::to('https://www.gocardless.com/legal/privacy/'))) 
                ->send();
                $model->save();
                $message = Yii::t('app','Payment Request sent from ') .Company::findOne(1)->email . Yii::t('app',' to ').  $model->email . Yii::t('app',' for customer ID: '). Html::a($model->id,Url::to(['Product/View/'.$model->id])) . Yii::t('app',' Firstname: ') . $model->name . Yii::t('app',' Surname: ') . $model->surname . Yii::t('app',' Customer Gocardless Mandate Number: ') .$model->gc_number . Yii::t('app',' Amount: '). Company::findOne(1)->currency_prefix . (int)$minitotal;
                $message_all = $message_all ."  ".$message . "<br><br>";
       } //!empty(Company::findOne(1)
       else 
       {
           $send = Yii::$app->mailer->compose()
            ->setFrom(Company::findOne(1)->email)
                ->setTo($model->email)
                ->setBcc(Company::findOne(1)->email)
                ->setSubject(Company::findOne(1)->name. Yii::t('app',': Payment request: '). date('Y-m-d'))
                //->setTextBody('Hello. We have created a variable direct debit mandate through Gocardless that you will approve each time payment is required from you.')
                ->setHtmlBody(Yii::t('app','Dear Customer,')
                    .'<br>'
                    .'<br>'
                    . Yii::t('app','Payment is due now for: ')
                    . '<br>'
                    . $print
                    . '<br>'
                    . '<br>'
                    . Yii::t('app','Total: ').Company::findOne(1)->currency_prefix . $minitotal
                    . '<br>'
                    . Yii::t('app','Gocardless will be emailing you shortly with a 3 day Direct Debit Advance Notice in order for you to arrange for any cancellation if you are not happy with the above amount. ')
                    . Yii::t('app','Please contact us on '). Company::findOne(1)->telephone . Yii::t('app','should you wish to cancel within the next 3 days.  ')
                    . '<br>'
                    . Yii::t('app','Regards')
                    . '<br>'
                    . '<br>'
                    . Yii::t('app','Director of ').Company::findOne(1)->name
                    . '<br>'
                    . '<br>'
                    . Yii::t('app','We use GoCardless to process your Direct Debit payments. More information on how GoCardless processes your personal data and your data protection rights, including your right to object, is available at '). Html::a('Gocardless',Url::to('https://www.gocardless.com/legal/privacy/'))) 
                ->send();
                $model->save();
                $message = Yii::t('app','Payment Request sent from ') .Company::findOne(1)->email . Yii::t('app',' to ').  $model->email . Yii::t('app',' for customer ID: '). Html::a($model->id,Url::to(['Product/View/'.$model->id])) . Yii::t('app',' Firstname: ') . $model->name . Yii::t('app',' Surname: ') . $model->surname . Yii::t('app',' Customer Gocardless Mandate Number: ') .$model->gc_number . Yii::t('app',' Amount: ').Company::findOne(1)->currency_prefix . (int)$minitotal;
                $message_all = $message_all ."  ".$message . "<br><br>";
       } //else
              
       } //foreach ($keylist as $key => $value)
      } //if (!empty($keylist)) 
      Yii::$app->session->setFlash('kv-detail-success',$message_all );
      return $this->redirect(['view', 'id' => $model->id]);
   }
      
   public function actionPaidticked()
    {
      if (!\Yii::$app->user->can('Update Daily Job Sheet')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update a daily jobsheet.'));
      }    
      $keylist = Yii::$app->request->get('keylist');
      if (!empty($keylist)){
      foreach ($keylist as $key => $value)
      {
                    $model = Salesorderdetail::findOne($value);
                    if ($model !== null) {
                        $model->paid = $model->unit_price;
                        $model->cleaned = "Cleaned";
                        $model->save();
                    }
      }
      }
      else {throw new NotFoundHttpException(Yii::t('app','No ticks selected.'));}
      
    } 
    
    public function actionAcknowledge_mandates()
    {
        $message = '';
        $message_all = '';
        $keylist = Utilities::check_for_mandates_to_acknowledge();
        $gca = Company::findOne(1)->gc_accesstoken;
        foreach ($keylist as $key => $value) {
                $client = new \GoCardlessPro\Client([
                        'access_token' => $gca ,
                        'environment' => Company::findOne(1)->gc_live_or_sandbox == 'SANDBOX' ? \GoCardlessPro\Environment::SANDBOX : \GoCardlessPro\Environment::LIVE ,
                ]);
                try {         
                        $redirectFlow = $client->redirectFlows()->complete(
                        $value['redirect_flow_id'], 
                        ["params" => ["session_token" => $value['session_id']]]
                        );
                        $foundit = Product::find()->where('id=:id',['=',':id',$value['product_id']])->one();
                        $foundit->mandate = $redirectFlow->links->mandate;
                        $foundit->gc_number = $redirectFlow->links->customer; 
                        $foundit->save();
                        $accept_mandate = New Sessiondetail();
                        $accept_mandate = Sessiondetail::find()->where('redirect_flow_id=:redirect_flow_id',['=',':redirect_flow_id',$value['redirect_flow_id']])->one();
                        $accept_mandate->administrator_acknowledged = 1;
                        $accept_mandate->save();
                        //$message = "The following customer's mandates have been acknowledged. sent from " .Company::findOne(1)->email . ' to '.  $model->email . ' for customer ID: '. Html::a($model->id,Url::toRoute(['product/view','id'=>$model->id])). ' The customer will be redirected to this site once they have approved the Mandate and will be encouraged to reply to your original email stating that they have approved the Mandate. Access the Gocardless site to update the fields below.';
                        $message = Yii::t('app','Acknowledged Customer Mandate: ID ') . $foundit->id;
                        $message_all = $message_all ."  ".$message. "<br><br>";
                } catch (InvalidStateException $e){
                        $foundit = Product::find()->where('id=:id',['=',':id',$value['product_id']])->one();
                        $foundit->mandate = Yii::t('app','System message: Mandate has expired after 30 minutes. Send an automatic new mandate again. Customer must approve and confirm email link to Gocardless within 30 minutes. '). Date('Y-m-d H:i:s');
                        $foundit->gc_number = ''; 
                        $foundit->save();
                        $cancel_mandate = New Sessiondetail();
                        $cancel_mandate = Sessiondetail::find()->where('redirectflow_flow_id=:redirect_flow_id',['=',':redirect_flow_id',$value['redirect_flow_id']])->one();
                        $cancel_mandate->customer_approved = 0;
                        $cancel_mandate->administrator_acknowledged = 0;
                        $cancel_mandate->redirect_flow_id = $cancel_mandate->redirect_flow_id . "XX";
                        $cancel_mandate->save();
                        $message = Yii::t('app','System message: Customers must approve Mandates within 30 minutes. Send another mandate for approval to Customer ID: '). $foundit->id . Yii::t('app',' Name: '). $foundit->name . ' '. $foundit->surname;
                        $message_all = $message_all ."  ".$message. "<br><br>";
                        throw new \yii\web\HttpException(424,$message );
                }
                       
        }
        Yii::$app->session->setFlash('kv-detail-success',$message_all );
        return $this->redirect(['view', 'id' => $foundit->id]);
   }
   
   public function actionCustomer() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $out = self::getCustomerList($cat_id,$subcat_id); 
                return Json::encode(['output'=>$out, 'selected'=>'']);                      
            }
        }
        return Json::encode(['output'=>'', 'selected'=>'']);
   }
    
   public static function getCustomerList($cat_id, $subcat_id) {
        //find all the houses in the street
        $data = [];
        $data=\frontend\models\Product::find()
       ->where(['productcategory_id'=>$cat_id])
       ->andWhere(['productsubcategory_id'=>$subcat_id])      
       ->select(['id', 'productnumber AS name'])->asArray()->orderBy('name')->all();
       return $data;
    } 
    
   public function actionSlider()
   {
        Yii::$app->session['sliderfontproduct'] = Yii::$app->request->get('sliderfontproduct');    
   }
    
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
}
