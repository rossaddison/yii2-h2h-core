<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Messagelog;
use frontend\models\MessagelogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MessagelogController extends Controller
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
                            'only' => ['index','create', 'update','view','delete'],
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
            $searchModel = new MessagelogSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->sort->sortParam = false;
            $dataProvider->setSort([
            'attributes' => [
                    'product_id.name' => [
                    'asc' => ['works_product.name' => SORT_ASC],
                    'desc' => ['works_product.name' => SORT_DESC],
                    'default' => SORT_ASC,
                 ],         
                    'salesorderdetail_id.sid' => [
                    'asc' => ['works_salesorderdetail.sales_order_detail_id' => SORT_ASC],
                    'desc' => ['works_salesorderdetail.sales_order_detail_id' => SORT_DESC],
                    'default' => SORT_ASC,
                 ],  
                
            ],
            'defaultOrder' => [
              'salesorderdetail_id.sid'=> SORT_DESC,  
              'product_id.name' => SORT_ASC,
            ]
          ]);

        return $this->render('index', [
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
        if (!\Yii::$app->user->can('Create Messagelog')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to create a messagelog.'));
        }        
        
        $model = new Messagelog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('Update Messagelog')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update a messagelog.'));
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
        if (!\Yii::$app->user->can('Delete Messagelog')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete a messagelog.'));
        }        
        try{
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
        } catch(IntegrityException $e) {
              throw new \yii\web\HttpException(404, Yii::t('app','First delete the daily clean items this message was sent to then you will be able to delete this message.'));
        }
    }

    protected function findModel($id)
    {
        if (($model = Messagelog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
    }
}
