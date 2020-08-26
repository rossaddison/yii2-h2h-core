<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use frontend\models\Productsubcategory;
use frontend\models\ProductsubcategorySearch;
use yii\web\Controller;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductsubcategoryController implements the CRUD actions for Productsubcategory model.
 */
class ProductsubcategoryController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
            'access' => 
                            [
                            'class' => \yii\filters\AccessControl::className(),
                            'only' => ['index','create','view', 'update','delete','dragdrop'],
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
            $searchModel = new ProductsubcategorySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->sort->sortParam = false;
            $dataProvider->setSort([
            'attributes' => [
                'sort_order' => [
                    'asc' => ['sort_order' => SORT_ASC],
                    'desc' => ['sort_order' => SORT_DESC],
                    'default' => SORT_ASC,
                ], 
                'productcategory_id' => [
                    'asc' => ['productcategory_id' => SORT_ASC],
                    'desc' => ['productcategory_id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
              'sort_order'=> SORT_ASC,
            ]
          ]);
            
     if (Yii::$app->request->post('hasEditable')) {
        $sequence = Yii::$app->request->post('editableKey');
        $model = Productsubcategory::findOne($sequence);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry 
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Model without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['Productsubcategory']);
        $post = ['Productsubcategory' => $posted];

        // load model like any single model validation
        if ($model->load($post)) {
        // can save model or do something before saving model
        $model->save();
        }
        // custom output to return to be displayed as the editable grid cell
        // data. Normally this is empty - whereby whatever value is edited by
        // in the input by user is updated automatically.
       
        if (isset($posted['sort_order'])) {
          $output = Yii::$app->formatter->asDecimal($model->sort_order, 0);
        }
        
        return Json::encode(['output'=> $output, 'message'=>'']);
     }
        
        /////////////////////////////////////
        $searchModel = new ProductsubcategorySearch();
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
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to create a street.'));
        }
        
        $model = new Productsubcategory();

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
        if (!\Yii::$app->user->can('Update Street')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update a street.'));
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
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete a street.'));
        }
        try{
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
        } catch(IntegrityException $e) {
              throw new \yii\web\HttpException(404, Yii::t('app','First delete the houses associated with this subcategory ie. street then you will be able to delete this street.'));
        }
    }

    protected function findModel($id)
    {
        if (($model = Productsubcategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
    
    public function actionDragdrop()
    {
        $query = Productsubcategory::find()->orderBy('sort_order');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'db' => \frontend\components\Utilities::userdb(),
            'sort'=>false,
            'pagination'=>false,
        ]);
        return $this->render('sort', ['dataProvider' => $dataProvider]);
    }
    
    public function actionOrder( )   {
        $post = Yii::$app->request->post( );
        if (isset( $post['key'], $post['pos'] ))   {
            $this->findModel( $post['key'] )->order( $post['pos'] );
        }
    }
}
