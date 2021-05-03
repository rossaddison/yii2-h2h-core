<?php
namespace frontend\modules\invoice\application\controllers;

use yii\filters\VerbFilter;
use frontend\modules\invoice\application\models\Salesinvoice;
use frontend\modules\invoice\application\models\Settings;
use frontend\modules\invoice\application\models\SalesinvoiceAmount;
use frontend\modules\invoice\application\models\SalesinvoicePayment;
use frontend\modules\invoice\application\models\SalesinvoiceMerchantResponse;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
use frontend\modules\invoice\application\helpers\SettingsHelper;
use frontend\modules\invoice\application\libraries\Crypt;
use frontend\modules\invoice\application\components\Utilities;
use frontend\modules\invoice\application\controllers\GuestController;
use frontend\models\Salesorderdetail;
use yii\helpers\Url;
use Yii;

class PaymenthandlerController extends GuestController
{
    public $crypt;
    
    public $layout;
    
    public $mdl_settings;
    
    public $dictionary;
    
    public $settingsHelper;
    
    public function init()
    {
        parent::init();
        $this->layout = 'layout_guest';
        $this->crypt = new Crypt;
        $this->mdl_settings = new Mdl_settings;
        $this->mdl_settings->load_settings();
        $this->dictionary = Utilities::languages();
        $this->settingsHelper = new SettingsHelper();        
    }
    
    public function behaviors()
    {
        return ['verbs' => ['class' => VerbFilter::className(),'actions' => ['delete' => ['POST'], ],],
                'access' =>['class' => \yii\filters\AccessControl::className(),'only' => [
                                         'makepayment','paymentreturn','paymentcancel',
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
        
    public function actionMakepayment()
    {
        //Attempt to get the invoice
        $invoice = Salesinvoice::find()->where(['=','invoice_url_key',Yii::$app->request->post('invoice_url_key')])->one();
        $invoiceamount = SalesinvoiceAmount::find()->where(['=','invoice_id',$invoice->invoice_id])->one();
        if ($invoiceamount->invoice_balance == 0) {
            Yii::$app->session->setFlash('success',Yii::t('app','Fully paid.'));
            return $this->redirect(['@web/invoice/paymentinformation/form','invoice_url_key' => Yii::$app->request->post('invoice_url_key')]);
        }
        if (!empty($invoice)) {

             // Initialize the gateway
            $driver = Yii::$app->request->post('gateway');
            $d = strtolower($driver);
            $gateway = $this->initialize_gateway($driver);

            // Get the credit card data
            $cc_number = Yii::$app->request->post('creditcard_number');
            $cc_expire_month = Yii::$app->request->post('creditcard_expiry_month');
            $cc_expire_year = Yii::$app->request->post('creditcard_expiry_year');
            $cc_cvv = Yii::$app->request->post('creditcard_cvv');            
            
            if ($cc_number) {
                try {
                    $credit_card = new \Omnipay\Common\CreditCard([
                        'number' => $cc_number,
                        'expiryMonth' => $cc_expire_month,
                        'expiryYear' => $cc_expire_year,
                        'cvv' => $cc_cvv,
                    ]);
                    $credit_card->validate();
                } catch (\Omnipay\Common\InvalidCreditCardException $e) {
                    // Redirect the user and display failure message
                    Yii::$app->session->setFlash('error',Utilities::trans('online_payment_card_invalid') . '<br/>' . $e->getMessage());
                    return $this->redirect(['@web/invoice/paymentinformation/form','invoice_url_key' => $invoice->invoice_url_key]);
                    
                }
            } else {
                $credit_card = [];
            }
            // Set up the api data
            $driver_currency = $this->mdl_settings->setting('gateway_' . $d . '_currency');

            $request = [
                //pay the full invoice balance
                'amount' => $invoiceamount->invoice_balance,
                'currency' => $driver_currency,
                'card' => $credit_card,
                'description' => sprintf(Utilities::trans('payment_description'), $invoice->invoice_id),
                'metadata' => [
                    'invoice_number' => $invoice->invoice_id,
                    'invoice_guest_url' => $invoice->invoice_url_key,
                ],
                'returnUrl' => Url::toRoute(['paymentreturn','invoice_url_key'=> $invoice->invoice_url_key,'driver'=>$driver]),
                'cancelUrl' => Url::toRoute(['paymentcancel','invoice_url_key'=> $invoice->invoice_url_key,'driver'=>$driver]),
            ];

            if ($d === 'worldpay') {
                // Additional param for WorldPay
                $request['cartId'] = $invoice->invoice_id;
            }
            
            if ($d === 'braintree') {
                ////test credit card number   4111111111111111
                //payment method nonce used  'fake-valid-nonce'
                if ($this->mdl_settings->get_setting('gateway_' . $d . '_testMode') == 1) {
                    //https://developers.braintreepayments.com/reference/general/testing/php#avs-and-cvv/cid-responses
                    $request['paymentMethodNonce'] = 'fake-valid-no-billing-address-nonce';
                } elseif ($this->mdl_settings->get_setting('gateway_' . $d . '_testMode') == 0) {
                    $request['paymentMethodNonce'] = $gateway->clientToken()->send()->getToken();                    
                }
            }
            
            //used in payment_validate
            Yii::$app->session[$invoice->invoice_url_key . '_online_payment'] = $request;

            // Send the request
            try {
               $response = $gateway->purchase($request)->send();
            } catch ( \Exception $e){
                 Yii::$app->session->setFlash('error', 'Gateway exception: '. $e->getMessage());
                 return $this->redirect(['@web/invoice/paymentinformation/form','invoice_url_key' => $invoice->invoice_url_key]);
            }
            $reference = $response->getTransactionReference() ? $response->getTransactionReference() : '[no transation reference]';

            // Process the response
            if ($response->isSuccessful()) {
                $payment_note = Utilities::trans('transaction_reference') . ': ' . $reference . "\n";
                $payment_note .= Utilities::trans('payment_provider') . ': ' . ucwords(str_replace('_', ' ', $d));
                $mdl_payments = new SalesinvoicePayment();
                $mdl_payments->invoice_id = $invoice->invoice_id;
                $mdl_payments->payment_date = date('Y-m-d');
                $mdl_payments->payment_amount = $invoiceamount->invoice_balance;
                $mdl_payments->payment_method_id = $invoice->payment_method_id;
                $mdl_payments->payment_note = $payment_note;      
                $mdl_payments->save();
                
                //change the invoice status to paid ie. 4
                $invoice->invoice_status_id = 4;
                $invoice->save();   
                
                //update the invoice balance if successful
                $invoiceamount->invoice_balance -= $mdl_payments->payment_amount;
                $invoiceamount->invoice_paid  += $mdl_payments->payment_amount;
                $invoiceamount->save();
                
                //update the individual cleans on the invoice
                foreach ($invoice->salesorderdetails as $salesorderdetail) {
                      $sod = Salesorderdetail::find()->where(['=','sales_order_detail_id',$salesorderdetail['sales_order_detail_id']])->one();
                      $sod->paid = $sod->unit_price;
                      $sod->payment_id = $mdl_payments->payment_id;
                      $sod->save();
                }        
                
                $payment_success_msg = sprintf(Utilities::trans('online_payment_payment_successful'), $invoice->invoice_id);
                $merchant_response = new SalesinvoiceMerchantResponse();
                $merchant_response->invoice_id = $invoice->invoice_id;
                $merchant_response->merchant_response_successful = 1;
                $merchant_response->merchant_response_date = date('Y-m-d');
                $d = strtolower($driver);
                $merchant_response->merchant_response_driver = $d;
                $merchant_response->merchant_response = $payment_success_msg;
                $merchant_response->merchant_response_reference = $reference;
                $merchant_response->save();                
                Yii::$app->session->setFlash('success',$payment_success_msg);
                //ViewController actionInvoice
                return $this->redirect(['@web/invoice/view/invoice','invoice_url_key'=> $invoice->invoice_url_key]);
                
            } elseif ($response->isRedirect()) {
                $response->redirect();
            } else {
                $merchant_response = new SalesinvoiceMerchantResponse();
                $merchant_response->invoice_id = $invoice->invoice_id;
                $merchant_response->merchant_response_successful = 0;
                $merchant_response->merchant_response_date = date('Y-m-d');
                $d = strtolower($driver);
                $merchant_response->merchant_response_driver = $d;
                $merchant_response->merchant_response = $response->getMessage();
                $merchant_response->merchant_response_reference = $reference;
                $merchant_response->save();       
                // Redirect the user and display failure message
                Yii::$app->session->setFlash('error',Utilities::trans('online_payment_payment_failed') . '<br/>' . $response->getMessage());   
                return $this->redirect(['@web/invoice/paymentinformation/form','invoice_url_key'=>$invoice->invoice_url_key]);                
            }
        }
    }

    protected function initialize_gateway($driver)
    {
        $d = strtolower($driver);
        $settings = Settings::find()->where(['like','setting_key', 'gateway_' . strtolower($driver)])->all();
        // Get the payment gateway fields
        $moduleinvoice = \Yii::$app->getModule('invoice');
        $gateway_settings = $moduleinvoice->params['payment_gateways'];
        $gateway_settings = $gateway_settings[$driver];
        $gateway_init = [];
        foreach ($settings as $setting) {
            // Sanitize the field key
            $key = str_replace('gateway_' . $d . '_', '', $setting->setting_key);
            $key = str_replace('gateway_' . $d, '', $key);

            // skip empty key
            if (!$key) {
                continue;
            }
            // Decode password fields and checkboxes
            if (isset($gateway_settings[$key]) && $gateway_settings[$key]['type'] == 'password') {
                $value = $this->crypt->decode($setting->setting_value);
            } elseif (isset($gateway_settings[$key]) && $gateway_settings[$key]['type'] == 'checkbox') {
                $value = $setting->setting_value == '1' ? true : false;
            } else {
                $value = $setting->setting_value;
            }
            $gateway_init[$key] = $value;
        }
        // Load Omnipay and initialize the gateway
        try {
            $gateway = \Omnipay\Omnipay::create($driver);
            $gateway->initialize($gateway_init);
            return $gateway;
        } catch (\Omnipay\Common\Exception $e){
            Yii::$app->session->setFlash('danger',Yii::t('app','Gateway not found. Install omnipay/gateway in composer.json from github.com\omnipay\omnipay.'). '<br/>' . $e->getMessage());
            return $this->redirect(['@web/invoice/paymentinformation/form','invoice_url_key'=>Yii::$app->request->post('invoice_url_key')]); 
        }        
    }

    public function actionPaymentreturn($invoice_url_key, $driver)
    {
        $d = strtolower($driver);

        // See if the response can be validated
        if ($this->payment_validate($invoice_url_key, $driver)) {

            // Save the payment for the invoice
            $invoice = Salesinvoice::find()->where(['=','invoice_url_key', $invoice_url_key])->one();
            $invoiceamount = SalesinvoiceAmount::find()->where(['=','invoice_id',$invoice->invoice_id])->one();
            $payment = SalesinvoicePayment::find()->where(['=','invoice_id',$invoice->invoice_id])->one();
            $payment->invoice_id = $invoice->invoice_id;
            $payment->payment_date = date('Y-m-d');
            $payment->payment_amount = $invoiceamount->invoice_balance;
            $payment->payment_method_id = ($this->mdl_settings->get_setting('gateway_' . $d . '_payment_method')) ? $this->mdl_settings->get_setting('gateway_' . $d . '_payment_method') : 0;
            $payment->save();

            // Set the success flash message
            Yii::$app->session->setFlash('success',sprintf(Utilities::trans('online_payment_payment_successful'),$invoice->invoice_id));   
        } else {
            // Set the failure flash message
            Yii::$app->session->setFlash('error',Utilities::trans('online_payment_payment_failed') . '<br/>' . $response->getMessage());   
        }

        // Redirect to guest invoice view with flash message
        return $this->redirect(['@web/invoice/view/invoice','invoice_url_key' => $invoice_url_key]);
    }

    protected function payment_validate($invoice_url_key, $driver, $canceled = false)
    { 
        // Attempt to get the invoice
        $invoice = Salesinvoice::find()->where(['=','invoice_url_key', $invoice_url_key])->one();

        $payment_success = 0;

        if (!empty($invoice)) {
            if (!$canceled) {
                $gateway = $this->initialize_gateway($driver);

                // Load previous settings
                $params = Yii::$app->session[$invoice->invoice_url_key . '_online_payment']; 
                if (isset($_GET['PayerID'])) {
                    $params['transactionReference'] = $_GET['PayerID'];
                }
                $response = $gateway->completePurchase($params)->send();
                $payment_success = 1;

                $message = $response->getMessage() ? $response->getMessage() : 'No details provided';
            } else {
                $response = '';
                $message = 'Customer cancelled the purchase process';
            }

            $merchant_response = new SalesinvoiceMerchantResponse();
            $merchant_response->invoice_id = $invoice->invoice_id;
            $merchant_response->merchant_response_successful = $payment_success;
            $merchant_response->merchant_response_date = date('Y-m-d');
            $merchant_response->merchant_response_driver = $driver;
            $merchant_response->merchant_response = $message;
            $merchant_response->merchant_response_reference = $canceled ? '' : $response->getTransactionReference();
            $merchant_response->save(); 
            return true;
        }
        return false;
    }

    public function actionPaymentcancel($invoice_url_key, $driver)
    {
        // Validate the response
        $this->payment_validate($invoice_url_key, $driver, true);

        // Set the cancel flash message
        Yii::$app->session->setFlash('warning',Utilities::trans('online_payment_payment_cancelled'));   
        
        // Redirect to guest invoice view with flash message
        return $this->redirect(['@web/invoice/view/invoice', 'invoice_url_key' => $invoice_url_key]);
    }
}
