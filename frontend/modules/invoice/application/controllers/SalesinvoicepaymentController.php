<?php
namespace frontend\modules\invoice\application\controllers;

use Yii;
use frontend\modules\invoice\application\models\SalesinvoicePayment;
use frontend\modules\invoice\application\models\SalesinvoiceAmount;
use frontend\models\Salesorderdetail;
use frontend\modules\invoice\application\models\SalesinvoicePaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalesinvoicePaymentController implements the CRUD actions for SalesinvoicePayment model.
 */
class SalesinvoicepaymentController extends Controller
{
     
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SalesinvoicePayment models.
     * @return mixed
     */
       
    public function actionIndex()
    {
        $searchModel = new SalesinvoicePaymentSearch();
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
                'payment_method_id' => [
                    'asc' => ['payment_method_id' => SORT_ASC],
                    'desc' => ['payment_method_id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
              'invoice_id' => SORT_ASC,
            ]
          ]); 
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionView($id)
    {
       return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //activated from product/views/expandableviewdebtsheet
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('Update Daily Clean')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update this payment.'));
        } 
        $safe = false;
        $view_invoice_id = Yii::$app->session['salesinvoicepayment_invoiceid'];
        $view_payment_expected = Yii::$app->session['salesinvoicepayment_unitprice'];
        //salesinvoicepayment_salesorderdetail_id session value comes from actionPay SalesorderdetailController ActionPay
        //This session value is necessary to foreign link salesorderdetail table with salesinvoicepayment table via payment_id 
        $sod_id = Yii::$app->session['salesinvoicepayment_salesorderdetail_id'];
        //check if the sod_id has a paid value equal to zero
        $zero_paid = Salesorderdetail::find()->where(['=','paid',0])->andWhere(['=','invoice_id',$view_invoice_id])->one();
        //check if total payments made already including this new payment will not exceed the invoice total
        $sum_invoicepayments = SalesinvoicePayment::find()->where(['=','invoice_id',$view_invoice_id])->sum('payment_amount');
        $sum_invoicepayments += $view_payment_expected;
        $salesinvoiceamount = SalesinvoiceAmount::find()->where(['=','invoice_id',$view_invoice_id])->one();
        if (
               ($sum_invoicepayments < $salesinvoiceamount->invoice_total) 
                || 
               ($sum_invoicepayments = $salesinvoiceamount->invoice_total)){
                $safe = true;
        }
        if ((!empty($view_invoice_id))&&(!empty($view_payment_expected))&&(!empty($sod_id))&&!empty($zero_paid)&& $safe){
            $model = new SalesinvoicePayment();
            //salesinvoicepayment_invoiceid session value comes from salesorderdetail actionPay        
            $model->invoice_id = Yii::$app->session['salesinvoicepayment_invoiceid'];
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //the new payment has been saved, now update related tables: salesinvoiceamount and salesorderdetail
                $salesinvoiceamount = SalesinvoiceAmount::find()->where(['=','invoice_id',$view_invoice_id])->one();
                $salesinvoiceamount->invoice_paid = $sum_invoicepayments;
                $salesinvoiceamount->invoice_balance = $salesinvoiceamount->invoice_total-$sum_invoicepayments;
                $salesinvoiceamount->save();
                //record this amount against the salesorderdetail 'paid' field of the individual clean 
                //that came from the expandableviewdebtsheet under salesorderdetails
                $update_sales_order_detail = Salesorderdetail::findOne($sod_id);
                $update_sales_order_detail->paid = $model->payment_amount;
                //record the payment_id against the sales order detail in the sales order detail table
                //so that there is a traceable connection.
                $update_sales_order_detail->payment_id = $model->payment_id;
                $update_sales_order_detail->save();
                return $this->redirect(['view', 'id' => $model->payment_id]);
            } else
            {    
            return $this->render('create', [
                'model' => $model , 'view_invoice_id'=>$view_invoice_id, 'view_payment_expected'=>$view_payment_expected, 'sodid' => $sod_id,'zeropaid'=>$zero_paid,'safe' => $safe
            ]);
            }
        } 
    }
    
     public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('Update Daily Clean')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update this payment.'));
        } 
        $model = $this->findModel($id);
        //get the unit price and sod which we will use on the form
        $get_sales_order_detail = Salesorderdetail::find()->where(['=','invoice_id',$model->invoice_id])
                                                                     ->andWhere(['=','payment_id',$model->payment_id])
                                                                     ->one();
        $view_payment_expected = $get_sales_order_detail->unit_price;
        $sod_id = $get_sales_order_detail->sales_order_detail_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $sum_invoicepayments = SalesinvoicePayment::find()->where(['=','invoice_id',$model->invoice_id])->sum('payment_amount');
                $salesinvoiceamount = SalesinvoiceAmount::find()->where(['=','invoice_id',$model->invoice_id])->one();
                $salesinvoiceamount->invoice_paid = $sum_invoicepayments;
                $salesinvoiceamount->invoice_balance = $salesinvoiceamount->invoice_total-$sum_invoicepayments;
                $salesinvoiceamount->save();
                //record this amount against the salesorderdetail 'paid' field of the individual clean 
                //that came from the expandableviewdebtsheet under salesorderdetails
                $get_sales_order_detail = Salesorderdetail::find()->where(['=','invoice_id',$model->invoice_id])
                                                                     ->andWhere(['=','payment_id',$model->payment_id])
                                                                     ->one();
                $get_sales_order_detail->paid = $model->payment_amount;
                $get_sales_order_detail->save();
                return $this->redirect(['view', 'id' => $model->payment_id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'view_invoice_id'=>$model->invoice_id, 'view_payment_expected'=>$view_payment_expected, 'sodid' => $sod_id,'zeropaid'=>$get_sales_order_detail,'safe' => true
            ]);
        }
    }    
    
    //This procedure is no longer used
    //activated from salesinvoicepayment/views/viewinvoicepayments.php and similar to above action create
    protected function actionPayinvoice($sodid, $invoiceid, $unitprice)
    {
        $safe = false;
        $view_invoice_id = $invoiceid;
        $view_payment_expected = $unitprice;
        //salesinvoicepayment_salesorderdetail_id session value comes from actionPay SalesorderdetailController ActionPay
        //This session value is necessary to foreign link salesorderdetail table with salesinvoicepayment table via payment_id 
        $sod_id = $sodid;
        //check if the sod_id has a paid value equal to zero
        $zero_paid = Salesorderdetail::find()->where(['=','paid',0])->andWhere(['=','invoice_id',$view_invoice_id])->one();
        //check if total payments made already including this new payment will not exceed the invoice total
        $sum_invoicepayments = SalesinvoicePayment::find()->where(['=','invoice_id',$view_invoice_id])->sum('payment_amount');
        $sum_invoicepayments += $view_payment_expected;
        $salesinvoiceamount = SalesinvoiceAmount::find()->where(['=','invoice_id',$view_invoice_id])->one();
        if (
               ($sum_invoicepayments < $salesinvoiceamount->invoice_total) 
                || 
               ($sum_invoicepayments = $salesinvoiceamount->invoice_total)){
                $safe = true;
        }
        if ((!empty($view_invoice_id))&&(!empty($view_payment_expected))&&(!empty($sod_id))&&!empty($zero_paid)&& $safe){
            $model = new SalesinvoicePayment();
            //salesinvoicepayment_invoiceid session value comes from salesorderdetail actionPay        
            $model->invoice_id = $invoiceid;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //the new payment has been saved, now update related tables: salesinvoiceamount and salesorderdetail
                $salesinvoiceamount = SalesinvoiceAmount::find()->where(['=','invoice_id',$view_invoice_id])->one();
                $salesinvoiceamount->invoice_paid = $sum_invoicepayments;
                $salesinvoiceamount->invoice_balance = $salesinvoiceamount->invoice_total-$sum_invoicepayments;
                $salesinvoiceamount->save();
                //record this amount against the salesorderdetail 'paid' field of the individual clean 
                //that came from the expandableviewdebtsheet under salesorderdetails
                $update_sales_order_detail = Salesorderdetail::findOne($sod_id);
                $update_sales_order_detail->paid = $model->payment_amount;
                //record the payment_id against the sales order detail in the sales order detail table
                //so that there is a traceable connection.
                $update_sales_order_detail->payment_id = $model->payment_id;
                $update_sales_order_detail->save();
                return $this->redirect(['view', 'id' => $model->payment_id]);
            } else
            {    
            return $this->render('create', [
                'model' => $model , 'view_invoice_id'=>$view_invoice_id, 'view_payment_expected'=>$view_payment_expected, 'sodid' => $sod_id,'zeropaid'=>$zero_paid,'safe' => $safe
            ]);
            }
        } 
    }
    
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //only accept proposed cash payment deletions which are designated by 1
        if (($model->payment_method_id) == 1) {
            //remove the payment id and reduce sod's paid to zero
            $sod = Salesorderdetail::find()->where(['=','payment_id',$id])->one();
            $sod->payment_id = null;
            $sod->unit_price = 0;
            $sod->save();
            //reduce the salesinvoiceamount table
            $salesinvoiceamount = SalesinvoiceAmount::find()->where(['=','invoice_id',$model->invoice_id])->one();
            $sum_invoicepayments = SalesinvoicePayment::find()->where(['=','invoice_id',$model->invoice_id])->sum('payment_amount');
            $salesinvoiceamount->invoice_paid = $sum_invoicepayments;
            $salesinvoiceamount->invoice_balance = $salesinvoiceamount->invoice_total-$sum_invoicepayments;
            $salesinvoiceamount->save();
            $model->delete();        
            return $this->redirect(['index']);
        } else {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You can only delete cash payments.'));
        }
    }

    protected function findModel($id)
    {
        if (($model = SalesinvoicePayment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
