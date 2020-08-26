<?php
namespace frontend\modules\google3translateclient\controllers;

use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use frontend\modules\google3translateclient\models\Sourced;
use frontend\modules\google3translateclient\models\Google3translateclient;
use frontend\models\Company;
use frontend\modules\google3translateclient\models\Google3translateclientSearch;
use Google\Cloud\Translate\V3\TranslationServiceClient;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use Yii;

class Google3translateclientController extends \yii\web\Controller
{
    public $google_get_service_account_url =  "https://console.cloud.google.com/apis/credentials/serviceaccountkey";
    
    public $ssl_get_cacert_pem_url ="http://curl.haxx.se/ca/cacert.pem";  
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'delete' => ['POST'],
                ],
            ],
           'access' => 
                            [
                            'class' => \yii\filters\AccessControl::className(),
                            'only' => ['index','google3translateclient','update','view'],
                            'rules' => [
                            [
                              'allow' => true,
                              'roles' => ['admin','support'],
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
        //store cacert.pem file in ...bin/php/php7.4.4 or latest php directory. Adjust 'curl.cainfo' setting in php.ini to
    //[curl] eg. for wampserver curl.cainfo ="C:/wamp64/bin/php/php7.4.4/cacert.pem"
        
        //$all_languages = ['af', 'ar', 'az', 'be', 'bg', 'bs', 'ca', 'cs', 'da', 'de', 'el', 'es', 'et', 'fa', 'fi', 'fr', 'he', 'hr', 'hu', 'hy', 'id', 'it', 'ja', 'ka', 'kk', 'ko', 'kz', 'lt', 'lv', 'ms', 'nb-NO', 'nl', 'pl', 'pt', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sr', 'sr-Latn', 'sv', 'tg', 'th', 'tr', 'uk', 'uz', 'vi', 'zh-CN', 'zh-TW'];
              
        if (!\Yii::$app->user->can('Google Translate')) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You do not have permission to translate this package into a language of your choice. Ask your Administrator for the Google Translate permission and you will be able to multi select which sentences you want Google to translate. '));
        }
        
        $minPhpVersion = version_compare(PHP_VERSION, '7.1.0') >= 0; 
        $path_and_filename = trim(Company::findOne(1)->google_translate_json_filename_and_path,'"');
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$path_and_filename");
                
        if (empty($path_and_filename)){
            throw new \yii\web\ForbiddenHttpException(Yii::t('app','You have not setup the filename and path of your JSON file that you downloaded from Google Translate (under your service account) in Company...Setting. Download the JSON file and put its path/filename under Other...Company including double quotes and forward slashes. If you have not setup a service account setup key ').$this->google_get_service_account_url); 
        }
            
        if (!file_exists($path_and_filename)){
            throw new\yii\web\ForbiddenHttpException(Yii::t('app', 'Your Google Translate Credential Json file that you downloaded from your Google Translate Service Account does not exist at the path that you specified under Other ... Settings. Ensure that you have double quotes and forward slashes.'));
        }
        
        !empty(\ini_get('curl.cainfo')) ?  $curlcertificate = true : false;
        
        if ($curlcertificate == false) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'Your SSL certificate cacert.pem for this version of PHP {0} does not exist under the server php directory  ...bin/php/{0}', [PHP_VERSION]).Html::a(Yii::t(' .Download here '),['url'=>$this->ssl_get_cacert_pem_url]));        
        }
                
        $searchModel = new Google3translateclientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=100;
        $dataProvider->sort->sortParam = false;
        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'asc' => ['id' => SORT_ASC,],
                    'desc' => ['id' => SORT_DESC,],
                    'default' => SORT_DESC,
                ],
                'translation' => [
                    'asc' => ['translation' => SORT_ASC],
                    'desc' => ['translation' => SORT_DESC],
                    'label' => 'My Translation',
                    'default' => SORT_ASC
                 ],
                //searching with message relation line 3
                //https://stackoverflow.com/questions/33508570/yii2-sort-and-filter-by-one-to-many-to-one-relation-in-gridview
                'message_table_filter' => [
                    'asc' => ['message.message' => SORT_ASC],
                    'desc' => ['message.message' => SORT_DESC],
                    'label' => 'My message label',
                    'default' => SORT_ASC
                ],  
            ],
            'defaultOrder' => [
              'id' => SORT_DESC,
            ]
          ]); 
        if (Yii::$app->request->post('hasEditable')) { 
            //F12 browser 'editableKey' is json format not simple format therefore must decode into parts
            $translatedId = Yii::$app->request->post('editableKey');
            $json = Json::decode($translatedId, true);
            $id = $json['id']; 
            $model = Google3translateclient::findOne($id);
            $out = Json::encode(['output'=>'', 'message'=>'']);
            $posted = current($_POST['Google3translateclient']);
            //do not use if ($model->load($post)) shortcut method
            //https://www.yiiframework.com/doc/api/2.0/yii-base-model#load()-detail
            $output = '';
            if  (isset($posted['translation'])) {
                $model->translation = $posted['translation'];
                $model->save();
                $output = Yii::$app->formatter->asText($model->translation);
             }
            return Json::encode(['output'=> $output, 'message'=>'']);       
       }
        
        return $this->render(
            'index',
            [
                'minPhpVersion' => $minPhpVersion,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'google_credential_file' =>$path_and_filename,
                'curlcertificate'=>$curlcertificate,
            ]
        );
    }
    
    public function actionGoogle3translateclient()
    {
     //https://cloud.google.com/docs/authentication/production#windows
     try {
        $keylist = Yii::$app->request->get('keylist');
        $path_and_filename = trim(Company::findOne(1)->google_translate_json_filename_and_path,'"');
        $data = file_get_contents (FileHelper::normalizePath($path_and_filename));
        $json = Json::decode($data, true);
        $projectId = $json['project_id']; 
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$path_and_filename");
        $translationServiceClient = new TranslationServiceClient();
        foreach ($keylist as $key => $value)
        //foreach ($keylist as $key)
        {    
            $idvalue = $keylist[$key]['id'];
            //table source_message
            //table source_message has fields id, category, and message
            $sourced_message = Sourced::findOne($idvalue);
            //$sourced_id = $sourced_message->id;
            //$sourced_category = $sourced_message->category;
            $sourced_for_translation = $sourced_message->message;
            //table message id corresponds to id in source_message
            //language code filled from @frontend/messages/template.php languages setting.
            //table messages has fields id, language, translation
            $translated = Google3translateclient::findOne($idvalue);
            $translated_language = $translated->language;
            $targetLanguageCode = $translated_language;
            $contents = [$sourced_for_translation];        
            $formattedParent = $translationServiceClient->locationName($projectId, 'global');
            $response = $translationServiceClient->translateText(
                    $contents, 
                    $targetLanguageCode, 
                    $formattedParent
                   // ['model' => null, 'sourceLanguageCode' => 'en', 'mimeType' => 'text/plain']
            );
            //$response_getTranslations = $response->getTranslations();
            foreach ($response->getTranslations() as $translation) {
                 $translated->translation = $translation->getTranslatedText();
                 $translated->save();
            }
       }//foreach
               
       } catch (\ErrorException $e) {
             throw new ForbiddenHttpException($e);
       }
       $translationServiceClient->close();//
    } //public function actionTranslated()
    
    public function actionView($id) {
        $model=$this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', Yii::t('app','Saved record successfully'));
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('view', ['model'=>$model]);
        }
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => 1]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    protected function findModel($id)
    {
        if (($model = Google3translateclient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
} //class
