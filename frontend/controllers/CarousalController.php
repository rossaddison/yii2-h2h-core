<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Carousal;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CarousalController implements the CRUD actions for Carousal model.
 */
class CarousalController extends Controller
{
    /**
     * @inheritdoc
     */
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
                            'only' => ['index','create', 'update','delete','view'],
                            'rules' => [
                            [
                              'allow' => true,
                              'roles' => ['@'],
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

    /**
     * Lists all Carousal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Carousal::find(),
        ]);
        //Yii::$app->params['uploadPath'] = Yii::getAlias('@app\images');
        //Yii::$app->params['uploadUrl'] = Yii::base();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carousal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Carousal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
        {
          $model = new Carousal();
          if ($model->load(Yii::$app->request->post())) {
              $uploadedFile = UploadedFile::getInstance($model, 'image');
              if (!is_null($uploadedFile)) {
                    $model->image_source_filename = $uploadedFile->name;
                    $model->image_web_filename = Yii::$app->security->generateRandomString().".".$uploadedFile->extension;
                    if ($model->validate()) { 
                        $basepath = \Yii::getAlias('@webroot');
                        if (Yii::$app->user->identity->attributes['name']  === 'demo') {
                           $path = $basepath . "/images/demo/".Yii::$app->session['demo_image_timestamp_directory']."/". $model->image_web_filename;
                        }
                        else
                        {
                           $path = $basepath . "/images/" . $model->image_web_filename;
                        }
                        $uploadedFile->saveAs($path); 
                    }                   
                  }
                if ($model->save())
                    {
                      return $this->redirect(['view', 'id' => $model->id]);
                    }
                    
      }
      return $this->render('create', ['model' => $model,
        ]);
      }
    
   public function actionUpdate($id)
        {
          $model = $this->findModel($id);
          if ($model->load(Yii::$app->request->post())) {
              $uploadedFile = UploadedFile::getInstance($model, 'image');
              if (!is_null($uploadedFile)) {
                    $model->image_source_filename = $uploadedFile->name;
                    $model->image_web_filename = Yii::$app->security->generateRandomString().".".$uploadedFile->extension;
                    if ($model->validate()) {                
                    Yii::$app->params['uploadPath'] = Yii::$app->basePath;
                        $basepath = \Yii::getAlias('@webroot');
                        if (Yii::$app->user->identity->attributes['name']  === 'demo') {
                           $path = $basepath . "/images/demo/".Yii::$app->session['demo_image_timestamp_directory']."/". $model->image_web_filename;
                        }
                        else {
                           $path = $basepath . "/images/" . $model->image_web_filename;   
                        }
                        $uploadedFile->saveAs($path); 
                    }                   
                  }
                if ($model->save())
                    {
                      return $this->redirect(['view', 'id' => $model->id]);
                    }
                    
      }
      return $this->render('update', ['model' => $model,
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = Carousal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
    
    public function actionDelete($id)
    {
        try{
        if (!\Yii::$app->user->can('Delete Carousal')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete a carousal.'));
        }    
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
        } catch(\yii\db\IntegrityException $e) {
              throw new \yii\web\HttpException(404, Yii::t('app','This image or file is linked. You will have to remove this link first.'));
        }
        
        
        
        
    }
}
