<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Costdetail;
use yii\helpers\Json;
use yii\db\IntegrityException;
use frontend\models\CostdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CostdetailController extends Controller
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
                            [
                              'allow' => true,
                              'verbs' => ['POST']
                            ],  
                            ],
            ], 
        ];
    }

    public function actionIndex($id)
    {
            Yii::$app->session['cost_header_id'] = $id;
            $searchModel = new CostdetailSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->sort->sortParam = false;
            $dataProvider->setSort([
            'attributes' => [
                 'costsubcategory_id.name' => [
                    'asc' => ['works_costsubcategory.name' => SORT_ASC],
                    'desc' => ['works_costsubcategory.name' => SORT_DESC],
                    'default' => SORT_ASC,
                ],  
                'cost_id.costnumber' => [
                    'asc' => ['works_cost.costnumber' => SORT_ASC],
                    'desc' => ['works_cost.costnumber' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
              'costsubcategory_id.name'=> SORT_ASC,  
              'cost_id.costnumber' => SORT_ASC,
            ]
          ]);
            
     if (Yii::$app->request->post('hasEditable')) {
        $costheaderId = Yii::$app->request->post('editableKey');
        $model = Costdetail::findOne($costheaderId);
        $out = Json::encode(['output'=>'', 'message'=>'']);
        $posted = [];
        $posted = current($_POST['Costdetail']);
        $post = ['Costdetail' => $posted];
        if ($model->load($post)) {
        $model->save();
        }
        //$output must be initialised otherwise you will get an 'internal server error'
        //if unit price and paid are not updated but paymenttype is updated.
        $output = '';
       
        if (isset($posted['unit_price'])) {
          $output = Yii::$app->formatter->asDecimal($model->unit_price, 2);
        }
        if (isset($posted['paid'])) {
          $output = Yii::$app->formatter->asDecimal($model->paid, 2);
        }
        return Json::encode(['output'=>$output, 'message'=>'']);
     }

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
        if (!\Yii::$app->user->can('Create Daily Job Sheet')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to create a daily cost sheet.'));
        }        
        $model = new Costdetail();
        $model->cost_header_id = Yii::$app->session['cost_header_id'];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->cost_header_id]);
        } else {
            return $this->render('create', [
                'model' => $model,'cost_header_id'=> Yii::$app->session['cost_header_id']
            ]);
        }
    }

    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('Update Daily Job Sheet')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update a daily cost sheet.'));
        }        
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cost_detail_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('Delete Daily Job Sheet')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete a daily cost sheet.'));
        }         
        try {
            $model = $this->findModel($id);
	    $this->findModel($id)->delete();            
            return $this->redirect(['index','id'=>$model->cost_header_id]);
	} catch(IntegrityException $e) {              
              throw new \yii\web\HttpException(404, Yii::t('app','Integrity Constraint exception.'));
        }
    }
    
    public function actionPaidticked()
    {
      $keylist = Yii::$app->request->get('keylist');
      if (!empty($keylist)){
      foreach ($keylist as $key => $value)
      {
                    $model = $this->findModel($value);
                    if ($model !== null) {
                        $model->paid = $model->unit_price;
                        $model->save();
                    }
      }
      }
      else {throw new NotFoundHttpException(Yii::t('app','No ticks selected.'));}
      
    }
    
    public function actionUnpaidticked()
   {
      $keylist = Yii::$app->request->get('keylist');
      if (!empty($keylist)){
      foreach ($keylist as $key => $value)
      {
                    $model = $this->findModel($value);
                    if ($model !== null) {
                        $model->paid = 0;
                        $model->save();
                    }
      }
      }
      else {throw new NotFoundHttpException(Yii::t('app','No ticks selected.'));}
      
    }
        
    public function actionPay($id)
    {
        $model = $this->findModel($id);
        if ($model !== null) {
           $model->paid = $model->unit_price;
           $model->save();
        }
        return $this->redirect(['view', 'id' => $model->cost_detail_id]);
    }
    
    public function actionUnpay($id)
    {
        $model = $this->findModel($id);
        if ($model !== null) {
           $model->paid = 0;
           $model->save();
        }
        return $this->redirect(['view', 'id' => $model->cost_detail_id]);
    }
       
    public function actionDeleteticked()
   {
      if (!\Yii::$app->user->can('Delete Daily Job Sheet')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete a daily cost sheet.'));
      } 
      $keylist = Yii::$app->request->get('keylist');
      if (!empty($keylist)){
      foreach ($keylist as $key => $value)
      {
                    $model = $this->findModel($value);
                    if ($model !== null) {$model->delete();}
      } 
      }
      else {throw new NotFoundHttpException(Yii::t('app','No ticks selected.'));}
    }
    
     public function actionPaymentmethodcashticked()
    {
      $keylist = Yii::$app->request->get('keylist');
      if (!empty($keylist)){
      foreach ($keylist as $key => $value)
      {
                    $model = $this->findModel($value);
                    if ($model !== null) {
                        $model->paymenttype = "Cash";
                        $model->save();
                    }
      }
      }
      else {throw new NotFoundHttpException(Yii::t('app','No ticks selected.'));}
    }
    
   public function actionSlider()
   {
        Yii::$app->session['sliderfontcostdetail'] = Yii::$app->request->get('sliderfontcostdetail');    
   }
    
    protected function findModel($id)
    {
        if (($model = Costdetail::findOne($id)) !== null) {
            return $model;
        } else {throw new NotFoundHttpException(Yii::t('app','CostdetailController: The requested model does not exist.'));}
    }
    
    
    
}
