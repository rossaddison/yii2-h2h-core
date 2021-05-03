<?php
namespace frontend\modules\invoice\application\controllers;

use frontend\modules\invoice\application\models\Salesinvoice;
use frontend\modules\invoice\application\helpers\EchoHelper;
use frontend\modules\invoice\application\helpers\NumberHelper;
use frontend\modules\invoice\application\helpers\DateHelper;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
use Yii;
use yii\web\Controller;
use yii\db\Expression;
use yii\db\Query;

class GuestController extends Controller
{
    public $layout;
    
    public $dateHelper;
    
    public $mdl_settings;
    
    public $echoHelper;
    
    public $numberHelper;

    public $houses;    
    
    public function init()
    {
        parent::init();
        $this->layout = 'layout_guest';
        $this->echoHelper = new EchoHelper();  
        $this->numberHelper = new NumberHelper();
        $this->dateHelper = new DateHelper();
        $this->mdl_settings = new Mdl_settings();
        $this->mdl_settings->load_settings();
         //find all houses that have been assigned for this user to pay
        $this->houses = new Query();
        $this->houses->select('id')
              ->from('works_product')
              ->where(['=','user_id',Yii::$app->user->id])
              ->all();
    }
        
    public function actionIndex()
    {
        $this->layout = 'layout_guest';
        //the user has been registered by you (preferably with fencemode on), assigned the 'Make a payment online' permission via RBAC sjaak/pluto
        If (Yii::$app->user->can('Make payment online')){
            if (!empty($this->houses)) {
                $now = new Expression('NOW()'); 
                    $overdue_invoices = Salesinvoice::find()->where(['in','product_id',$this->houses])
                                                            ->andWhere(['<>','invoice_status_id', 1])
                                                            ->andWhere(['<>','invoice_status_id', 4])
                                                            ->andWhere(['>',$now,'invoice_date_due'])
                                                            ->orderBy('invoice_date_due')
                                                            ->all();
                    $open_invoices = Salesinvoice::find()->where(['in','product_id',$this->houses])
                                                         ->andWhere(['in','invoice_status_id', [2, 3]])
                                                         ->orderBy('invoice_date_due')
                                                         ->all();
                
                if (!empty($overdue_invoices) || !empty($open_invoices)){
                   return $this->render('guest_index',['overdue_invoices'=>$overdue_invoices,'open_invoices'=>$open_invoices,'numberHelper'=>$this->numberHelper,'dateHelper'=>$this->dateHelper]);
                }  elseif ((empty($overdue_invoices)) && empty($open_invoices)) 
                {
                   Yii::$app->session->setFlash('warning',Yii::t('app','You have no overdue invoices and no unpaid invoices. You are fully paid up. Thank-you.'));                
                   return $this->render('guest_index',['overdue_invoices'=> $overdue_invoices,'open_invoices'=>$open_invoices,'numberHelper'=>$this->numberHelper,'dateHelper'=>$this->dateHelper]);
                }
            } else
            //the user CAN make a payment online but the administrator has not associated the user with a house
            {
              Yii::$app->session->setFlash('warning',Yii::t('app','You have permission to make an online payment but you have not been associated with a house by your administrator.'));                
              return $this->render('guest_index',['overdue_invoices'=> $overdue_invoices,'open_invoices'=>$open_invoices]);        
            } 
        }
        else    
        {
              Yii::$app->session->setFlash('danger',Yii::t('app','You do not have permission to make an online payment.')); 
              return $this->render('guest_index',['overdue_invoices'=> $overdue_invoices,'open_invoices'=>$open_invoices]);
        }  
    }     
}
