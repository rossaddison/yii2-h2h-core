<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Costsubcategory;
use frontend\models\CostsubcategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CostsubcategoryController extends Controller
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
            'access' => 
                            [
                            'class' => \yii\filters\AccessControl::className(),
                            'only' => ['index','create', 'update','delete','view'],
                            'rules' => [
                            [
                              'allow' => true,
                              'roles' => ['@'],
                            ],
                            ],
            ], 
            
        ];
    }
    
    public function actionIndex()
    {
        $searchModel = new CostsubcategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('Create Street')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to create a Cost subcategory.'));
        }
        
        $model = new Costsubcategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('Update Street')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update a costsubcategory.'));
        }
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('Delete Street')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete a costsubcategory.'));
        }
        
        try{
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
        } catch(IntegrityException $e) {
              throw new \yii\web\HttpException(404, Yii::t('app','First delete the costs associated with this subcategory then you will be able to delete this subcategory.'));
        }
    }
    
    protected function findModel($id)
    {
        if (($model = Costsubcategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
}
