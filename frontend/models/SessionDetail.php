<?php
namespace frontend\models;

use Yii;

class SessionDetail extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'session_detail';
    }

    public function rules()
    {
        return [
            [['session_id', 'redirect_flow_id', 'db', 'product_id'], 'required'],
            [['product_id','user_id'], 'integer'],
            [['session_id'], 'string', 'max' => 40],
            [['redirect_flow_id', 'db'], 'string', 'max' => 50],
            [['customer_approved'],'default','value'=>0],
            [['administrator_acknowledged'],'default','value'=>0],
          ];  
    }

    public function attributeLabels()
    {
        return [
            'session_detail_id' => Yii::t('app','Session Detail ID'),
            'session_id' => Yii::t('app','Session ID'),
            'redirect_flow_id' => Yii::t('app','Redirect Flow ID'),
            'db' => Yii::t('app','Db'),
            'user_id'=>Yii::t('app','User ID'),
            'product_id' => Yii::t('app','Product ID'),
            'customer_approved'=>Yii::t('app','Mandate Confirmed by Customer'),
            'administrator_acknowledged'=> Yii::t('app','Acknowledged by Administrator'),
        ];
    }
}
