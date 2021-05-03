<?php
namespace frontend\modules\invoice\application\controllers;

use Yii;
use frontend\modules\invoice\application\models\SettingsSearch;
use frontend\modules\invoice\application\models\Salesinvoicemethodpay;
use frontend\modules\invoice\application\models\SalesinvoiceEmailTemplate;
use frontend\modules\invoice\application\models\SalesinvoiceMerchantResponseSearch;
use frontend\modules\invoice\application\models\Settings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Company;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
use frontend\modules\invoice\application\models\ci\Mdl_templates;
use frontend\modules\invoice\application\libraries\Lang;
use frontend\modules\invoice\application\libraries\Crypt;
use yii\web\UploadedFile;
use frontend\modules\invoice\application\components\Utilities;
use frontend\modules\invoice\application\components\Currency;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class IpController extends Controller
{
    //https://yii2-cookbook-test.readthedocs.io/incoming-post/ 
    
    public $enableCsrfValidation = true;
    
    public $layout;
    
    private $mdl_settings;
    
    private $lang;
    
    private $dictionary;
    
    private $crypt;
    
    private $payment_methods;
    
    private $payment_query_methods;
    
    private $merchant_query_responses;
    
    private $mdl_templates;
    
    private $email_invoice_template;
    
    private $all_email_invoice_templates;
    
    private $email_query_templates;
    
    private $gateways;
    
    private $dir;
    
    private $pdf_invoice_templates;
    
    private $public_invoice_templates;
    
    private  $dataProvider;
    
    private $dataProviderPaymentMethod;
    
    private $dataProviderMerchantResponse;
    
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
                              'only' => ['settings','cronkey',
                                         'etc','etu','etd','etv',
                                         'pmc','pmu','pmd','pmv',
                                         'formlist','paymentmethodlist','list','merchantresponselist',
                                         'sc','su','sd','sv'
                                        ],
                              'rules' => [
                            [
                                'allow' => true,
                                'verbs' => ['POST']
                            ],
                            [
                                  'allow' => true,
                                  'roles' => ['Admin','Manage Admin'],
                            ],
                            ],
                            ],            
        ];
         
    }
    
    public function init(){
        parent::init();
        $this->layout = 'layout';
        $this->mdl_settings = new Mdl_settings;
        $this->mdl_settings->load_settings();
        $language = $this->mdl_settings->get_setting('default_language');
        //$this->lang is set during the getDictionary function
        $this->dictionary = $this->getDictionary($language);
        $this->crypt = new Crypt;   
        $this->payment_methods = SalesinvoiceMethodPay::find()->all();
        $this->mdl_templates = new Mdl_templates;
        $this->email_invoice_template = new SalesinvoiceEmailTemplate();
        $this->all_email_invoice_templates = $this->email_invoice_template->find()->all();
        $invoice = \Yii::$app->getModule('invoice');
        $this->gateways = $invoice->params['payment_gateways'];
        $this->dir = Yii::getAlias('@app').'/modules/invoice/application/language';
        $this->pdf_invoice_templates = $this->mdl_templates->get_invoice_templates('pdf');
        $this->public_invoice_templates = $this->mdl_templates->get_invoice_templates('public');
        
        $this->dataProvider = new ActiveDataProvider([
            'query' => SalesinvoiceEmailTemplate::find(),
        ]);
        $countQuery = clone $this->dataProvider;
        $pages = new Pagination(['totalCount' => $countQuery->query->count()]);
        $this->email_query_templates = $countQuery->query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        
        $this->dataProviderPaymentMethod = new ActiveDataProvider([
            'query' => SalesinvoiceMethodPay::find(),
        ]);
        $countQueryPaymentMethod = clone $this->dataProviderPaymentMethod;
        $pagespaymentmethod = new Pagination(['totalCount' => $countQueryPaymentMethod->query->count()]);
        $this->payment_query_methods = $countQueryPaymentMethod->query->offset($pagespaymentmethod->offset)
                ->limit($pagespaymentmethod->limit)
                ->all();
        
        
    }
    
    public function actionSettings()
    {
        if (Yii::$app->request->post()) {
          if (Yii::$app->request->post('settings')) {   
            $settings = Yii::$app->request->post('settings');
            // Save the submitted settings
            foreach ($settings as $key => $value) {
                if (strpos($key, 'field_is_password') !== false || strpos($key, 'field_is_amount') !== false) {
                    continue;
                }
                if (isset($settings[$key . '_field_is_password']) && empty($value)) {
                    continue;
                }
                if (isset($settings[$key . '_field_is_password']) && $value != '') {
                    $this->mdl_settings->save($key, $this->crypt->encode(trim($value)));
                    $this->mdl_settings->load_settings();
                    Yii::$app->session->setFlash('success',Yii::t('app','Settings saved successfully'));   
                } elseif (isset($settings[$key . '_field_is_amount'])) {
                    // Format amount inputs
                    $this->mdl_settings->save($key, standardize_amount($value));
                    $this->mdl_settings->load_settings();
                    Yii::$app->session->setFlash('success',Yii::t('app','Settings saved successfully'));   
                } else {
                    $this->mdl_settings->save($key, $value); 
                    $this->mdl_settings->load_settings();
                    Yii::$app->session->setFlash('success',Yii::t('app','Settings saved successfully'));   
                }
            } //foreach
            if ($_FILES['invoice_logo']['name']) {
                   $uploadedFile = UploadedFile::getInstanceByName('invoice_logo','file');
                   if (!empty($uploadedFile)) { 
                         $basepath = \Yii::getAlias('@webroot');
                         $path = $basepath . Utilities::getPlaceholderRelativeUrl() . $uploadedFile->name;
                         $uploadedFile->saveAs($path); 
                         $this->mdl_settings->save('invoice_logo', $uploadedFile->name);
                         Yii::$app->session->setFlash('success',Yii::t('app','Settings saved successfully'));
                   }
            } 
            } //post settings
        } //post settings
        return $this->render('menu',[ 
            'mdl_settings_render_menu'=>$this->mdl_settings, 
            'mdl_templates_render_menu'=>$this->mdl_templates,
            'all_email_invoice_templates_render_menu' => $this->all_email_invoice_templates,
            'public_invoice_templates_render_menu' => $this->public_invoice_templates,
            'pdf_invoice_templates_render_menu' => $this->pdf_invoice_templates,
            'payment_methods_render_menu'=> $this->payment_methods,
            'gateway_drivers_render_menu' => $this->gateways,
            'crypt_render_menu'=> $this->crypt,
            'company_render_menu'=> Company::findOne(1),
            'lang'=> $this->lang,
            'dictionary_render_menu'=>$this->dictionary,
            'default_dictionary_render_menu'=>$this->mdl_settings->expandDirectoriesMatrix($this->dir, $level = 0),
            'gateway_currency_codes_render_menu' =>Currency::all(),
        ]);
    }   
       
    public function actionCronkey(){
        return Utilities::random_string('alnum', 16);
    }
    
    public function beforeAction($action)
    {
        if (in_array($action->id, ['cronkey'])) {
            $this->enableCsrfValidation = false;
        }
        else {$this->enableCsrfValidation = true;}
        return parent::beforeAction($action);
    } 
    
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        if (in_array($action->id, ['cronkey'])) {
            $this->enableCsrfValidation = true;
        }
        else {$this->enableCsrfValidation = false;}
        return $result;
    }
    //list the email templates
    
    public function actionFormlist()
    {
        return $this->render('formlist', [
                 'dataProvider' => $this->dataProvider,
                 'languages'=>$this->dictionary,
        ]);       
    }
    //Email Template Create
    public function actionEtc()
    {        
        $model = new SalesinvoiceEmailTemplate();
        $model->attributes = \Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           Yii::$app->session->setFlash('success',Yii::t('app','Template created successfully')); 
           return $this->render('formlist', ['dataProvider' => $this->dataProvider,'languages'=>$this->dictionary]);  
        }
        return $this->render('_email_template_form',['model'=>$model,'languages'=>$this->dictionary,'mdl_email_templates'=>$this->email_invoice_template,'mdl_settings'=>$this->mdl_settings, 'mdl_pdf_templates'=>$this->pdf_invoice_templates]);        
    }
    
    //Email Template Delete
    public function actionEtd($email_template_id)
    {
        $this->findEmailTemplateModel($email_template_id)->delete();
        Yii::$app->session->setFlash('success',Yii::t('app','Template deleted successfully')); 
        return $this->render('formlist', ['dataProvider' => $this->dataProvider,'languages'=>$this->dictionary]);  
    }
    
    //Email Template Update
    public function actionEtu($email_template_id)
    {        
        $model = $this->findEmailTemplateModel($email_template_id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           Yii::$app->session->setFlash('success',Yii::t('app','Template updated successfully')); 
           return $this->render('formlist', ['dataProvider' => $this->dataProvider,'languages'=>$this->dictionary,]);   
        }
        return $this->render('_email_template_form',['model'=>$model,'languages'=>$this->dictionary,'mdl_email_templates'=>$this->email_invoice_template,'mdl_settings'=>$this->mdl_settings,'mdl_pdf_templates'=>$this->pdf_invoice_templates]);        
    }
    
    //Email Template View
    public function actionEtv($email_template_id)
    {        
        return $this->render('emailtemplateview', [
            'model' => $this->findEmailTemplateModel($email_template_id)
        ]);    
    }
    
    //Payment method Create
    public function actionPmc()
    {        
        $model = new SalesinvoiceMethodPay();
        $model->attributes = \Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           Yii::$app->session->setFlash('success',Yii::t('app','Payment method created successfully.')); 
           return $this->render('paymentmethodlist', ['dataProvider' => $this->dataProviderPaymentMethod,'languages'=>$this->dictionary]);  
        }
        return $this->render('_payment_method_form',['model'=>$model,'languages'=>$this->dictionary]);        
    }
    
    //Payment Method Delete
    public function actionPmd($payment_method_id)
    {
        $this->findPaymentMethodModel($payment_method_id)->delete();
        Yii::$app->session->setFlash('success',Yii::t('app','Payment method deleted successfully')); 
        return $this->render('paymentmethodlist', ['dataProvider' => $this->dataProviderPaymentMethod,'languages'=>$this->dictionary]);  
    }
    
    //Payment method Update
    public function actionPmu($payment_method_id)
    {        
        $model = $this->findPaymentMethodModel($payment_method_id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           Yii::$app->session->setFlash('success',Yii::t('app','Payment method updated successfully')); 
           return $this->render('paymentmethodlist', ['dataProvider' => $this->dataProviderPaymentMethod,'languages'=>$this->dictionary,]);   
        }
        return $this->render('_payment_method_form',['model'=>$model,'languages'=>$this->dictionary]);        
    }
    
    //Payment method View
    public function actionPmv($payment_method_id)
    {        
        return $this->render('paymentmethodview', [
            'model' => $this->findPaymentMethodModel($payment_method_id)
        ]);    
    }
    //list the payment methods
    public function actionPaymentmethodlist()
    {
        return $this->render('paymentmethodlist', [
                 'dataProvider' => $this->dataProviderPaymentMethod,
                 'languages'=>$this->dictionary,
        ]);       
    }
    
    //list the merchant payment responses 
    public function actionMerchantresponselist()
    {
        $searchModel = new SalesinvoiceMerchantResponseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'invoice_id' => [
                    'asc' => ['invoice_id' => SORT_ASC],
                    'desc' => ['invoice_id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
              'invoice_id' => SORT_ASC,
            ]
        ]);       
        
        return $this->render('merchantpaymentresponselist', [
                 'dataProvider'=>$dataProvider,
                 'searchModel'=>$searchModel,
                 'languages'=>$this->dictionary,
        ]);       
    }
    
      
    
    protected function getDictionary($language)
    {
        $lang = [];
        $lang = new Lang();
        $lang->load('ip', $language);
        $lang->load('gateway', $language);
        $lang->load('custom',$language);
        $lang->load('merchant',$language);
        $lang->load('form_validation',$language);
        $this->lang = $lang; 
        $dictionary = $this->lang->_language;
        return $dictionary;
    }
    
    //list all the settings that have been loaded from Mdl_settings
    public function actionList()
    {
        $this->layout = '@frontend/views/layouts/main';
        $searchModel = new SettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'setting_key' => [
                    'asc' => ['setting_key' => SORT_ASC],
                    'desc' => ['setting_key' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
              'setting_key' => SORT_ASC,
            ]
          ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    //create setting
    public function actionSc()
    {
        $model = new Settings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['sv', 'id' => $model->setting_id]);
        }

        return $this->render('settingcreate', [
            'model' => $model,
        ]);
    }

    //update setting
    public function actionSu($id)
    {
        $model = $this->findSettingModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['sv',  'id' => $model->setting_id]);
        }

        return $this->render('settingupdate', [
            'model' => $model,
        ]);
    }
    
    //view setting
    public function actionSv($id)
    {
       return $this->render('settingview', [
            'model' => $this->findSettingModel($id),
        ]);
    }

    //delete setting
    public function actionSd($id)
    {
        $this->findSettingModel($id)->delete();

        return $this->redirect(['list']);
    }
    
    //update setting
    public function actionPu($id)
    {
        $model = $this->findPaymentModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['payments/payments_index',  'id' => $model->setting_id]);
        }

        return $this->render('paymentupdate', [
            'model' => $model,
        ]);
    }
    
    public function actionImage() 
    {
       //if (!empty(Yii::$app->request->post('invoice_logo'))){
       //  $uploadedFile = UploadedFile::getInstanceName('invoice_logo');
        // return $this->render('test',['up'=>$uploadedFile]);
       //$path = $basepath . "/images/" . $model->image_web_filename;
       //}
       //Yii::$app->session->setFlash('warning','You have uploaded the file.');
    }
    
    protected function findPaymentModel($payment_id)
    {
        if (($paymentmodel = SalesinvoicePayment::findOne($payment_id)) !== null) {
            return $paymentmodel;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested Payment does not exist.'));
    }
    
    protected function findEmailTemplateModel($email_template_id)
    {
        if (($emailtemplatemodel = SalesinvoiceEmailTemplate::findOne($email_template_id)) !== null) {
            return $emailtemplatemodel;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested Email Template does not exist.'));
    }
    
    protected function findPaymentMethodModel($payment_method_id)
    {
        if (($paymentmethodmodel = SalesinvoiceMethodPay::findOne($payment_method_id)) !== null) {
            return $paymentmethodmodel;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested Email Template does not exist.'));
    }
    
    protected function findSettingModel($id)
    {
        if (($settingmodel = Settings::findOne($id)) !== null) {
            return $settingmodel;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested setting page does not exist.'));
    }   
}
 