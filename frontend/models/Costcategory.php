<?php

namespace frontend\models;

use Yii;

class Costcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
   public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }
    
    
    public static function tableName()
    {
        return 'works_costcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tax_id'], 'required'],
            [['tax_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['tax_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tax::className(), 'targetAttribute' => ['tax_id' => 'tax_id']],
        ];
    }

    
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
    public function getCostsubcategories()
    {
        return $this->hasMany(Costsubcategory::className(), ['costcategory_id' => 'id']);
    }
}
