<?php
namespace frontend\models;

use Yii;

class Tax extends \yii\db\ActiveRecord
{
    
     public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   } 
        
    public static function tableName()
    {
        return 'works_tax';
    }

    public function rules()
    {
        return [
            [['tax_type', 'tax_name', 'tax_percentage'], 'required'],
            [['tax_percentage'], 'number'],
            [['tax_type'], 'string', 'max' => 2],
            [['tax_name'], 'string', 'max' => 30],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tax_id' => Yii::t('app','Tax ID'),
            'tax_type' => Yii::t('app','Tax Type'),
            'tax_name' => Yii::t('app','Tax Name'),
            'tax_percentage' => Yii::t('app','Tax Percentage'),
        ];
    }
}
