<?php
namespace frontend\modules\invoice\application\models;

use frontend\modules\invoice\application\models\SalesinvoiceMethodpay;
use frontend\modules\invoice\application\models\SalesinvoiceAmount;
use frontend\modules\invoice\application\models\SalesinvoiceStatus;
use frontend\modules\invoice\application\models\SalesinvoicePayment;
use frontend\modules\invoice\application\models\SalesinvoiceUploads;
use frontend\models\Salesorderdetail;
use frontend\models\Product;
use sjaakp\pluto\models\User;
use Yii;
use yii\db\Expression;

use yii\db\Query;

/**
 * This is the model class for table "works_salesinvoice".
 *
 * @property int $invoice_id
 * @property int $invoice_status_id
 * @property int|null $is_read_only
 * @property string $invoice_date_created
 * @property string $invoice_time_created
 * @property string $invoice_date_modified
 * @property string $invoice_date_due
 * @property string $invoice_url_key
 * @property int $payment_method_id
 */
class Salesinvoice extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'works_salesinvoice';
    }
    
    public static function getDb()
    {
       return \frontend\components\Utilities::userdb();
    }  
   
    public function rules()
    {
        return [
            [['invoice_status_id', 'payment_method_id','product_id'], 'integer'],
            [['is_read_only'],'boolean'],
            [['invoice_date_created', 'invoice_date_due', 'invoice_url_key'], 'required'],
            [['invoice_date_created', 'invoice_time_created', 'invoice_date_modified', 'invoice_date_due'], 'safe'],
            [['invoice_url_key'], 'string', 'max' => 255],
            [['reference'], 'string', 'max' => 8],
            [['product_id'], 'exist', 'targetClass' => Product::className(), 'targetAttribute' => 'id','filter'=>function (Query $query) {
                $query->andWhere(['id' => $this->product_id]);} ],
            ['payment_method_id', 'exist', 'targetClass' => SalesinvoiceMethodpay::className(), 'targetAttribute' => 'payment_method_id', 'filter' => function (Query $query) {
                $query->andWhere(['payment_method_id' => $this->payment_method_id]);}],
        ];
    }

    public function attributeLabels()
    {
        return [
            'invoice_id' => Yii::t('app','Invoice ID'),
            'invoice_status_id' => Yii::t('app','Invoice Status ID'),
            'product_id' => Yii::t('app','House'),
            'user_id'=> Yii::t('app','User'),
            'is_read_only' => Yii::t('app','Is Read Only'),
            'reference' => Yii::t('app','Customer Reference'),
            'invoice_date_created' => Yii::t('app','Invoice Date Created'),
            'invoice_time_created' => Yii::t('app','Invoice Time Created'),
            'invoice_date_modified' => Yii::t('app','Invoice Date Modified'),
            'invoice_date_due' => Yii::t('app','Invoice Date Due after '),
            'invoice_url_key' => Yii::t('app','Invoice Url Key'),
            'payment_method_id' => Yii::t('app','Payment Method ID'),
        ];
    }
    
    public function getSalesinvoiceamount()
    {
        return $this->hasOne(SalesinvoiceAmount::className(), ['invoice_id' => 'invoice_id']);
    }
    
    public function getSalesinvoicepayments()
    {
        return $this->hasMany(SalesinvoicePayment::className(), ['invoice_id' => 'invoice_id']);
    }
    
    public function getSalesinvoicetotalpaid()
    {
        return $this->hasMany(SalesinvoicePayment::className(), ['invoice_id' => 'invoice_id'])->sum('payment_amount');
    }
    
    public function getSalesorderdetails()
    {
        return $this->hasMany(Salesorderdetail::className(), ['invoice_id' => 'invoice_id']);
    }
    
    public function getCustomerdetails()
    {
        return $this->hasOne(Product::className(),['id'=>'product_id'])->viaTable('works_salesorderdetail',['invoice_id'=>'invoice_id']);
    }
    
    public function getHouseholder()
    {
        return $this->hasOne(Product::className(),['id'=>'product_id']);
    }
    
    public function getPaymentmethod()
    {
        return $this->hasOne(SalesinvoiceMethodpay::className(),['payment_method_id'=>'payment_method_id']);
    }
    
    public function getStatus()
    {
        return $this->hasOne(SalesinvoiceStatus::className(),['id'=>'invoice_status_id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
    
    public function getUploads()
    {
        return $this->hasMany(SalesinvoiceUploads::classname(),['url_key'=>'invoice_url_key']);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
             $this->invoice_date_modified = new Expression('NOW()');    
            return true;
        }
        return false;
    }
}
