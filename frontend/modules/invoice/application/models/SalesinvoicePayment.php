<?php

namespace frontend\modules\invoice\application\models;

use frontend\modules\invoice\application\models\Salesinvoicemethodpay;
use frontend\modules\invoice\application\models\Salesinvoice;
use Yii;

class SalesinvoicePayment extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'works_salesinvoicepayment';
    }
    
    public static function getDb()
    { 
       return \frontend\components\Utilities::userdb();
    } 

    public function rules()
    {
        return [
            [['invoice_id', 'payment_method_id', 'payment_date'], 'required'],
            [['invoice_id', 'payment_method_id'], 'integer'],
            [['payment_date'], 'safe'],
            [['payment_amount'], 'number'],
            [['payment_amount'],'default','value' => 0.00],            
            [['payment_note'], 'string'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Salesinvoice::className(), 'targetAttribute' => ['invoice_id' => 'invoice_id']],
            [['payment_method_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesinvoiceMethodPay::className(), 'targetAttribute' => ['payment_method_id' => 'payment_method_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'payment_id' => Yii::t('app', 'Payment'),
            'invoice_id' => Yii::t('app', 'Invoice'),
            'payment_method_id' => Yii::t('app', 'Payment Method'),
            'payment_date' => Yii::t('app', 'Payment Date'),
            'payment_amount' => Yii::t('app', 'Payment Amount'),
            'payment_note' => Yii::t('app', 'Payment Note'),
        ];
    }
    
    public function getInvoice()
    {
        return $this->hasOne(Salesinvoice::className(), ['invoice_id' => 'invoice_id']);
    }

    public function getPaymentmethod()
    {
        return $this->hasOne(SalesinvoiceMethodPay::className(), ['payment_method_id' => 'payment_method_id']);
    }           
}
