<?php
namespace frontend\models;

use Yii;
 
class KrajeeProductTree extends \kartik\tree\models\Tree
{
    public static function getDb()
    {
        return \frontend\components\Utilities::userdb();
    }
       
    public static function tableName()
    {
        return 'works_krajee_product_tree';
    }
    
    public function isDisabled()
    {
        //so if the user is an admin he will be able to edit the tree otherwise the tree will be disabled
        //but the nodes will be clickable
        if (Yii::$app->user->can('Manage Admin')) {
            return false;
        } else { return true; }
    }
    
    public function rules()
    {
        return [
            [['product_id','productcategory_id','productsubcategory_id'],'integer'],
            [['product_id','productcategory_id','productsubcategory_id'],'default','value'=>null], 
            [['product_id','productcategory_id','productsubcategory_id'],'safe']
        ];
    }
}
