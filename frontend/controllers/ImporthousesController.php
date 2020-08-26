<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Importhouses;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use \PhpOffice\PhpSpreadsheet\IOFactory;

class ImporthousesController extends Controller
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
                            'only' => ['index','create', 'update','delete','view','process','download'],
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

   
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Importhouses::find(),
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
           if (!\Yii::$app->user->can('Import Houses')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to import houses.'));
           }
        
          $model = new Importhouses();
          if ($model->load(Yii::$app->request->post())) {
              $uploadedFile = UploadedFile::getInstance($model, 'importfile');
              if (!is_null($uploadedFile)) {
                    $model->importfile_source_filename = $uploadedFile->name;
                    $model->importfile_web_filename = Yii::$app->security->generateRandomString().".".$uploadedFile->extension;
                    if ($model->validate()) {                
                        Yii::$app->params['uploadPath'] = dirname(Yii::$app->basePath) .'\importfile';
                        ///Yii::$app->params['uploadPath'] = Yii::$app->basePath .'\web\images';
                        $path = Yii::$app->params['uploadPath'] .'/'. $model->importfile_web_filename;   
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
          if (!\Yii::$app->user->can('Import Houses')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update the file.'));
          }
                 
          $model = $this->findModel($id);
          if ($model->load(Yii::$app->request->post())) {
              $uploadedFile = UploadedFile::getInstance($model, 'importfile');
              if (!is_null($uploadedFile)) {
                    $model->importfile_source_filename = $uploadedFile->name;
                    $model->importfile_web_filename = Yii::$app->security->generateRandomString().".".$uploadedFile->extension;
                    if ($model->validate()) {                
                        Yii::$app->params['uploadPath'] = dirname(Yii::$app->basePath) .'\importfile';
                        ///Yii::$app->params['uploadPath'] = Yii::$app->basePath .'\web\images';
                        $path = Yii::$app->params['uploadPath'] .'/'. $model->importfile_web_filename;   
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
    
    public function actionProcess()
    {
            $keylist = null;
            $productcategory_id = null;
            $productsubcategory_id = null; 
            if (!\Yii::$app->user->can('Import Houses')) {
                throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to update the file.'));
            } 
            $productcategory_id = Yii::$app->request->get('productcategory_id');
            $productsubcategory_id = Yii::$app->request->get('productsubcategory_id');
            $keylist = Yii::$app->request->get('keylist');
            if (!empty($keylist) && !empty($productcategory_id) && !empty($productsubcategory_id)  )
            {
                foreach ($keylist as $key => $value)
                {
                    $model = $this->findModel($value);
                    if ($model !== null) {
                        Yii::$app->params['uploadPath'] = dirname(Yii::$app->basePath) .'\importfile';
                        $inputFile = Yii::$app->params['uploadPath'] .'/'. $model->importfile_web_filename;   
                        try {
                              $inputFileType = IOFactory::identify($inputFile);
                              $objReader = IOFactory::createReader($inputFileType);
                              $objPhpSpreadsheet = $objReader->load($inputFile);
                           } catch (Exception $exc) {
                              Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                              Yii::$app->response->content = $exc->getTraceAsString(); 
                           }
                           $sheet = $objPhpSpreadsheet->getSheet(0);
                           $highestRow = $sheet->getHighestRow();
                           $highestColumn = $sheet->getHighestColumn();
                           for($row = 1; $row <=$highestRow;$row++)
                           {
                               $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
                               if ($row == 1)
                               {
                                   continue;
                               }
                               
                               try {
                                    $product = New Product();
                                    $product->name = $rowData[0][0];
                                    $product->surname = $rowData[0][1];
                                    $product->contactmobile = $rowData[0][2];
                                    $product->specialrequest = $rowData[0][3];
                                    $product->listprice = $rowData[0][4];
                                    if (($rowData[0][5] <> "Monthly") || ($rowData[0][5] <> "Weekly") || ($rowData[0][5] <> "Fortnightly") || ($rowData[0][5] <> "Every two months") || ($rowData[0][5] <> "Not applicable")){$product->frequency = "Not applicable";} else
                                    {$product->frequency = $rowData[0][5];}
                                    $product->productnumber = $rowData[0][6];
                                    $product->postcodefirsthalf = $rowData[0][7];
                                    $product->postcodesecondhalf = $rowData[0][8];
                                    $product->email = $rowData[0][9];
                                    $product->productsubcategory_id = $productsubcategory_id;
                                    $product->productcategory_id = $productcategory_id;
                                    $date = strtotime("+0 day");
                                    $product->sellstartdate = date("Y-m-d" , $date);
                                    $product->sellenddate = date('2099-12-31');
                                    $product->discontinueddate = null;
                                    $product->isactive = 1;
                                    $product->mandate = '';
                                    $product->gc_number = '';
                                    $product->save();
                               } catch (Exception $ex) {
                                   throw new \yii\web\ForbiddenHttpException(Yii::t('app','Validation error: First row of import file must include headings and will be skipped. Check your field values. '));
                               }
                               
                           } //for($row = 1; $row <=$highestRow;$row++)
                    } // if ($model !== null)
                } //foreach ($keylist as $key => $value)
                
                Yii::$app->session->setFlash('success',Yii::t('app','Import completed successfully'));
                return $this->redirect(['product/index?ProductSearch%5Bspecialrequest%5D=&ProductSearch%5Bfrequency%5D=&ProductSearch%5Bproductcategory_id%5D='.$productcategory_id.'&ProductSearch%5Bproductsubcategory_id%5D='.$productsubcategory_id.'&ProductSearch%5Bsellstartdate%5D=&ProductSearch%5Bname%5D=&ProductSearch%5Bsurname%5D=&ProductSearch%5Blistprice%5D=&ProductSearch%5Bgc_number%5D=']);
                //http://multi2.myhost/product/index?ProductSearch%5Bspecialrequest%5D=&ProductSearch%5Bfrequency%5D=&ProductSearch%5Bproductcategory_id%5D=5&ProductSearch%5Bproductsubcategory_id%5D=31&ProductSearch%5Bsellstartdate%5D=&ProductSearch%5Bname%5D=&ProductSearch%5Bsurname%5D=&ProductSearch%5Blistprice%5D=&ProductSearch%5Bgc_number%5D=
            } //if (!empty($keylist) && !empty($productcategory_id) && !empty($productsubcategory_id)
            elseif (empty($productcategory_id) || empty($productsubcategory_id)){
                Yii::$app->session->setFlash('warning',Yii::t('app','Select your postcode and street!'));
                //exit;
            }
            elseif (empty($keylist)){
                Yii::$app->session->setFlash('warning',Yii::t('app','No file selected.'));
                //exit;
            }
    }
      
    protected function findModel($id)
    {
        if (($model = Importhouses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
    
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('Import Houses')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to delete an uploaded file.'));
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    
    
}
