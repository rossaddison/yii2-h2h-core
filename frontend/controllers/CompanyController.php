<?php

namespace frontend\controllers;

 // \CompanyController;


use Yii;
use frontend\models\Company;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create','update','delete'],
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['index', 'view','create','update','delete'],
                        'roles' => ['?'],
                    ],
                    
                    [
                        'allow' => true,
                        'actions' => ['index','view','create','update','delete'],
                        'roles' => ['@'],
                    ],
                    
                  
                ],
            ],
        ];
    }
    
    public function actionCreategocardlesscustomer()
    {
       $keylist = Yii::$app->request->get('keylist');
       $comp = Company::findOne(1);
       if (!empty($keylist)){
       foreach ($keylist as $key => $value)
       { //foreachbegin
         $model = $this->findModel($value);
         if ($model !== null) 
           { //ifmodelbegin
             if (empty($model->email) || (empty(Company::findOne()->email))){throw new NotFoundHttpException(Yii::t('app','Either your Company email address has not been filled in or your Customer Email address does not exist for House ID: ').$model->id);}
             $client = new \GoCardlessPro\Client([
            //'access_token' => getenv('GC_ACCESS_TOKEN'),
            //https://pay-sandbox.gocardless.com/AL00003Y2KPGT1
            'access_token' => $comp->gc_accesstoken,
            //'sandbox_b__7gf_Vxn6dYEKFTy3C-GMRamuFz_siKhQsMiZ-',
            // Change me to LIVE when you're ready to go live
            // live_f1sfCuu2xHTUN-IHJP5KualtAZNzo2ubIV6lPzHS
             
            'environment' => $comp->gc_live_or_sandbox == 'SANDBOX' ? \GoCardlessPro\Environment::SANDBOX : \GoCardlessPro\Environment::LIVE ,
            ]);
            $redirectFlow = $client->redirectFlows()->create([
            'params' => [
                "description" => "Window clean",
                "session_token" => Yii::$app->session->getId(),
                //when going live change the http to https
                "success_redirect_url" => $comp->gc_live_or_sandbox == 'SANDBOX' ? Url::to(['site/gocardlesscustomercreated'], 'http') : Url::to(['site/gocardlesscustomercreated'], 'https') ,
                "prefilled_customer" => [
                    "given_name" => $model->name,
                    "family_name" => $model->surname,
                    "email" => $model->email,
                    "address_line1" => $model->productnumber." ".$model->productsubcategory->name,
                    "city" => $comp->address_area2,
                    "postal_code" => $model->postcodefirsthalf." ".$model->postcodesecondhalf,
                    ]
                ]
            ]);
            //Yii::$app->session->setFlash('kv-detail-success', "ID: " . $redirectFlow->id ." Create Customer on Gocardless: ".Html::a($redirectFlow->redirect_url,$redirectFlow->redirect_url));
                 
       Yii::$app->session['redirectflowid'] = $redirectFlow->id;
       Yii::$app->session['redirectflowredirecturl'] = $redirectFlow->redirect_url;
       Yii::$app->session['productid'] = $model->id;
       $send = Yii::$app->mailer->compose()
                ->setFrom(Company::findOne(1)->email)
                ->setTo($model->email)
                ->setSubject(Yii::t('app','Cleaning Direct Debit mandate needs to be approved by you.'))
                ->setTextBody(Yii::t('app','Hello. We have created a variable direct debit mandate through Gocardless that you will approve each time payment is required from you.'))
                ->setHtmlBody(Yii::t('app','<b>Hello. We have created a variable direct debit mandate through Gocardless. That you will approve each time payment is required from you<i></i></b>'))
                ->send();
                if($send){
                    echo Yii::t('app','An email has been sent.');
                }
        
       //send an email to customer with this link
       //Yii::$app->session->setFlash('kv-detail-success', 'Go cardless customer has been created');
       Yii::$app->session->setFlash('kv-detail-success', "ID: " . $redirectFlow->id .Yii::t('app',' Create Customer on Gocardless: ').Html::a($redirectFlow->redirect_url,$redirectFlow->redirect_url));
       return $this->redirect(['view', 'id' => $model->id]);
       }
       else
           
           {//else begin 
              throw new NotFoundHttpException(Yii::t('app','No ticks selected.'));
       
            }//else model end
       } //foreach end
     } //ifempty end
   } //function end
   
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

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('Update Company')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to view these details.'));
        } 
        
         $dataProvider = new ActiveDataProvider([
            'query' => Company::findOne(1),
        ]);

        return $this->render('view', [
            'model' => $this->findModel(1),
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel(1),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('Create Company')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to create a company.'));
        }        
        $counted = Company::find()->count(); 
        if (empty($counted))
        {
                    $model = new Company();

                    if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => 1]);
                    } else {
                        return $this->render('create', [
                        'model' => $model,
                        ]);
                    }
       
        
            
        }
        else 
        {
           throw new ForbiddenHttpException(Yii::t('app','You can only create one company. Modify details of the current company.'));
        }
        
        
        
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('Update Company')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update company details.'));
        } 
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => 1]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    
    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('Delete Company')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete a company.'));
        } 
        
        $this->findModel(1)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            $model = New Company;
            $model->name = Yii::t('app','Your Company Name');
            $model->save();
            return $model;
            //throw new \yii\web\ForbiddenHttpException('The requested page does not exist.');
        }
    }
}
