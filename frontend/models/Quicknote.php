<?php

namespace frontend\models;

use Yii;

class Quicknote extends \yii\db\ActiveRecord
{
    
     public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }      
    
    public static function tableName()
    {
        return 'works_quicknote';
    }
    
    public function rules()
    {
        return [
            [['note'], 'required'],
            [['created_at', 'modified_at'], 'safe'],
            [['note'], 'string', 'max' => 5000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'note' => Yii::t('app','Note'),
            'created_at' => Yii::t('app','Created At'),
            'modified_at' => Yii::t('app','Modified At'),
        ];
    }
}
