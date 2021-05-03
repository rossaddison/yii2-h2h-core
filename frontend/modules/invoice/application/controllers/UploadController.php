<?php
namespace frontend\modules\invoice\application\controllers;

use frontend\modules\invoice\application\models\ci\Mdl_uploads;
use frontend\modules\invoice\application\components\Utilities;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use Yii;

class UploadController extends MailerController
{
    public $targetPath;
    
    public $mdl_uploads;

    public function init()
    {
        parent::init();
        $this->mdl_uploads = new Mdl_uploads();
        $this->targetPath = Yii::getAlias('@webroot').Utilities::getCustomerfolderRelativeUrl();
    }
    
    public function actionUploadfile()
    {
        //https://plugins.krajee.com/file-input#ajax-uploads

        //error1: Unable to verify data submission => csrf metatags not present in layout. UploadController extends MailerController 
        //which relies on main layout which has the metatags on it
        
        //error2: Unexpected End of Json input => Function must return Json::encoded result.
            
        $uploadedFile = UploadedFile::getInstanceByName('file');
        
        $filepath = $this->targetPath . $uploadedFile; 
                //if (!empty($uploadedFile)) { 
                     $uploadedFile->saveAs($filepath); 
                //}
        //$t = Yii::$app->request->post('customerId');
        //$file = UploadedFile::getInstanceByName('jolly');
        //$file->saveAs($this->targetPath.$customerId.$url_key);
        
        
        
        return Json::encode([
                        'success' => true,
        ]);         
        //$uploadedFile = UploadedFile::getInstanceByName('input-name');
    }
    
    
    
    
    public function actionGetfile($filename)
    {
        $base_path = Utilities::getCustomerfolderRelativeUrl();
        $file_path = $base_path . $filename;

        if (strpos(realpath($base_path), realpath($file_path)) != 0) {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }

        $path_parts = pathinfo($file_path);
        $file_ext = $path_parts['extension'];

        if (file_exists($file_path)) {
            $file_size = filesize($file_path);

            $save_ctype = isset($this->content_types[$file_ext]);
            $ctype = $save_ctype ? $this->content_types[$file_ext] : $this->ctype_default;

            header("Expires: -1");
            header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: " . $ctype);
            header("Content-Length: " . $file_size);

            echo file_get_contents($file_path);
            exit;
        }
        throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
    }
}
