<?php

namespace frontend\models;
use frontend\models\Product;
use frontend\models\Productcategory;
use Yii;


class Productsubcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        return \frontend\components\Utilities::userdb();
    }
    
    public function behaviors() {
	    return [
	        [
	            'class' => 'sjaakp\sortable\Sortable',
                    'orderAttribute'=>'sort_order',
	        ],
	    ];
    }
 
    public static function tableName()
    {
        return 'works_productsubcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productcategory_id', 'name'], 'required'],
            [['productcategory_id','sort_order'], 'integer'],
            [['lat_start','lng_start','lat_finish','lng_finish'],'integer','integerOnly'=>false],
            [['lat_start','lng_start','lat_finish','lng_finish'],'default','value'=>0.00],
            [['name'], 'string', 'max' => 250],
            [['sort_order'],'integer','min'=>0,'max'=>500],
            [['sort_order'],'default','value'=>99],
            [['productcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productcategory::className(), 'targetAttribute' =>['productcategory_id' => 'id']],
            [['directions_to_next_productsubcategory'], 'string', 'max' => 5000],
            [['isactive'],'default','value'=>1]
        ];
    }

    /**
     * @inheritdoc
     */
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'productcategory_id' => Yii::t('app','Area'),
            'name' => Yii::t('app','Name'),
            'sort_order'=>Yii::t('app','Sequence (Set to 500 if using with Quick Build)'),
            'lat_start' => Yii::t('app','Latitude Start eg. 55.8888888'),
            'lng_start' => Yii::t('app','Longitude Start eg. -4.1111111'),
            'lat_finish' => Yii::t('app','Latitude Finish eg. 55.9999999'),
            'lng_finish' => Yii::t('app','Longitude Finish eg. -4.2222222'),
            'directions_to_next_productsubcategory' => Yii::t('app','Directions to next street'),
            'isactive'=>Yii::t('app','Is this active? (Default: Ticked)'),
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['productsubcategory_id' => 'id']);
    }

    public function getProductcategory()
    {
        return $this->hasOne(Productcategory::className(), ['id' => 'productcategory_id']);
    }
    
   
    
    
    
}
