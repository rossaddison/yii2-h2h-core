<?php
namespace frontend\modules\invoice\application\controllers;

use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use frontend\modules\invoice\application\helpers\EchoHelper;
use frontend\modules\invoice\application\helpers\NumberHelper;
use frontend\modules\invoice\application\helpers\DateHelper;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
use yii\web\Controller;
use Yii;

class PaymentsController extends Controller
{
    public $echoHelper;
    
    public $numberHelper;
    
    public $dateHelper; 
    
    public $mdl_settings;
    
    public function init()
    {
        parent::init();
        $this->layout = 'layout_guest';
        $this->echoHelper = new EchoHelper();  
        $this->numberHelper = new NumberHelper();
        $this->dateHelper = new DateHelper();
        $this->mdl_settings = new Mdl_settings();
        $this->mdl_settings->load_settings();
    }
    
    public function actionIndex()
    {
        //these houses/aka products were assigned to the user on signup through the product/index
        //get all the houses that this user is paying for
        $houses = new Query();
        $houses->select('id')
              ->from('works_product')
              ->where(['=','user_id',Yii::$app->user->id])
              ->all();
        //get all the invoices that belong to these houses
        $invoices = new Query();
        $invoices->select('invoice_id')
              ->from('works_salesinvoice')
              ->where(['in','product_id',$houses])
              ->all();
        //get all the payments that have been made against these invoices
        $payments = new Query();
        $payments->select('*')
                    ->from('works_salesinvoicepayment')
                    ->where(['in','invoice_id',$invoices])
                    ->all();        
       
        $query = new ActiveDataProvider([
              'query' =>  $payments
        ]);
       $countPayments = clone $query;
       $pages = new Pagination(['totalCount' => $countPayments->query->count()]);       
       $payments = $countPayments->query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
       
       $array = [
                    'payments' => $payments,
                    'pages'=>$pages
       ]; 
       
       return $this->render('payments_index',$array);        
    }
}
