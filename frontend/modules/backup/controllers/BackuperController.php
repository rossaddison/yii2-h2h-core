<?php

namespace frontend\modules\backup\controllers;

use frontend\modules\backup\models\DumpModel;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Ifsnop\Mysqldump as IMysqldump;

class BackuperController extends Controller
{
     public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'delete' => ['POST'],
                ],
            ],
           'access' => 
                            [
                            'class' => \yii\filters\AccessControl::className(),
                            'only' => ['index','dump'],
                            'rules' => [
                            [
                              'allow' => true,
                              'roles' => ['admin','support'],
                            ],
                            [
                              'allow' => false,
                              'roles' => ['?'],
                            ],  
                            [
                              'allow' => true,
                              'verbs' => ['POST']
                            ],  
                            ],
            ], 
        ];
    }
    // set simple layout
    // public $layout = 'backuper';
    private $db = null;
    /**
     * @inheritdoc
     */

    public function actionIndex()
    {
        $minPhpVersion = version_compare(PHP_VERSION, '5.5.0') >= 0;
        $docRoot = strpos(Yii::$app->request->url, '/backuper') === 0;

        return $this->render(
            'index',
            [
                'minPhpVersion' => $minPhpVersion,
                'docRoot' => $docRoot,
            ]
        );
    }
    
    public function actionDump()
    {
           $model = new DumpModel(); 
           try {
                $database_handle = $model->getDatabasehandle();
                $database = Yii::$app->$database_handle->createCommand("SELECT DATABASE()")->queryScalar();
                $dumpit = new IMysqldump\Mysqldump('mysql:host=localhost;dbname='.$database.'', Yii::$app->$database_handle->username, Yii::$app->$database_handle->password);
                $basepath = \Yii::getAlias('@webroot');
                $timestamp = time();
                $model->save_from_path = "/mysqlbackup/".$timestamp."_".Yii::$app->security->generateRandomString()."_".$database_handle;
                $model->path = $basepath .  $model->save_from_path;
                //$path = $basepath . "/mysqlbackup/".$database_handle;
                mkdir($model->path,0777); 
                if (is_dir($model->path)){$model->created_directory_successfully = true;}
                else {$model->created_directory_successfully = false;}
	        $model->path_and_filename = $basepath . $model->save_from_path."/".$timestamp.".sql";
                $model->save_from_path_and_filename = $model->save_from_path . "/".$timestamp.".sql";
                $dumpit->start($model->path_and_filename);
            } catch (\Exception $e) {
                $model->resultmessage = 'mysqldump-php error: ' . $e->getMessage();
            }
            return $this->render('dump',
                     [
                       'dumpit'=>$dumpit,
                       'model' => $model,
                       'path' => $model->path,
                       'path_and_filename' => $model->path_and_filename,
                       'resultmessage'=> $model->resultmessage,  
                       'created_directory_successfully'=>$model->created_directory_successfully,
                       'save_from_path'=>$model->save_from_path,
                     ]
             );
            
     }
}
