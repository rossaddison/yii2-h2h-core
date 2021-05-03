<?php

namespace frontend\modules\invoice\application\models;

use frontend\modules\invoice\application\models\Salesinvoice;

class SalesinvoiceAmount extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'works_salesinvoiceamount';
    }
    
    public static function getDb()
    {
       return \frontend\components\Utilities::userdb();
    }  

    public function rules()
    {
        return [
            [['invoice_id'], 'required'],
            [['invoice_id'], 'integer'],
            [['invoice_sign'], 'string'],
            [['invoice_total', 'invoice_paid', 'invoice_balance'], 'number'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Salesinvoice::className(), 'targetAttribute' => ['invoice_id' => 'invoice_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'invoice_amount_id' => 'Invoice Amount ID',
            'invoice_id' => 'Invoice ID',
            'invoice_sign' => 'Invoice Sign',
            'invoice_total' => 'Invoice Total',
            'invoice_paid' => 'Invoice Paid',
            'invoice_balance' => 'Invoice Balance',
        ];
    }

    public function getInvoice()
    {
        return $this->hasOne(Salesinvoice::className(), ['invoice_id' => 'invoice_id']);
    }
        
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        if (parent::afterSave($insert, $changedAttributes)) {
             $this->invoice_date_modified = new Expression('NOW()');       
            return true;
        }
        return false;
    }
}
