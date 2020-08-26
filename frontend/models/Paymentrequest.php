<?php

namespace frontend\models;

use Yii;

class Paymentrequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function getDb()
    {
       return \frontend\components\Utilities::userdb();
    } 
   
    public static function tableName()
    {
        return 'works_paymentrequest';
    }

    public function rules()
    {
        return [
            [['id', 'sales_order_detail_id', 'gc_payment_request_id', 'status'], 'required'],
            [['id', 'sales_order_detail_id'], 'integer'],
            [['modified_date'], 'safe'],
            [['gc_payment_request_id'], 'string', 'max' => 7],
            [['status'], 'string', 'max' => 25],
            [['id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'sales_order_detail_id' => Yii::t('app','Sales Order Detail ID'),
            'gc_payment_request_id' => Yii::t('app','Gocardless Payment Request ID'),
            'status' => Yii::t('app','Status'),
            'modified_date' => Yii::t('app','Modified Date'),
        ];
    }
}
