<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Quicknote;
use frontend\models\QuicknoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\filters\VerbFilter;

class QuicknoteController extends Controller
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
            'timestamp' => 
                            [
                            'class' => TimestampBehavior::className(),
                            'attributes' => [
                                                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at',
                                                'modified_at'],
                                                ActiveRecord::EVENT_BEFORE_UPDATE => ['modified_at'],
                                            ],
                            ],
        ];
    }

    
    public function actionIndex()
    {
        $searchModel = new QuicknoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'modified_at' => [
                    'asc' => ['modified_at' => SORT_ASC],
                    'desc' => ['modified_at' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
            ],
            'defaultOrder' => [
              'modified_at' => SORT_DESC,
            ]
          ]); 
        
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
        $model = new Quicknote();
        if ($model->load(Yii::$app->request->post())) {
            $date = strtotime("+0 day");
            $addeddate = date('Y-m-d H:i:s', $date);
            $model->created_at = $addeddate;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $date = strtotime("+0 day");
            $addeddate = date('Y-m-d H:i:s', $date);
            $model->modified_at = $addeddate;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    protected function findModel($id)
    {
        if (($model = Quicknote::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
    }
}
