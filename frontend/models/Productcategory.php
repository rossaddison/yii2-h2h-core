<?php

namespace frontend\models;

use Yii;

class Productcategory extends \yii\db\ActiveRecord
{
    
     public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }    
    
    public static function tableName()
    {
        return 'works_productcategory';
    }

    public function rules()
    {
        return [
            [['name', 'tax_id'], 'required'],
            [['tax_id'], 'integer'],
            [['description'],'default','value' =>'No description'],
            [['name'], 'string', 'max' => 250],
            [['tax_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tax::className(), 'targetAttribute' => ['tax_id' => 'tax_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app','Name'),
            'tax_id' => Yii::t('app','Tax ID'),
            'modifieddate' => Yii::t('app','Modifieddate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTax()
    {
        return $this->hasOne(Tax::className(), ['tax_id' => 'tax_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsubcategories()
    {
        return $this->hasMany(Productsubcategory::className(), ['productcategory_id' => 'id']);
    }
    
    public function getProduct()
    {
        return $this->hasMany(Product::className(),['productsubcategory_id' => 'id'])->via('productsubcategories');
    }
}
