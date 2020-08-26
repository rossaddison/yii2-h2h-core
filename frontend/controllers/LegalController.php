<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Legal;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class LegalController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
             'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create','update','delete'],
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['index', 'view','create','update','delete'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','view','create','update','delete'],
                        'roles' => ['@'],
                    ],
                    
                  
                ],
            ],
             'timestamp' => 
                            [
                            'class' => TimestampBehavior::className(),
                            'attributes' => [
                                                ActiveRecord::EVENT_BEFORE_INSERT => [
                                                'last_updated'],
                                                ActiveRecord::EVENT_BEFORE_UPDATE => ['last_updated'],
                                            ],
                            ],
        ];
    }

   
    public function actionIndex()
    {
         if (!\Yii::$app->user->can('Create Legal')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission.'));
        }        
        
        $dataProvider = new ActiveDataProvider([
            'query' => Legal::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

   
    public function actionView($id)
    {
         if (!\Yii::$app->user->can('Create Legal')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission.'));
        }    
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionCreate()
    {
         if (!\Yii::$app->user->can('Create Legal')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission.'));
        }           
        
        $model = new Legal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    
    public function actionUpdate($id)
    {
         if (!\Yii::$app->user->can('Create Legal')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission.'));
        }            
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    
    public function actionDelete($id)
    {
         if (!\Yii::$app->user->can('Create Legal')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission.'));
        }    
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Legal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
    }
}
