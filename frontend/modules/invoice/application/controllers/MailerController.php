<?php
namespace frontend\modules\invoice\application\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\modules\invoice\application\helpers\EchoHelper;
use frontend\modules\invoice\application\helpers\MpdfHelper;
use frontend\modules\invoice\application\helpers\TemplateHelper;
use frontend\modules\invoice\application\models\ci\Mdl_templates;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
use frontend\modules\invoice\application\models\ci\Mdl_uploads;
use frontend\modules\invoice\application\models\SalesinvoiceUploads;
use frontend\modules\invoice\application\libraries\Lang;
use frontend\modules\invoice\application\models\SalesinvoiceEmailTemplate;
use frontend\modules\invoice\application\models\Salesinvoice;
use frontend\modules\invoice\application\components\Utilities;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\validators\EmailValidator;


class MailerController extends Controller
{
    public  $enableCsrfValidation = true;
    
    private $mdl_templates;
    
    private $email_templates;
    
    private $email_template;
    
    private $email_template_layout;
    
    private $salesinvoice;
    
    private $is_overdue = false;
    
    private $mdl_settings;
    
    private $mdl_uploads;
    
    private $lang;
    
    private $echoHelper;
    
    public $layout;
    
    public $validated;    
    
    public function init()
    {
            parent::init();
            $this->enableCsrfValidation = true;            
            $this->validated = true;
            $this->layout = 'layout';
            //get dropdownlist email templates that will be passed to the render
            //get dropdownlist pdf and public invoice templates that will be passed to the render
            $this->mdl_templates = new Mdl_templates();
            $this->mdl_settings = new Mdl_settings();
            $this->mdl_settings->load_settings();
            $this->mdl_uploads = new Mdl_uploads();
            $language = $this->mdl_settings->get_setting('default_language');
            $lang = [];
            $lang = new Lang();
            $lang->load('ip', $language);
            $lang->load('gateway', $language);
            $lang->load('custom',$language);
            $lang->load('merchant',$language);
            $lang->load('form_validation',$language);
            $this->lang = $lang; 
            $this->email_templates = SalesinvoiceEmailTemplate::find()->all();
            $this->echoHelper = new EchoHelper();
    }

    public function actionInvoice($invoice_id)
    {
        //find this invoice_id
        //get the invoice_date_due to determine if the invoice is due
        $this->salesinvoice = Salesinvoice::find()->with('customerdetails')
                                                  ->with('uploads')
                                                  ->with('salesinvoiceamount')
                                                  ->where(['=','invoice_id',$invoice_id])->one();
        //determine if the invoice is overdue or paid and return the appropriate templateid
        $this->is_overdue = ($this->salesinvoice->salesinvoiceamount->invoice_balance > 0 && strtotime($this->salesinvoice->invoice_date_due) < time() ? true : false);
        //use the correct email template id for whether the invoice is overdue or paid
        $email_template_id = $this->select_email_invoice_template($this->is_overdue);
        if ($email_template_id) {
            $this->email_template = SalesinvoiceEmailTemplate::find()
                    ->where(['=','email_template_id',$email_template_id])
                    ->one();
            $this->email_template_layout = json_encode($this->email_template);
        } else {
            $this->email_template_layout = '{}';
        }        
        return $this->render('invoice-sending',[ 
            'selected_pdf_template'=>$this->select_pdf_invoice_template($this->is_overdue),            
            'selected_email_template'=>$email_template_id,
            //find all the invoice email templates invoice = 0
            'email_templates'=>SalesinvoiceEmailTemplate::find()->where(['=','email_template_type',0])->all(),
            'current_email_template'=>SalesinvoiceEmailTemplate::find()->where(['=','email_template_id',$email_template_id])->one(),
            'email_template'=>$this->email_template_layout,
            'invoice'=>$this->salesinvoice,
            'pdf_templates'=>$this->mdl_templates->get_invoice_templates('pdf'),
            'mdl_settings'=>$this->mdl_settings,
            'echoHelper'=>$this->echoHelper,
        ]);
    }

    //send the invoice
    public function actionSendinvoice($invoice_id)
    {
        $target_dir = Yii::getAlias('@webroot').Utilities::getCustomerfolderRelativeUrl();
        Yii::$app->session->removeAllFlashes();
        //use the customerdetails relation to retrieve the householder details in $data array
        $salesinvoice = Salesinvoice::find()->with('customerdetails')->where(['=','invoice_id',$invoice_id])->one();
        $original_file_name = '';
        $new_file_name = '';
        if ((isset($_FILES)) && (!empty($_FILES))) {
          $original_file_name = basename($_FILES["filetoupload"]["name"]);
        }
        $new_file_name = $salesinvoice->invoice_url_key."_".$original_file_name;
        $target_file = $target_dir.$new_file_name;
        $uploadOk = 1;
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is an actual image or fake image
        $check = false;
        if (!empty($_FILES["filetoupload"]["tmp_name"])){
           $check = getimagesize($_FILES["filetoupload"]["tmp_name"]);
                
                if($check !== false) {
                  $echo = "The file is an image of type - " . $check["mime"] . ".";
                  $uploadOk = 1;
                  Yii::$app->session->setFlash('success', Yii::t('app',$echo));           
                } else {
                  $echo = "The file is not an image.";
                  $uploadOk = 0;
                  Yii::$app->session->setFlash('danger', Yii::t('app',$echo)); 
                }

                if (file_exists($target_file)) {
                  $echo = "Sorry, file has already been uploaded.";
                  $uploadOk = 0;
                  Yii::$app->session->setFlash('danger', Yii::t('app',$echo));
                }
                else {  
                        $data = [
                            //h2h uses product_id as opposed to original invoiceplane which uses client_id instead of product_id
                            'product_id' => $salesinvoice->customerdetails->id,
                            'url_key' => $salesinvoice->invoice_url_key,
                            'file_name_original' => $original_file_name,
                            'file_name_new' => $new_file_name
                        ];
                        //store the file details in the database
                        $this->mdl_uploads->create($data);
                }
                // Check file size
                if ((($_FILES["filetoupload"]["size"] > 500000))) {
                  $echo = "Sorry, your file is too large. It exceeds 500 000 k";
                  $uploadOk = 0;
                  Yii::$app->session->setFlash('danger', Yii::t('app',$echo));          
                }        
                // Allow certain file formats
                if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
                && $FileType != "gif" && $FileType != "pdf" ) {
                  $echo = "Sorry, only JPG, JPEG, PNG, GIF and PDF files are allowed.";
                  $uploadOk = 0;
                  Yii::$app->session->setFlash('danger', Yii::t('app',$echo));
                }

                $files = '';
                $uploads = SalesinvoiceUploads::find()->where(['=','url_key',$salesinvoice->invoice_url_key])->all();
                foreach ($uploads as $key => $value) {
                        $files .= $value['file_name_original'] ." "."<br>";
                }

                // Check if $uploadOk is set to 0 by an error
                if (($uploadOk == 0)) {
                  $echo = "Sorry, your file was not uploaded.";
                  Yii::$app->session->setFlash('danger', Yii::t('app',$echo. "<br>Atttached file(s):<br> ". $files));
                } 
       
        
                if ((move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file))) {
                    $echo =  "The file ". Html::encode( basename( $_FILES["filetoupload"]["name"])). " has been added and uploaded.<br>Attached file(s): <br>";
                    Yii::$app->session->setFlash('success', Yii::t('app',$echo.$files ));            
                } else {
                    $echo = "Your file was not uploaded because it exists on the server already.";
                    Yii::$app->session->setFlash('success', Yii::t('app',$echo));
                }
        
         } // !empty($_FILES["fileToUpload"]["tmp_name"])
        
        if (Yii::$app->request->post('btn_cancel')) {
            return $this->redirect(['@web/invoice/salesinvoice']);
        }
       
        $to_email = Yii::$app->request->post('to_email');
        if (empty($to_email)) {
            Yii::$app->session->setFlash('danger', Utilities::trans('email_to_address_missing'));
        }else{
            $validator = new EmailValidator();
            if (!$validator->validate($to_email,$error)) {
               Yii::$app->session->setFlash('danger', Yii::$app->session->setFlash(Yii::t('app','To email is invalid.')));
               $this->validated = false;
            }
        }        
        
        $from_email = Yii::$app->request->post('from_email');
        if (empty($from_email)) {
            Yii::$app->session->setFlash('danger',Yii::t('app','From Email Missing.'));
        }else{
            $validator = new EmailValidator();
            if (!$validator->validate($from_email,$error)) {
               Yii::$app->session->setFlash('danger', Yii::$app->session->setFlash(Yii::t('app','From email is invalid.')));
               $this->validated = false;
            }
        }
        
        $from_name = Yii::$app->request->post('from_name');
        if (empty($from_name)) {
            Yii::$app->session->setFlash('danger', Yii::t('app','From Name Missing'));
            $this->validated = false;
        }
        
        $subject = Yii::$app->request->post('subject');
        if (empty($subject)) {
            Yii::$app->session->setFlash('danger', Yii::t('app','Subject Missing'));
            $this->validated = false;
        }
        
        $pdf_template = Yii::$app->request->post('pdf_template');
                
        $body = Yii::$app->request->post('body');
        if (empty($body)) {
            Yii::$app->session->setFlash('danger',Yii::t('app','Body Missing'));
            $this->validated = false;
        }
        
        if (strlen($body) != strlen(Html::decode($body))) {
            $body = Html::decode($body);
        } else {
            $body = Html::decode(nl2br($body));
        }
        
       $attachment_files = $this->mdl_uploads->get_invoice_uploads($invoice_id);
              
       try{
         if ($this->validated) {  
          if ($this->emailinvoice($invoice_id, $from_email, $from_name, $to_email, $subject, $body, $attachment_files)) {
            Utilities::mark_sent($invoice_id);
            $this->archive($invoice_id, $pdf_template);
            Yii::$app->session->setFlash('success', Utilities::trans('email_successfully_sent'));
            return $this->redirect(['@web/invoice/salesinvoice']);
          }
          else {
            Yii::$app->session->setFlash('danger', 'Email not sent');
            return $this->redirect(['@web/invoice/mailer/invoice','invoice_id'=>$invoice_id]);
          }
         } else {
            Yii::$app->session->setFlash('info', 'Validation has failed.');
            return $this->redirect(['@web/invoice/mailer/invoice','invoice_id'=>$invoice_id]);
         } 
       }catch (\exception $e){
          throw new NotFoundHttpException(Yii::t('app','An exception in route mailer/sendinvoice has occurred.'.$e)); 
       }
    }
    
    public function emailinvoice($invoice_id, $from_email, $from_name, $to_email, $subject, $body, $attachment_files = null)
    {
        try {
        $sent = false;
        if ((!empty($invoice_id)) && (!empty($from_email)) && (!empty($from_name)) && (!empty($to_email)) && (!empty($subject)) && (!empty($body))){
            $send = Yii::$app->mailer->compose();
            $send->setFrom($from_email);
            $send->setTo($to_email);
            if (!empty($attachment_files)){
              foreach ($attachment_files as $attach_file) {  
               $send->attach($attach_file['filename_with_path']);
              }  
            }
            $validator = new EmailValidator([
                'enableIDN'=>true,
                'checkDNS'=>true
            ]);
            
            //for email addressess separated with a comma
            $cc = Yii::$app->request->post('cc');
            //catch multiple addresses
            $cc_array = [];
            //the field is not empty or  there is a separator comma in it.
            if (!empty($cc)||(strpos($cc, ','))){
                 //remove comma
                 $cc = explode(',', $cc);
                 //after explode cc is an array. Each array component could have a space before it so trim spaces
                 $i = 0;
                 foreach ($cc as $address) {
                    //remove the potential spaces
                    $address = ltrim(rtrim($address));
                    if ($validator->validate($address)) {
                        //include in new array
                        $cc_array[$i] = $address; 
                    }
                    else {
                        Yii::$app->session->setFlash('danger', Yii::t('app','Separate email addresses with comma only.'));
                    }
                    $i+=1;
                 }
                 $send->setCc($cc_array);
            }                     
            $bcc = Yii::$app->request->post('bcc');            
            $bcc_array = [];
            if (!empty($bcc)||(strpos($bcc, ','))){
                 //remove comma
                 $bcc = explode(',', $bcc);
                 //after explode bcc is an array. Each array component could have a space before it so trim spaces
                 $i = 0;
                 foreach ($bcc as $address) {
                    //remove the potential spaces
                    $address = ltrim(rtrim($address));
                    if ($validator->validate($address)) {
                        //include in new array
                        $bcc_array[$i] = $address; 
                    }
                    else {
                        Yii::$app->session->setFlash('danger', Yii::t('app','Separate email addresses with comma only.'));
                    }
                    $i+=1;
                 }
                 $send->setBcc($bcc_array);
            }
            $send->setSubject($subject);
            $salesinv = Salesinvoice::find()->with('salesinvoiceamount')
                                            ->with('status')
                                            ->with('paymentmethod')
                                            ->with('customerdetails')
                                            ->where(['=','invoice_id',$invoice_id])
                                            ->one();            
            $body = TemplateHelper::parse_template($salesinv,$body);
            $send->setHtmlBody($body);
            $send->send();
            $sent = true;
        }
        return $sent;
        } catch (\exception $e){
           throw new NotFoundHttpException(Yii::t('app','An exception in route mailer/sendinvoice has occurred. Most likely you have removed customer files from the folder manually WITHOUT removing the attachments from the salesinvoiceuploads database. Clear the customer files folder and the salesinvoiceuploads table.'.$e)); 
        }
    }
    
    public function beforeAction($action) 
    { 
       if ($action = 'tencode') { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
       }
    }
    
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        if ($action = 'tencode') { 
            $this->enableCsrfValidation = true;             
        }
        return $result;
    }   
    
    public function select_pdf_invoice_template($overdue)
    {
        if ($overdue) {
            // Use the overdue template
            return $this->mdl_settings->setting('pdf_invoice_template_overdue');
        } elseif ($this->salesinvoice->invoice_status_id == 4) {
            // Use the paid template
            return $this->mdl_settings->setting('pdf_invoice_template_paid');
        } else {
            // Use the default template
            return $this->mdl_settings->setting('pdf_invoice_template');
        }
    }
    
    public function select_email_invoice_template($overdue)
    {
        if ($overdue) {
            // Use the overdue template
            return $this->mdl_settings->setting('email_invoice_template_overdue');
        } elseif ($this->salesinvoice->invoice_status_id == 4) {
            // Use the paid template
            return $this->mdl_settings->setting('email_invoice_template_paid');
        } else {
            // Use the default template
            return $this->mdl_settings->setting('email_invoice_template');
        }
    }
    
    private function archive($invoice_id, $pdf_template){
        $salesinvoice = Salesinvoice::find()->where(['=','invoice_id',$invoice_id])->one();
        $html = $this->renderpartial(Utilities::getTemplateholderRelativeUrl() . $pdf_template,['model' => $salesinvoice]);
        $filename = Utilities::trans('invoice') . '_' . str_replace(['\\', '/'], '_', $invoice_id);
        //files will not be streamed to the browser but will be saved to the online folder
        $archived_filename = MpdfHelper::pdf_create($html, $filename, $stream = false);
        Yii::$app->session->setFlash(Yii::t('app','The following file has been archived: '.$archived_filename));
    }
    
    public function actionTencode($email_template_id)
    {
        $result = SalesinvoiceEmailTemplate::find()->where(['email_template_id'=>$email_template_id])->one();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Json::encode($result);        
    }
}
