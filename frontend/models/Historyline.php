<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "works_event".
 *
 * @property int $id
 * @property string|null $start
 * @property string|null $stop
 * @property string|null $post_start
 * @property string|null $pre_stop
 * @property string|null $class
 * @property string|null $text
 */
class Historyline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
  public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }   
    
    
    
    public static function tableName()
    {
        return 'works_historyline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start', 'stop', 'post_start', 'pre_stop'], 'safe'],
            [['class', 'text'], 'string', 'max' => 100],
            [['controller_name','controller_action','controller_action_id'],'string','max'=>25],            
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start' => Yii::t('app', 'Start'),
            'stop' => Yii::t('app', 'Stop - When the period stops. Leave blank if only one day duration.'),
            'post_start' => Yii::t('app', 'Post Start eg. https://github.com/sjaakp/yii2-dateline'),
            'pre_stop' => Yii::t('app', 'Pre Stop'),
            'class' => Yii::t('app', 'Class eg. col-blue https://github.com/sjaakp/dateline'),
            'text' => Yii::t('app', 'Text'),
            'controller_name' => Yii::t('app', '1. Controller eg. salesorderheader or salesorderdetail or product or productcategory'),
            'controller_action'=> Yii::t('app','2. Action eg. index or view '),
            'controller_action_id'=> Yii::t('app','3. id eg. 1')
        ];
    }
}
