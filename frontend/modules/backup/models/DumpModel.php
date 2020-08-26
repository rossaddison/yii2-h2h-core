<?php

namespace frontend\modules\backup\models;

class DumpModel extends \yii\base\Model
{  
    public $created_directory_successfully = false; 
    
    public $resultmessage = '';
    
    public $path ='';
    
    public $path_and_filename='';
    
    public $save_from_path='';
    
    public $save_from_path_and_filename ='';
    
    public static function getDatabasehandle()
    {
        return \frontend\components\Utilities::userdb_database_code();
    }
}
