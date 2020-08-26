<?php
use yii\helpers\Html;
use kartik\tree\TreeView;
use frontend\models\KrajeeProductTree;

$this->title = Yii::t('app','Houses');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Index'), 'url' => ['krajeeproducttree/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Refresh Database with active houses'), 'url' => ['krajeeproducttree/populate']];
?>
<div class="krajeeproducttree-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
<?php  
    echo TreeView::widget([
        // single query fetch to render the tree
        'query' => KrajeeProductTree::find()->addOrderBy('root, lft'), 
        'headingOptions' => ['label' => 'Categories'],
        'fontAwesome' => true,      // optional
        'isAdmin' => false,         // optional (toggle to enable admin mode)
        'displayValue' => 1,        // initial display value
        'softDelete' => true,       // defaults to true
        'cacheSettings' => [        
            'enableCache' => true   // defaults to true
        ],
        'hideTopRoot'=>true,
        //'treeOptions' => ['style' => 'height:1000px width:1900px' ],
        //more detail can be added to the node
        'nodeLabel' => function($node) {
                             return $node->name;
                       },
        //disable the toolbar completely                       
        'toolbar'           => [
                TreeView::BTN_REFRESH => false,
                TreeView::BTN_CREATE => false,
                TreeView::BTN_CREATE_ROOT => false,
                TreeView::BTN_REMOVE => false,
                TreeView::BTN_SEPARATOR => false,
                TreeView::BTN_MOVE_UP => false,
                TreeView::BTN_MOVE_DOWN => false,
                TreeView::BTN_MOVE_LEFT => false,
                TreeView::BTN_MOVE_RIGHT => false,
            ],                 
        'showIDAttribute' => false,
        'showTooltips' => false,
        'showNameAttribute' => false,
        'softDelete' => false,
        'cacheSettings' => ['enableCache' => true],
        //show => none removes the iconType etc setting under details                       
        'iconEditSettings'=>['show'=>'none'],
        //
        'showFormButtons'=>false,
        'breadcrumbs'=>[//'depth'=>null,
                        'glue'=>'&raquo;',
                        'activeCss'=>'kv-crumb-active',
                        'untitled'=>'Untitled'
                       ],
        //removing header below removes the search button and header                       
        'wrapperTemplate'=>'{header}{tree}{footer}',         
        //'wrapperTemplate'=>'{tree}',
        //removing the detail below removes the second column of view(s) 1 - 5
        'mainTemplate'=>'<div class="row">
                            <div class="col-sm-6">
                                {wrapper}
                            </div>
                            <div class="col-sm-6">
                                {detail}
                            </div>
                         </div>'                       
    ]); 
?>
</div>
