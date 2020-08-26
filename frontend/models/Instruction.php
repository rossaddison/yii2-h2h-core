<?php

namespace frontend\models;

use Yii;

class Instruction extends \yii\db\ActiveRecord
{
   public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   } 
    
   public static function tableName()
   {
        return 'works_instruction';
   }

   public function rules()
    {
        return [
            [['code_meaning'], 'required'],
            [['id', 'include'], 'integer'],
            [['modified_date'], 'safe'],
            [['include'],'default','value'=>1],
            [['code'], 'string', 'max' => 10],
            [['code_meaning'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

   public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'code' => Yii::t('app','Code'),
            'code_meaning' => Yii::t('app','Code Meaning'),
            'include' => Yii::t('app','Include in Sales Order Detail Drop Down List'),
            'modified_date' => Yii::t('app','Modified Date'),
        ];
    }
}
