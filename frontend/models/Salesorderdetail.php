<?php

namespace frontend\models;

use frontend\models\Salesorderheader;
use frontend\models\Productcategory;
use frontend\models\Productsubcategory;
use frontend\models\Product;
use Yii;

class Salesorderdetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'works_salesorderdetail';
    }
    
   public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }     

    public function rules()
    {
        return [
            [['nextclean_date','sales_order_id', 'productcategory_id','productsubcategory_id', 'product_id', 'unit_price'], 'required'],
            [['sales_order_id','productcategory_id','productsubcategory_id', 'product_id'], 'integer'],
            [['nextclean_date'], 'safe'],
            [['cleaned'],'default','value'=>'Cleaned'],
            [['order_qty'],'default','value'=>1],
            [['line_total'],'default','value'=>1],
            [['order_qty'], 'number'],
            [['unit_price','paid'], 'number','min'=>0.00,'max'=>1000.00],
            [['unit_price','paid','order_qty'], 'default','value' => 0.00],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['sales_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Salesorderheader::className(), 'targetAttribute' => ['sales_order_id' => 'sales_order_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'sales_order_id' => Yii::t('app','Daily Clean ID'),
            'sales_order_detail_id' => Yii::t('app','House(s) to Clean ID'),
            'nextclean_date' => Yii::t('app','Next Clean Date'),
            'productcategory_id' => Yii::t('app','Postal Code'),
            'productsubcategory_id'=>Yii::t('app','Street'),
            'product_id'=>Yii::t('app','House'),
            'product_id.homeowner' => Yii::t('app','Homeowner'),
            'product_id.productnumber'=>Yii::t('app','House Number'),
            'order_qty'=>Yii::t('app','Order Qty'),
            'unit_price' => Yii::t('app','Unit Price'),
            'line_total'=> Yii::t('app','Line Total'),
            'paid' => Yii::t('app','Paid'),
            'modified_date' => Yii::t('app','Modified Date'),
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
    
    public function getProductcategory()
    {
        return $this->hasOne(Productcategory::className(), ['id' => 'productcategory_id']);
    }

    public function getProductsubcategory()
    {
        return $this->hasOne(Productsubcategory::className(), ['id' => 'productsubcategory_id']);
    }
    
    public function getSalesOrder()
    {
        return $this->hasOne(Salesorderheader::className(), ['sales_order_id' => 'sales_order_id']);
    }
    
    public function getInstructioncode()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'instruction_id']);
    }
    
    public function getResultcode()
    {
        return $this->hasOne(Result::className(), ['id' => 'result_id']);
    }
    
    public function getPaymentrequest()
    {
        return $this->hasMany(Paymentrequest::className(), ['id' => 'paymentrequest_id']);
    }
    
    
    
}
