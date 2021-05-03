<?php

namespace frontend\models;

use frontend\models\Productcategory;
use frontend\models\Productsubcategory;

use Yii;

class Product extends \yii\db\ActiveRecord
{
   public $importfile;
   
   public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }      
    
   public static function tableName()
   {
        return 'works_product';
   }
    
    public function rules()
    {
        return [
            [['listprice','frequency','productsubcategory_id'], 'required'],
            [['listprice'], 'number'],
            [['productsubcategory_id','productcategory_id'], 'integer'],
            [['frequency'],'string'],
            [['frequency'],'default','value'=>'Monthly'],
            [['sellstartdate', 'discontinueddate'], 'default','value'=>null],
            [['sellenddate'], 'default','value'=>date('2099/12/31')],
            [['sellstartdate', 'sellenddate', 'discontinueddate'], 'safe'],
            [['postcodefirsthalf'], 'string', 'max' => 4],
            [['postcodesecondhalf'], 'string', 'max' =>3],
            [['productnumber'],'string','max'=>25],
            [['name'],'default','value'=>'Firstname'],
            [['surname'],'default','value'=>'Surname'],
            [['name'], 'string', 'max' => 60],
            [['surname'], 'string', 'max' => 60],
            [['contactmobile'], 'default', 'value'=>'09999999999'],
            [['contactmobile'], 'string', 'max' => 11],
            [['email'],'email'],
            [['email'],'default','value'=>'email@email.com'],
            [['specialrequest'], 'string', 'max' => 100],
            [['productsubcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productsubcategory::className(), 'targetAttribute' => ['productsubcategory_id' => 'id']],
            [['productcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productcategory::className(), 'targetAttribute' => ['productcategory_id' => 'id']],
            [['isactive'],'default','value'=>1],
            [['jobcode','mandate','gc_number','image_source_filename','image_web_filename'],'default','value'=>null],            
            [['isactive'],'boolean'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'name' => Yii::t('app','Firstname (Not required)'),
            'surname' => Yii::t('app','Surname (Not required)'),
            'contactmobile' => Yii::t('app','Contact Mobile'),
            'specialrequest' => Yii::t('app','Special Request'),
            'listprice' => Yii::t('app','Price (required)'),
            'frequency'=> Yii::t('app','Frequency (required)'),
            'productnumber'=>Yii::t('app','House Number'),
            'productcategory_id' => Yii::t('app','Postcode Area (eg. G32 - Carntyne)'),
            'postcodefirsthalf' =>Yii::t('app','Postcode Firsthalf eg. G32 (Max 4 characters)'),
            'postcodesecondhalf' =>Yii::t('app','Postcode Secondhalf eg. 6LF (Max 3 characters)'),
            'productcategory_id.description'=>Yii::t('app','Description'),
            'productsubcategory_id' => Yii::t('app','Street (required)'),
            'sellstartdate' => Yii::t('app','First captured date'),
            'sellenddate' => Yii::t('app','Termination date (default: 2099/12/31) . Set to remove from round.'),
            'discontinueddate' => Yii::t('app','Modified Date (ignore)'),
            'isactive'=>Yii::t('app','Active'),
            'jobcode' => Yii::t('app','Latest daily clean job code to link house to.'),
            'mandate'=> Yii::t('app','Gocardless customer mandate link sent to customer in email (not approved yet) / Mandate Number eg. MD1234AA123BB (approved) '),
            'gc_number'=> Yii::t('app','Gocardless customer number in Gocardless Website indicating that direct debit mandate has been approved.'),
          ];
    }

    public function getProductcategory()
    {
        return $this->hasOne(Productcategory::className(), ['id' => 'productcategory_id']);
    }

    public function getProductsubcategory()
    {
        return $this->hasOne(Productsubcategory::className(), ['id' => 'productsubcategory_id']);
    }
    
    public function getSalesorderdetails()
    {
        return $this->hasMany(Salesorderdetail::className(), ['product_id' => 'id']);
    }
}
