<?php
namespace frontend\models;

use Yii;

class Session extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'session';
    }

    public function rules()
    {
        return [
            [['id', 'data'], 'required'],
            [['expire', 'user_id'], 'integer'],
            [['data'], 'string'],
            [['id'], 'string', 'max' => 40],
            [['id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'expire' => Yii::t('app','Expire'),
            'data' => Yii::t('app','Data'),
            'user_id' => Yii::t('app','User ID'),
            'db' => Yii::t('app','Db'),
            'gc_rid' => Yii::t('app','Gc Rid'),
        ];
    }
}
