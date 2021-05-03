<?php
namespace frontend\modules\invoice\application\models;
use Yii;

class SalesinvoiceMerchantResponse extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'works_salesinvoicemerchantresponse';
    }
    
    public static function getDb()
    { 
       return \frontend\components\Utilities::userdb();
    } 

    public function rules()
    {
        return [
            [['invoice_id', 'merchant_response_date'], 'required'],
            [['invoice_id', 'merchant_response_successful'], 'integer'],
            [['merchant_response_date'], 'safe'],
            [['merchant_response_driver'], 'string', 'max' => 35],
            [['merchant_response', 'merchant_response_reference'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'merchant_response_id' => Yii::t('app', 'Merchant Response ID'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'merchant_response_successful' => Yii::t('app', 'Merchant Response Successful'),
            'merchant_response_date' => Yii::t('app', 'Merchant Response Date'),
            'merchant_response_driver' => Yii::t('app', 'Merchant Response Driver'),
            'merchant_response' => Yii::t('app', 'Merchant Response'),
            'merchant_response_reference' => Yii::t('app', 'Merchant Response Reference'),
        ];
    }
}
