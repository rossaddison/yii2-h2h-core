<?php
namespace frontend\modules\invoice\application\controllers;

use yii\filters\VerbFilter;
use frontend\modules\invoice\application\models\Salesinvoice;
use frontend\modules\invoice\application\controllers\GuestController;
use frontend\modules\invoice\application\models\ci\Mdl_settings; 
use frontend\modules\invoice\application\helpers\TemplateHelper;
use frontend\modules\invoice\application\components\Utilities;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use \kartik\mpdf\Pdf;
use Yii;

class InvoicesController extends GuestController
{
    public $layout;
    
    public $invoices;
    
    public $status;
    
    public $mdl_invoices;
    
    public $mdl_payment_methods;
    
    public $mdl_settings;

    public $html;    
    
    public function init()
    {
          parent::init();
          $this->mdl_invoices = new Salesinvoice();
          $this->mdl_settings = new Mdl_settings();
          $this->mdl_settings->load_settings();
    }
    
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
                              'only' => [
                                         'open','paid','view','pdf'
                                        ],
                              'rules' => [
                            [
                                'allow' => true,
                                'verbs' => ['POST']
                            ],
                            [
                                  'allow' => true,
                                  'roles' => ['Online Payer'],
                            ],
                            ],
                            ],            
        ];
         
    }
    
    public function actionIndex() 
    {
        return $this->goHome();
    }
    
    public function actionOpen()
    {
        // Display open invoices by default
        If (Yii::$app->user->can('Make payment online')){
           //find all invoices of all the houses that this user will pay for and that are open ie. sent and viewed
           //and therefore about to be paid
           $find =   SalesInvoice::find()->where(['in','invoice_status_id', [2, 3]])->andWhere(['in','product_id',$this->houses]);
           $query = new ActiveDataProvider([
            'query' => $find,
           ]);
           //count all these invoices and include them in the pagination
           $countInvoices = clone $query;
           $pages = new Pagination(['totalCount' => $countInvoices->query->count()]);
           $invoices = $countInvoices->query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
           return $this->render('invoices_index',['invoices'=>$invoices,'status'=>'open','pages'=>$pages]);           
        }
        else {
            Yii::$app->session->setFlash('danger',Yii::t('app','You do not have permission to make an online payment.')); 
        }
    }
    
    public function actionPaid()
    {
        If (Yii::$app->user->can('Make payment online')){
           //find all invoices for all houses that have already been paid for by this user 
           $find = Salesinvoice::find()->where(['=','invoice_status_id', 4])->andWhere(['in','product_id',$this->houses]);
           $query = new ActiveDataProvider([
            'query' => $find,
           ]);
           $countInvoices = clone $query;
           $pages = new Pagination(['totalCount' => $countInvoices->query->count()]);
           $invoices = $countInvoices->query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
           return $this->render('invoices_index',['invoices'=>$invoices,'status'=>'paid','pages'=>$pages]);           
        }
        else {
            Yii::$app->session->setFlash('danger',Yii::t('app','You do not have permission to make an online payment.')); 
        }       
    }

    public function actionView($invoice_id)
    {
        $invoice = Salesinvoice::find()->where(['=','invoice_id', $invoice_id])->one();
                
        if (empty($invoice)) {
            echo Yii::error(Utilities::trans('errors'));
            return $this->render('invoices_index');
        }

        Utilities::mark_viewed($invoice->invoice_id);

        return $this->render('invoices_view',[
            'model' => $invoice
        ]);
    }
    
    public function actionPdf($invoice_id)
    {       
       if (Yii::$app->user->can('Make payment online'))  
       {
        //at best the invoice is already marked as sent ie. status 2 and can therefore be marked as viewed   
        $invoice = Salesinvoice::find()->where(['in','invoice_status_id',[2,3,4]])->andWhere(['=','invoice_id' , $invoice_id])->andWhere(['in','product_id', $this->houses])->one();
        
        if (!$invoice) {
            echo Yii::error(Utilities::trans('errors'));
            return $this->render('index');
        }
        
        //the invoice has already been sent since the customer is now viewing the invoice
        Utilities::mark_viewed($invoice_id); 
        
        $invoice = $this->mdl_invoices->find()->where(['=','invoice_id', $invoice_id])->one();        
        
        if (!empty($invoice)) {
                        $invoice_template = TemplateHelper::select_pdf_invoice_template($invoice);
                        //retrieve the invoice template that has been set under settings
                        $html = Yii::$app->controller->renderPartial('/invoice_templates/pdf/' . $invoice_template['setting'],['model'=>$invoice]);
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
                            // stream to browser inline
                            'destination' => Pdf::DEST_BROWSER, 
                            // your html content input
                            'content' => $html,
                            // format content from your own css file if needed or use the
                            // enhanced bootstrap css built by Krajee for mPDF formatting 
                            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                            // any css to be embedded if required
                            'cssInline' => '.kv-heading-1{font-size:16px}', 
                             // call mPDF methods on the fly
                            'methods' => [ 
                                'SetHeader'=>['Invoice Number '. $invoice->invoice_id], 
                                'SetFooter'=>['{PAGENO}'],
                                'SetWatermarkImage' => $this->mdl_settings->get_setting('pdf_watermark') ? $invoice_template['watermark'] : '',                                
                            ]
                        ]);
                        // return the pdf output as per the destination setting
                        
                        return $pdf->render();
                    } else {
                        return Yii::$app->setFlash('There is no such invoice available.');
         }    
       } else
       {
             Yii::$app->setFlash(Yii::t('app','You do not have suitable permission. Consult your administrator.'));
             return $this->render('index');
       }
    }
}
