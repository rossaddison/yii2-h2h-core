<?php

namespace frontend\models;

use Yii;

class Importhouses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $importfile;

    
   public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }
    
    
    public static function tableName()
    {
        return 'works_importhouses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['importfile'], 'safe'],
            [['importfile_source_filename','importfile_web_filename'], 'string', 'max' => 255],
            [['importfile'], 'file','skipOnEmpty' => true, 'maxSize' => 2000000,'tooBig' => Yii::t('app','The import file cannot be larger than 2MB.'), 'extensions'=>'xls, xlsx, ods','wrongExtension' => 'The file must be a XLS, XLSX or ODS.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'importfile_source_filename' => Yii::t('app','Client-side Filename'),
            'importfile_web_filename' => Yii::t('app','Server-side Filename'),
            'importfile' =>Yii::t('app','Import File'),
        ];
    }
}
