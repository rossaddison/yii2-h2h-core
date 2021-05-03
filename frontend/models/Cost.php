<?php

namespace frontend\models;
use yii\db\Expression;


use Yii;

class Cost extends \yii\db\ActiveRecord
{
    public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }    
    
    public static function tableName()
    {
        return 'works_cost';
    }

    public function rules()
    {
        return [
            [['description', 'listprice','frequency','costsubcategory_id'], 'required'],
            [['listprice'], 'number'],
            [['costsubcategory_id'], 'integer'],
            [['frequency'],'string'],
            [['costcategory_id'], 'integer'],
            [['coststartdate', 'discontinueddate'], 'default','value'=>null],
            [['costenddate'], 'default','value'=>date('2099/12/31')],
            [['coststartdate', 'costenddate', 'discontinueddate'], 'safe'],
            [['costnumber'], 'default','value'=>1],
            [['costnumber'], 'integer', 'max' => 10000],
            [['costcodefirsthalf'], 'string', 'max' => 4],
            [['costcodesecondhalf'], 'string', 'max' =>3],
            [['description'], 'string', 'max' => 100],
            [['costsubcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Costsubcategory::className(), 'targetAttribute' => ['costsubcategory_id' => 'id']],
            [['costcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Costcategory::className(), 'targetAttribute' => ['costcategory_id' => 'id']],
        ];
    }
    
     

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'description' => Yii::t('app','Description'),
            'listprice' => Yii::t('app','Price'),
            'costnumber'=>Yii::t('app','Cost Number'),
            'costcategory_id' => Yii::t('app','Category Code (eg. SUB - Subcontractor)'),
            'costcodefirsthalf' =>Yii::t('app','Category Code Firsthalf eg. SUB (Max 4 characters)'),
            'costcodesecondhalf' =>Yii::t('app','Category Code Secondhalf eg. 001 (Max 3 characters)'),
            'costcategory_id.description'=>Yii::t('app','Description'),
            'costsubcategory_id' => Yii::t('app','Specialisation'),
            'coststartdate' => Yii::t('app','First cost date'),
            'costenddate' => Yii::t('app','Termination date (default: 2099/12/31) . Set to remove from cost list.'),
            'discontinueddate' => Yii::t('app','Modified Date (ignore)'),           
        ];
    }

    public function getCostcategory()
    {
        return $this->hasOne(Costcategory::className(), ['id' => 'costcategory_id']);
    }

    public function getCostsubcategory()
    {
        return $this->hasOne(Costsubcategory::className(), ['id' => 'costsubcategory_id']);
    }
    
    public function getCostdetails()
    {
        return $this->hasMany(Costdetail::className(), ['cost_id' => 'id']);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
             $this->modifieddate = new Expression('NOW()');    
            return true;
        }
        return false;
    }
}
