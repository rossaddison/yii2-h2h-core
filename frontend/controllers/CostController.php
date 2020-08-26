<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Costsubcategory;
use frontend\models\Cost;
use frontend\models\Costdetail;
use frontend\models\Costsearch;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\behaviors\TimestampBehavior;

class CostController extends Controller
{
    
    public function behaviors()
    {
        return [
                'verbs' => 
                            [
                            'class' => VerbFilter::className(),
                            'actions' =>    [
                                                'delete' => ['POST'],
                                            ],
                            ],
                'timestamp' => 
                            [
                            'class' => TimestampBehavior::className(),
                            'attributes' => [
                                                ActiveRecord::EVENT_BEFORE_INSERT => ['nextcost_date',
                                                'modified_date'],
                                                ActiveRecord::EVENT_BEFORE_UPDATE => ['modified_date'],
                                            ],
                            ],
                'access' => 
                            [
                            'class' => \yii\filters\AccessControl::className(),
                            'only' => ['create', 'update','view','delete','doit','subcatcost'],
                            'rules' => [
                            [
                              'allow' => true,
                              'verbs' => ['POST']
                            ],
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
        $searchModel = new Costsearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'costnumber' => [
                    'asc' => ['works_cost.costnumber' => SORT_ASC],
                    'desc' => ['works_cost.costnumber' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
              'costnumber' => SORT_ASC,
            ]
          ]); 
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('Create House')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to create a cost.'));
        }
        $model = new Cost();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionView($id) {
        $model=$this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', Yii::t('app','Saved record successfully'));
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('view', ['model'=>$model]);
        }
    }
    
    public function actionDelete() {
        if (!\Yii::$app->user->can('Delete House')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete a cost.'));
        }        
        try {
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['costdelete'])) {
            $id = $post['id'];
            if ($this->findModel($id)->delete()) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                Yii::$app->response->content = Json::encode([
                    'success' => true,
                    'messages' => [
                        'kv-detail-info' => Yii::t('app','The cost # ') . $id . Yii::t('app',' was successfully deleted. <a href="') . 
                            Url::to(['/cost/index']) . '" class="btn btn-sm btn-info">' .
                            '<i class="glyphicon glyphicon-hand-right"></i>  '.Yii::t('app','Click here'). '</a> '. Yii::t('app','to proceed.')
                    ]
                ]);
            } 
          }
       }
       catch (\Exception $e)
       {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                Yii::$app->response->content = Json::encode([
                    'success' => false,
                    'messages' => [
                        'kv-detail-error' => Yii::t('app','Cannot delete the cost # ') . $id . Yii::t('app',' It exists on Daily Cost')
                      . 'schedule(s) already. Delete this cost on these Daily Cost Schedules first please.'
                    ]
                ]);
       }
   } 
       
     public function actionDoit()
   {
      //corder is the dropdownbox specific date's (w59:cost/index) cost header id
      $cost_header_id = Yii::$app->request->get('ccost');
      $keylist = Yii::$app->request->get('keylist');
      //work through the costs that have been selected to be copied
      foreach ($keylist as $key => $value)
      {
                    $model = Cost::findOne($value);
                    //prevent cost duplicates
                    $q = new Query();
                    if  ($q->select('*')->from('works_costdetail')->where(['cost_header_id' => $cost_header_id])->andWhere(['cost_id'=>$value])->exists()) 
                          {
                            Yii::$app->session->setFlash('kv-detail-success',$cost_header_id ); 
                            exit();
                          }
                          else {
                    $model2 = new Costdetail();
                    //the sales order id for the specific daily clean that we are copying to
                    $model2->cost_header_id = $cost_header_id;
                    $model2->paymenttype = "Cash";
                    if ($model->frequency == "Daily")
                    {
                            $date = strtotime("+1 day");
                            $addeddate = date("Y-m-d" , $date);
                            $model2->nextcost_date = $addeddate;
                    };
                    if ($model->frequency == "Weekly")
                    {
                            $date = strtotime("+7 day");
                            $addeddate = date("Y-m-d" , $date);
                            $model2->nextcost_date = $addeddate;
                    };
                    if ($model->frequency == "Monthly")
                        {
                           $date = strtotime("+30 day");
                           $addeddate = date("Y-m-d" , $date);
                           $model2->nextcost_date = $addeddate;
                        };
                    if ($model->frequency == "Fortnightly")
                        {
                           $date = strtotime("+15 day");
                           $addeddate = date("Y-m-d" , $date);
                           $model2->nextcost_date = $addeddate;
                        };
                    if ($model->frequency == "Every two months")
                        {
                           $date = strtotime("+60 day");
                           $addeddate = date("Y-m-d" , $date);
                           $model2->nextcost_date = $addeddate;
                        }; 
                    if ($model->frequency == "Other")
                        {
                           $model2->nextcost_date = date("Y-m-d"); 
                        };
                    $model2->costcategory_id = $model->costcategory_id;
                    $model2->costsubcategory_id = $model->costsubcategory_id;
                    $model2->cost_id = $value;
                    $model2->carousal_id = null;
                    $model2->order_qty=1;
                    $model2->unit_price = $model->listprice;
                    $model2->line_total = $model2->unit_price;
                    $model2->paid = 0;
                    $model2->save();
                    }
      }
      return;  
    }
    
    public function actionSubcatcost() 
    {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $cat_id = $parents[0];
            $out = self::getSubCatcostList($cat_id); 
            return Json::encode(['output'=>$out, 'selected'=>'']);
        }
    }
    return Json::encode(['output'=>$out, 'selected'=>'']);
    }

    public static function getSubCatcostList($costcode_id) {
       //find all the costs in the subcost 
        $data=Costsubcategory::find()
       ->where(['costcategory_id'=>$costcode_id])
       ->select(['id','name AS name'])->asArray()->orderBy('name')->all();
       return $data;
    } 
    
    public function actionCos() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $ids = $_POST['depdrop_parents'];
        $cat_id = empty($ids[0]) ? null : $ids[0];
        $subcat_id = empty($ids[1]) ? null : $ids[1];
        if ($cat_id != null) {
            $out = self::getCostListb($cat_id,$subcat_id); 
            return Json::encode(['output'=>$out, 'selected'=>'']);
        }
    }
    return Json::encode(['output'=>'', 'selected'=>'']);
    }
    
     public static function getCostListb($cat_id, $subcat_id) {
        $data = [];
        $data=Cost::find()
       ->where(['costcategory_id'=>$cat_id])
       ->andWhere(['costsubcategory_id'=>$subcat_id])      
       ->select(['id', 'costnumber AS name'])->asArray()->all();
        return $data;
    }
    
   public function actionSlider()
   {
        Yii::$app->session['sliderfontcost'] = Yii::$app->request->get('sliderfontcost');    
   }
    
   protected function findModel($id)
   {
        if (($model = Cost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
   }
}

