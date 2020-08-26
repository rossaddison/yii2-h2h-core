<?php

namespace frontend\models;

use Yii;

class Messaging extends \yii\db\ActiveRecord
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
        return 'works_messaging';
    }

    public function rules()
    {
        return [
            [['message'], 'required'],
            [['message'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'message' => Yii::t('app','Message'),
        ];
    }
}
