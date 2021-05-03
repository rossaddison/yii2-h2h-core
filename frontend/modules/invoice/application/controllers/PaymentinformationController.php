<?php
namespace frontend\modules\invoice\application\controllers;


use yii\filters\VerbFilter;
use frontend\modules\invoice\application\models\Salesinvoice;
use frontend\modules\invoice\application\models\SalesinvoiceAmount;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
use frontend\modules\invoice\application\models\Salesinvoicemethodpay;
use frontend\modules\invoice\application\components\Utilities;
use frontend\modules\invoice\application\helpers\DateHelper;
use frontend\modules\invoice\application\helpers\NumberHelper;
use Yii;

class PaymentinformationController extends InvoicesController
{
    public $mdl_invoices;
    public $mdl_payment_methods;
    public $mdl_settings;
    public $mdl_amount;
    public $datehelper;
    public $numberhelper;
    public $gateways;
    
    public function init()
    {
        parent::init();
        $this->mdl_invoices = new Salesinvoice();
        $this->mdl_amount = new SalesinvoiceAmount();
        $this->mdl_payment_methods = new SalesinvoiceMethodPay();
        $this->mdl_settings = new Mdl_settings;
        $this->mdl_settings->load_settings();
        $this->datehelper = new DateHelper;
        $this->numberhelper = new NumberHelper;
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
                                         'form',
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
    
    

    public function actionForm($invoice_url_key = null)
    {
       If (Yii::$app->user->can('Make payment online')){ 
        $disable_form = false;

        // Check if the invoice exists and is billable
        $invoice = $this->mdl_invoices->find()->where(['=','invoice_url_key', $invoice_url_key])->one();
        $balance = $this->mdl_amount->find()->where(['=','invoice_id',$invoice->invoice_id])->one();
        if (empty($invoice)) {
            Yii::$app->session->setFlash('warning',Utilities::trans('invoice_not_found'));
        }

        // Check if the invoice is payable
        if ($balance->invoice_balance == 0) {
            Yii::$app->session->setFlash('warning',Utilities::trans('invoice_already_paid'));            
            $disable_form = true;
        }
        
        // Get all payment gateways
        $moduleinvoice = \Yii::$app->getModule('invoice');
        $this->gateways = $moduleinvoice->params['payment_gateways'];
        $available_drivers = [];
        $driver_payment_method = 0;
        foreach ($this->gateways as $driver => $fields) {
            $d = strtolower($driver);
            if ($this->mdl_settings->get_setting('gateway_' . $d . '_enabled') == 1) {
                $invoice_payment_method = $invoice->payment_method_id;
                $driver_payment_method = $this->mdl_settings->get_setting('gateway_' . $d . '_payment_method');
                //payment_method_id 1 = cash
                //payment_method_id 2 = credit card
                //push the enabled driver to the available drop down list  
                if (//invoice is not cash and not credit 
                    ($invoice_payment_method == 0) 
                    //driver is not cash and not credit    
                    || ($driver_payment_method == 0) 
                    //the invoice and the driver payment methods match        
                    || ($driver_payment_method == $invoice_payment_method)) {
                    array_push($available_drivers, $driver);
                }
            }
        }
        // Get additional invoice information
        $payment_method = $this->mdl_payment_methods->find()->where(['=','payment_method_id', $invoice->payment_method_id])->one();
        // if the sales invoices payment method is cash or credit make $payment_method as null otherwise use payment method as 2 ie. credit
        if ($invoice->payment_method_id < 1) {
            $payment_method = null;
        }
        $is_overdue = ($balance->invoice_balance > 0 && strtotime($invoice->invoice_date_due) < time() ? true : false);
        // Return the view
        $view_data = [
            'disable_form' => $disable_form,
            'invoice' => $invoice,
            'available_gateways' => $available_drivers,
            'driver_payment_method'=> $driver_payment_method,
            'payment_method' => $payment_method,
            'is_overdue' => $is_overdue,
            'balance'=> $balance            
        ];
        return $this->render('paymentinformation', $view_data);
       } else
       {
           Yii::$app->session->setFlash('danger',Yii::t('app','You do not have permission to make an online payment.')); 
       }
    }    
}
