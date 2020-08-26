<?php

namespace frontend\controllers;

use frontend\models\KrajeeProductTree;
use frontend\models\Productcategory;
use frontend\models\Productsubcategory;
use frontend\models\Product;
use kartik\tree\controllers\NodeController;
use yii\filters\VerbFilter;

class KrajeeproducttreeController extends NodeController
{
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
                            'only' => ['index','populate'],
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
        return $this->render('index');      
    }
    
    public function actionPopulate()
    {
        //remove all data in the database
        KrajeeProductTree::deleteAll();
        //rebuild the database given data from productcategory ie. postcode, productsubcategory ie. street, product ie. house
        //create the root and call it Run
        $root = new KrajeeProductTree(['name'=>'Run']);
        $root->makeRoot();
        //create the postcode nodes
        $allpostcodes =[];
        $allpostcodes = Productcategory::find()->orderBy('id')->all();
        foreach ($allpostcodes as $key => $value)
        {
            $newpostcodenode = new KrajeeProductTree(['name'=>$allpostcodes[$key]['name']]);
            $newpostcodenode->productcategory_id = $allpostcodes[$key]['id']; 
            $newpostcodenode->prependTo($root);
            $allstreets = [];
            $allstreets = Productsubcategory::find()
                        ->where(['productcategory_id'=>$allpostcodes[$key]['id']])
                        ->orderBy('sort_order')
                        ->all();
            //create the street nodes associated with this new node
            $allhouses = [];
            foreach ($allstreets as $key => $value)
            {
                $newstreetnode = new KrajeeProductTree(['name'=>$allstreets[$key]['name']]);
                $newstreetnode->productsubcategory_id = $allstreets[$key]['id'] ;
                $newstreetnode->prependTo($newpostcodenode);
                $allhouses = Product::find()
                        ->where(['productsubcategory_id'=>$allstreets[$key]['id']])
                        ->andWhere(['productcategory_id'=>$allstreets[$key]['productcategory_id']])
                        ->andWhere(['isactive'=>1])
                        ->all();
                //create the house nodes associated with this new steet node
                foreach ($allhouses as $key => $value)
                {
                    $newhousenode = new KrajeeProductTree(['name'=>$allhouses[$key]['productnumber']]);
                    $newhousenode->product_id = $allhouses[$key]['id'];
                    $newhousenode->prependTo($newstreetnode);
                }  
            }  
        }      
        return $this->render('index'); 
    }     
}
