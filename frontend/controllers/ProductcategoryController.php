<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Productcategory;
use frontend\models\ProductcategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

Class ProductcategoryController extends Controller
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
                            'only' => ['view','create', 'update','delete'],
                            'rules' => [
                            [
                              'allow' => true,
                              'roles' => ['Admin','Manage Admin'],
                            ],
                            ],
            ], 
              
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ProductcategorySearch();
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
        $model = new Productcategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('create', [
                            'model' => $model
                ]);
            } else {
                return $this->render('create', [
                        'model' => $model,
                ]); 
            }
        }
    }

    public function actionUpdate($id)
    {   
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
       try{
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
       } catch(IntegrityException $e) {
              throw new \yii\web\HttpException(404, Yii::t('app','First delete subcategory ie. Streets linked to this category ie. Postcode then you will be able to delete this category ie. Postcode'));
       }
    }

    protected function findModel($id)
    {
        if (($model = Productcategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
}
