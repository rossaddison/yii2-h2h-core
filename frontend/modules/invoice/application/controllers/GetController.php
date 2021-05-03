<?php
namespace frontend\modules\invoice\application\controllers;

use yii\base\Controller;

class GetController extends Controller
{
    public function actionAttachment($filename)
    {
        $path = \Yii::getAlias('@webroot').'/frontend/modules/invoice/uploads/';
        $filePath = $path . $filename;

        if (strpos(realpath($filePath), $path) !== 0) {
            header("Status: 403 Forbidden");
            echo '<h1>Forbidden</h1>';
            exit;
        }

        $filePath = realpath($filePath);

        if (file_exists($filePath)) {
            $pathParts = pathinfo($filePath);
            $fileExt = $pathParts['extension'];
            $fileSize = filesize($filePath);

            header("Expires: -1");
            header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: application/octet-stream");
            header("Content-Length: " . $fileSize);

            echo file_get_contents($filePath);
            exit;
        }
        throw new \yii\web\HttpException(404,'The page you requested was not found.');        
    }
}
