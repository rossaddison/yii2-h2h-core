<?php
namespace frontend\modules\invoice\application\controllers;

use Yii;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
use frontend\modules\invoice\application\models\Salesinvoice;
use frontend\modules\invoice\application\models\SalesinvoiceSearch;
use frontend\modules\invoice\application\helpers\TemplateHelper;
use frontend\modules\invoice\application\components\Utilities;
use yii\behaviors\TimestampBehavior;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\helpers\Html;
Use yii\helpers\Url;
use kartik\mpdf\Pdf;
use yii\db\Expression;

/**
 * SalesinvoiceController implements the CRUD actions for Salesinvoice model.
 */
class SalesinvoiceController extends Controller
{
    public function behaviors()
    {
        return [
                'timestamp' => 
                            [
                            'class' => TimestampBehavior::className(),
                            'attributes' => [
                                                ActiveRecord::EVENT_BEFORE_INSERT => ['invoice_date_modified'],
                                                ActiveRecord::EVENT_BEFORE_UPDATE => ['invoice_date_modified'],
                                            ],
                            'value' => new Expression('NOW()'),    
                            ],
                'access' => 
                            [
                              'class' => \yii\filters\AccessControl::className(),
                              'only' => ['init','index','create','view','update','pdf'],
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
    
   public $before;
    
   public $after;
    
   public $afterspace;

   public $currency_symbol;
            
   public $currency_symbol_placement;
   
   public $mdl_settings;
   
   public $layout;
    
   public function init()
   {
       parent::init();
       $this->mdl_settings = new Mdl_settings();
       $this->mdl_settings->load_settings();
   }
    
   public function actionIndex()
    {
        $searchModel = new SalesinvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'invoice_id' => [
                    'asc' => ['invoice_id' => SORT_ASC],
                    'desc' => ['invoice_id' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
            ],
            'defaultOrder' => [
              'invoice_id' => SORT_DESC,
            ]
          ]); 
        
        if (Yii::$app->request->post('hasEditable')) {
        $editablekey = Yii::$app->request->post('editableKey');
        $model = Salesinvoice::findOne($editablekey);
        $out = Json::encode(['output'=>'', 'message'=>'']);
        $post = [];
        
        $myvar = $this->mdl_settings->get_setting('invoices_due_after','',false);
        $days = "+".ltrim(rtrim($myvar))." day";
        $posted = current(Yii::$app->request->post('Salesinvoice'));
        $post = ['Salesinvoice' => $posted];
        if ($model->load($post)) {
            $date = strtotime($model->invoice_date_created. $days);
            $addeddate = date('Y-m-d', $date);
            $model->invoice_date_due = $addeddate;
            $model->save();
        }
        $output = '';
        
        return Json::encode(['output'=> $output, 'message'=>'']);
        }
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Salesinvoice model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id), 'widgetmessage'=>'','settingmessage'=>''
        ]);
    }
    
    public function actionGuestinvoice($invoice_url_key)
    {       
        $model = Salesinvoice::find()->where(['=','invoice_url_key',$invoice_url_key])->one(); 
        return $this->getPdf($model);  
    }

    /**
     * Creates a new Salesinvoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('Create Invoice')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to create an invoice.'));
        }
                
        $model = new Salesinvoice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->invoice_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->is_read_only == false) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                 return $this->render('view', ['id' => $model->invoice_id,'model'=>$model]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else {
            Yii::$app->session->setFlash('warning',Yii::t('app','The invoice has been set to read only and can therefore not be updated.'));
            return $this->render('view', ['id' => $model->invoice_id,'model'=>$model]);
        }
    }
    
    protected function findInvoice($invoice_url_key, $user = null)
    {
        $invoiceQuery = Salesinvoice::find()
            ->where(['invoice_id' => $invoiceId])
            ->available()
            ->limit(1);
        
        if ($user !== null) {
            $invoiceQuery->hasUser($user);
        }
        
        $invoice = $invoiceQuery->one();

        if ($invoice) {
            return $invoice;
        }
        
        throw new NotFoundHttpException("The requested invoice does not exist.");
    }
    
    protected function findModel($id)
    {
        if (($model = Salesinvoice::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
     public function currency_spacing()
    {
       $this->after ='';
       $this->before='';
       $this->afterspace = '';
       $this->currency_symbol='';
       $this->currency_symbol_placement='';
       $this->currency_symbol = $this->mdl_settings->get_setting('currency_symbol','',false);
       $this->currency_symbol_placement = $this->mdl_settings->get_setting('currency_symbol_placement','',false);
       if ($this->currency_symbol_placement === 'before'){ 
           $this->before = $this->currency_symbol;
       }else 
       $this->before ='';
       if ($this->currency_symbol_placement === 'after'){ 
          $this->after = $this->currency_symbol;
       }else $this->after = '';
       if (
          $this->currency_symbol_placement === 'afterspace'){
          $this->afterspace = " ".$this->currency_symbol;
       } else $this->afterspace = "";
    }
    
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $invoice_template = [];
        $footer = '';
        $content = '';
        $invoice_template = TemplateHelper::select_pdf_invoice_template($model);
        $filename = Utilities::trans('invoice') . '_' . str_replace(['\\', '/'], '_', $model->invoice_id);
        $archived_file = Yii::getAlias('@webroot').Utilities::getUploadsArchiveholderRelativeUrl() .'/'. date('Y-m-d') . '_' . $filename . '.pdf';
        //mark_invoices_sent_pdf
        //if mark as sent when pdf created is set to ON under settings the prerequisite to customer viewing ie. sent status 
        //can be achieved without emailing, and archiving must occur here instead of streaming ie. browser
        if ($this->mdl_settings->get_setting('mark_invoices_sent_pdf') == 1) {
            $archive = true;
            $settingmessage = Yii::t('app','Pdf setting: Mark invoices as sent upon pdf generated is currently Enabled so VIEWED will change to SENT and the pdf will be saved in a folder ie. archived. View using Html.'.Html::a('Disabling here will enable you to view the pdf under the Archive And Mark As Sent column but you will have to send an email with your selected template and summary information for the invoice to be marked as SENT so that the customer can view the pdf online.',Url::to(['@web/invoice/ip/settings'])));
            //allow online customers to view the invoice  draft->sent->view->paid->cancelled
            $model->invoice_status_id = 2;            
        }
        else {
            $archive = false;
            $settingmessage = Yii::t('app','Pdf setting: Mark invoices as sent upon pdf generated is currently Disabled.'.Html::a('Enable here',Url::to(['@web/invoice/ip/settings'])));
        }    
        //retrieve the invoice template that has been set under settings for views/invoice_templates/pdf
        $content = $this->renderpartial(Utilities::getTemplateholderRelativeUrl() . $invoice_template['setting'],['model' => $model]);
        if (!empty($this->mdl_settings->get_setting('pdf_invoice_footer'))) {
          $footer = '<div id="footer">' . $this->mdl_settings->get_setting('pdf_invoice_footer') . '</div>';
        }
        //$content = '<p>'. Html::encode(Utilities::getTemplateholderRelativeUrl() . $invoice_template['setting']) . '</p>';
        $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_CORE, 
                'tempPath'=> Yii::getAlias('@runtime/mpdf'),
                'defaultFont'=>'',
                'defaultFontSize'=>'',
                'marginLeft'=>15,
                'marginRight'=>15,
                'marginTop'=>16,
                'marginBottom'=>16,
                'marginHeader'=>9,
                'marginFooter'=>9,
                'options'=>
                [
                    'useAdobeCJK'=>true,
                    'autoScriptToLang'=>true,
                    'autoVietnamese'=>true,
                    'autoArabic'=>true,
                    'auotLangToFont'=>true,
                    'title' => 'Report Title',
                    'showImageErrors'=> YII_DEBUG ? : true,false,
                    'ignore_invalid_utf8' => true,
                    'tabSpaces' => 4,
                    'showWatermarkImage' => true,                    
                ],  
                // A4 paper format
                'format' => Pdf::FORMAT_A4, 
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT, 
                'filename' => $archived_file,
                // stream to browser inline
                'destination' => $archive ? Pdf::DEST_FILE : Pdf::DEST_BROWSER, 
                // your html content input
                'content' => $content,  
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting 
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:16px}', 
                 // call mPDF methods on the fly
                'methods' => [ 
                    'SetHeader'=>['Invoice Number '.$model->invoice_id], 
                    'SetFooter'=>['{PAGENO}'],
                    'SetWatermarkImage' => $this->mdl_settings->get_setting('pdf_watermark') ? $invoice_template['watermark'] : '',
                    //'setAutoBottomMargin' => $this->mdl_settings->get_setting('pdf_invoice_footer') ? 'stretch' : '',
                    'SetHTMLFooter'=> $this->mdl_settings->get_setting('pdf_invoice_footer') ? $footer : '',
                ]
        ]);
        if ($archive) {
           $model->save(); 
           $message = Yii::t('app','The following file has been archived: '.$archived_file. 
                             '<br> and status has been changed to sent so that the customer can view the file online.'. 
                             '<br>'); 
           $pdf->render();
           return $this->render('view',['invoice_id'=>$id,'model'=>$model,'widgetmessage'=>$message,'settingmessage'=>$settingmessage]);
        }
        else {
        return $pdf->render();}
    }
    
    public function actionSwitch(){
        if ($this->mdl_settings->get_setting('mark_invoices_sent_pdf') == 1){
            $value = "0";
            $this->mdl_settings->save('mark_invoices_sent_pdf', $value);
            $this->mdl_settings->load_settings();
            return $this->redirect('@web/invoice/salesinvoice/index');            
        } else 
        {
            $value = "1";
            $this->mdl_settings->save('mark_invoices_sent_pdf', $value);
            $this->mdl_settings->load_settings();
            return $this->redirect('@web/invoice/salesinvoice/index');             
        }        
    }
}
