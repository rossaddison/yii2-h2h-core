<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "legal".
 *
 * @property string $privacy_policy
 * @property string $terms_conditions
 * @property string $last_updated
 */
class Legal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function userDb()
    {
        return Yii::$app->db;
    }
            
    public static function tableName()
    {
        return 'legal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['privacy_policy', 'terms_conditions'], 'required'],
            [['last_updated'], 'safe'],
            [['privacy_policy', 'terms_conditions'], 'string', 'max' => 30000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'=>Yii::t('app','ID'),
            'privacy_policy' => Yii::t('app','Privacy Policy'),
            'terms_conditions' => Yii::t('app','Terms and Conditions'),
            'last_updated' => Yii::t('app','Last Updated'),
        ];
    }
}
