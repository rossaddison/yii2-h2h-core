<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use frontend\models\Historyline;
use frontend\models\Historylinesearch;
use yii\helpers\Json;
use yii\filters\VerbFilter;

class HistorylineController extends \yii\web\Controller
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
                            'only' => ['index','create', 'update','delete','view','grid'],
                            'rules' => [
                            [
                              'allow' => true,
                              'roles' => ['admin','support'],
                            ],
                            ],
            ], 
        ];
    } 
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionCreate()
    {
        $model = new Historyline();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionGrid()
    {
        $searchModel = new Historylinesearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'start' => [
                    'asc' => ['start' => SORT_DESC],
                    'desc' => ['start' => SORT_ASC],
                    'default' => SORT_DESC,
                ],
            ],
            'defaultOrder' => [
              'start' => SORT_DESC,
            ]
          ]);
         
        if (Yii::$app->request->post('hasEditable')) {
        $editablekey = Yii::$app->request->post('editableKey');
        $model = Historyline::findOne($editablekey);
        $out = Json::encode(['output'=>'', 'message'=>'']);
        $post = [];
        $posted = current($_POST['Historyline']);
        $post = ['Historyline' => $posted];
        if ($model->load($post)) {
            $model->save();
        }
        $output = '';
        return Json::encode(['output'=> $output, 'message'=>'']);
       }

        return $this->render('grid', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    
    public function actionSalesorderheader($id)
    {
        return $this->redirect(['salesorderheader'],$id);
    }
    
    public function actionSalesorderdetail($id)
    {
        return $this->redirect(['salesorderdetail'],$id);
    }
     
    public function actionProductcategory($id)
    {
        return $this->redirect(['productcategory'],$id);
    }
    
    public function actionProductsubcategory($id)
    {
        return $this->redirect(['productsubcategory'],$id);
    }
    
    public function actionProduct($id)
    {
        return $this->redirect(['product'],$id);
    }
    
    public function actionCost($id)
    {
        return $this->redirect(['cost'],$id);
    }
    
    public function actionCostcategory($id)
    {
        return $this->redirect(['costcategory'],$id);
    }
    
    public function actionCostsubcategory($id)
    {
        return $this->redirect(['costsubcategory'],$id);
    }
    
    public function actionCarousal($id)
    {
        return $this->redirect(['carousal'],$id);
    }
    
    public function actionQuicknote($id)
    {
        return $this->redirect(['quicknote'],$id);
    }
    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Historyline::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'pagination' => false,
        ]);
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
    
    public function actionSlider()
   {
        Yii::$app->session['sliderfonthistoryline'] = Yii::$app->request->get('sliderfonthistoryline');    
   }
    
    protected function findModel($id)
    {
        if (($model = Historyline::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
    }

}
