<?php

namespace frontend\modules\invoice\application\models;

use frontend\modules\invoice\application\models\SalesinvoicePayment;

use Yii;

/**
 * This is the model class for table "works_salesinvoicemethodpay".
 *
 * @property int $payment_method_id
 * @property string|null $payment_method_name
 *
 * @property WorksSalesinvoicePayment[] $worksSalesinvoicePayments
 */
class Salesinvoicemethodpay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'works_salesinvoicemethodpay';
    }
    
    public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }  

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_method_name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_method_id' => Yii::t('app', 'Payment Method ID'),
            'payment_method_name' => Yii::t('app', 'Payment Method Name'),
        ];
    }

    /**
     * Gets query for [[WorksSalesinvoicePayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesinvoicePayments()
    {
        return $this->hasMany(SalesinvoicePayment::className(), ['payment_method_id' => 'payment_method_id']);
    }
}
