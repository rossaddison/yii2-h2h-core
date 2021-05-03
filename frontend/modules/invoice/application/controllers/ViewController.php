<?php
namespace frontend\modules\invoice\application\controllers;

use frontend\modules\invoice\application\components\Utilities;
use frontend\modules\invoice\application\models\Salesinvoice;
use frontend\modules\invoice\application\models\SalesinvoiceAmount;
use frontend\modules\invoice\application\models\Salesinvoicemethodpay;
use frontend\modules\invoice\application\helpers\TemplateHelper;
use frontend\modules\invoice\application\controllers\GuestController;
use frontend\models\Company;
use \kartik\mpdf\Pdf;
use Yii;

class ViewController extends GuestController
{
    public function actionInvoice($invoice_url_key = '')
    {
      if (Yii::$app->user->can('Make payment online')) {
        $this->layout = 'layout_guest';  
        if (!$invoice_url_key) {
            echo Yii::error(Utilities::trans('errors'));
            return;
        }
        $invoice = Salesinvoice::find()->where(['in','invoice_status_id',[2,3,4]])->andWhere(['=','invoice_url_key', $invoice_url_key])->one();
        $balance = SalesinvoiceAmount::find()->where(['=','invoice_id',$invoice->invoice_id])->one();
        if (empty($invoice)) {
            Yii::error(Utilities::trans('errors'));
            return;
        }

        //invoice has been sent ie. status is 2
        if (($invoice->invoice_status_id == 2)) {
            //the invoice can be assumed to be viewed since we are in the view controller
            Utilities::mark_viewed($invoice->invoice_id);
        }

        $payment_method = SalesinvoiceMethodPay::find()->where(['=','payment_method_id', $invoice->payment_method_id])->one();
        if ($invoice->payment_method_id == 0) {
            $payment_method = null;
        }

        // Attachments
        $attachments = $this->get_attachments($invoice_url_key);

        $is_overdue = ($balance->invoice_balance > 0 && strtotime($invoice->invoice_date_due) < time() ? true : false);

        $data = array(
            'model' => $invoice,
            'balance'=> $balance,
            'invoice_url_key' => $invoice_url_key,
            'flash_message' => Yii::$app->session->setFlash('danger',Yii::t('app',Utilities::trans('flash_message'))),
            'payment_method' => $payment_method,
            'is_overdue' => $is_overdue,
            'attachments' => $attachments,
            'company'=> Company::findOne(1)           
        );
        
        $route = '/invoice_templates/public/' . $this->mdl_settings->get_setting('public_invoice_template') . '.php';        
        return $this->renderPartial($route,$data);
      } else
      {
          Yii::$app->session->setFlash('danger',Yii::t('app','You do not have permission to view this invoice'));
          return $this->redirect('site/index');
      }
    }
    
    public function actionPdf($invoice_url_key)
    {       
       if (Yii::$app->user->can('Make payment online'))  
       { 
        $invoice = Salesinvoice::find()->where(['in','invoice_status_id',[2,3,4]])->andWhere(['=','invoice_url_key' , $invoice_url_key])->andWhere(['in','product_id', $this->houses])->one();
        if (empty($invoice)) {
            echo Yii::error(Utilities::trans('errors'));
            return $this->render('index');
        }
        Utilities::mark_viewed($invoice->invoice_id); 
        $payment_method = SalesinvoiceMethodPay::find()->where(['=','payment_method_id',$invoice->payment_method_id])->one();
        
        if ($payment_method->payment_method_id  == 0) {
          $payment_method = false;
        } else $payment_method = true;        
        
        if (!empty($invoice)) {  
                        $invoice_template = TemplateHelper::select_pdf_invoice_template($invoice);
                        $data = [
                            'model' => $invoice,
                            'payment_method' => $payment_method              
                        ]; 
                        //retrieve the invoice template that has been set under settings
                        $html = Yii::$app->controller->renderPartial('/invoice_templates/pdf/' . $invoice_template,$data);
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

    private function get_attachments($key)
    {
        $path = Yii::getAlias('@webroot').'/frontend/modules/invoice/uploads/customer_files';
        $files = scandir($path);
        $attachments = [];
        if ($files !== false) {
            foreach ($files as $file) {
                if ('.' != $file && '..' != $file && strpos($file, $key) !== false) {
                    $obj['name'] = substr($file, strpos($file, '_', 1) + 1);
                    $obj['fullname'] = $file;
                    $obj['size'] = filesize($path . '/' . $file);
                    $obj['fullpath'] = $path . '/' . $file;
                    $attachments[] = $obj;
                }
            }
        }
        return $attachments;
    }        
}//class

