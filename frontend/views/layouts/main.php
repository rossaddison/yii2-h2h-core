<?php
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use kartik\icons\FontAwesomeAsset;
use Yii;
$container = new \yii\di\Container;
Yii::$container->set('yii\widgets\LinkPager', 'yii\bootstrap4\LinkPager');
$tooltipcarousal = Yii::t('app','Include snap shots, pdf, xlsx, ods file types from your phone here. These can be selected as a dropdown list under Daily Cleans or under Daily Costs.');
FontAwesomeAsset::register($this);
AppAsset::register($this);
$js = <<< 'SCRIPT'
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});
$(function () { 
    $("[data-toggle='popover']").popover(); 
});
SCRIPT;
$this->registerJs($js);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>    
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>    
</head>
<body>
<?php $this->beginBody()?>
<div class="wrap">
  <div class="content">   
    <?php
    $brandlabel = Yii::t('app','House 2 house');
    NavBar::begin([
        'brandLabel' => '<span class="yii-logo"></span>'.$brandlabel,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
              'class' => 'navbar navbar-dark bg-dark',
        ],
    ]);
    if (!Yii::$app->user->isGuest){        
        $menuItems = [    
                ['label' => Html::button(Yii::t('app','Other'),['class'=>'btn btn-info btn-lg']),'url'=> '','visible'=>Yii::$app->user->can('Manage Admin'),
                 'items' => [
                         ['label' => Html::button(Yii::t('app','Company'),['class'=>'btn btn-info btn-lg']), 'url' => ['/company/index'],],
                         ['label' => Html::button(Yii::t('app','Texting - Messages'),['class'=>'btn btn-info btn-lg']), 'url' => ['/messaging/index'],],
                         ['label' => Html::button(Yii::t('app','Message Log'), ['class'=>'btn btn-info btn-lg']),'url' => ['/messagelog/index'],],
                         ['label' => Html::button(Yii::t('app','Employee'),['class'=>'btn btn-info btn-lg']), 'url' => ['/employee/index'],],
                         ['label' => Html::button(Yii::t('app','Tax Codes'),['class'=>'btn btn-info btn-lg','title'=>Yii::t('app','Used to categorize revenue and expenses. These codes are NOT used in any VAT calculations. In fact there are no vat calculations therefore figures that you enter eg. under Daily Cleans or House must be inclusive of vat.'),'data-toggle'=>'tooltip']), 'url' => ['/tax/index'],],
                         ['label' => Html::button(Yii::t('app','Images / Files Upload'),['class'=>'btn btn-info btn-lg','datatoggle'=>'tooltip', 'title'=> $tooltipcarousal]), 'url' => ['/carousal/index'],],
                         ['label' => Html::button(Yii::t('app','Instruction'),['class'=>'btn btn-info btn-lg']), 'url' => ['/instruction/index'],],                       
                  ],
                ],
                ['label' => Html::button(Yii::t('app','Revenue'),['class'=>'btn btn-success btn-lg']),'url'=> '','visible'=>Yii::$app->user->can('Manage Admin'),
                 'items' => [
                         
                         ['label' => Html::button(Yii::t('app','Postcode'),['class'=>'btn btn-success btn-lg']), 'url' => ['/productcategory/index'],],
                         ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Street'),['class'=>'btn btn-success btn-lg']), 'url' => ['/productsubcategory/index'],],
                         ['label' => str_repeat("&nbsp;", 3).Html::button(Yii::t('app','Quick Build'),['class'=>'btn btn-danger btn-lg']), 'url' => ['/easy/initialize'],],
                         ['label' => str_repeat("&nbsp;", 5).Html::button(Yii::t('app','House'),['class'=>'btn btn-success btn-lg']), 'url' => ['/product/index'],],
                         ['label' => str_repeat("&nbsp;", 6).Html::button(Yii::t('app','Daily Cleans'),['class'=>'btn btn-success btn-lg']), 'url' => ['/salesorderheader/index'],],
                         ['label' => str_repeat("&nbsp;", 7).Html::button(Yii::t('app','Invoice'),['class'=>'btn btn-success btn-lg']), 'url' => ['/invoice/salesinvoice/'],],
                  ],
                ],
                ['label' => Html::button(Yii::t('app','Expenses'),['class'=>'btn btn-warning btn-lg']),'url'=> '','visible'=>Yii::$app->user->can('Manage Admin'),
                 'items' => [
                        
                         ['label' => Html::button(Yii::t('app','Cost Code'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/costcategory/index'],],
                         ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Cost Sub Code'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/costsubcategory/index'],],
                         ['label' => str_repeat("&nbsp;", 4).Html::button(Yii::t('app','Cost'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/cost/index'],],
                         ['label' => str_repeat("&nbsp;", 6).Html::button(Yii::t('app','Daily Costs'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/costheader/index'],],
                        
                  ],
                ],
                 ['label' => Html::button(Yii::t('app','Database'),['class'=>'btn btn-danger btn-lg']),'url'=> '','visible'=>Yii::$app->user->can('Manage Admin'),
                 'items' => [
                         ['label' => Html::button(Yii::t('app','Import Houses'),['class'=>'btn btn-danger btn-lg']), 'url' => ['/importhouses/index'],],
                         ['label' => Html::button(Yii::t('app','Backup database'),['class'=>'btn btn-danger btn-lg',]), 'url' => ['/backuper/backuper/'],],
                         ['label' => Html::button(Yii::t('app','Google Translate'),['class'=>'btn btn-danger btn-lg',]), 'url' => ['/google3translateclient/google3translateclient/index/']],
                   ],
                ],
                ['label' => Html::button(Yii::t('app','Admin'),['class'=>'btn btn-info btn-lg']),'url'=> '','visible'=>Yii::$app->user->can('Manage Admin'),
                 'items' => [
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Role Management (Admin)'),['class'=>'btn btn-info btn-lg']), 'url' => ['/libra/role'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Update Admin'),['class'=>'btn btn-info btn-lg']), 'url' => ['/libra/role/update/admin'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Permission Management (Admin)'),['class'=>'btn btn-info btn-lg']), 'url' => ['/libra/permission'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Conditions/Rules Management (Admin)'),['class'=>'btn btn-info btn-lg']), 'url' => ['/libra/rule/index'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','User Management (Support and Admin)'),['class'=>'btn btn-info btn-lg']), 'url' => ['/libra/user'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Delete a User'),['class'=>'btn btn-info btn-lg']), 'url' => ['/libra/delete'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Download User Data'),['class'=>'btn btn-info btn-lg']), 'url' => ['/libra/download'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Change User Name or Email Address'), ['class'=>'btn btn-info btn-lg']),'url' => ['/libra/settings'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','User forgot their password'),['class'=>'btn btn-info btn-lg']), 'url' => ['/libra/forgot'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Signup a User'),['class'=>'btn btn-info btn-lg']), 'url' => ['/libra/signup'],],
                  ],
                ],
                ['label' => Html::button(Yii::t('app','Quick Note'),['class'=>'btn btn-primary btn-lg']),'url'=> '/quicknote/create','visible'=>Yii::$app->user->can('Manage Basic'),
                 'items' => [                        
                ],
                ],
                ['label' => Html::button(Yii::t('app','Gii'),['class'=>'btn btn-success btn-lg']),'url'=> '/gii','visible'=>Yii::$app->user->can('Manage Admin'),
                 'items' => [                        
                ],
                ],
                ['label' => Html::button(Yii::t('app','Invoicing'),['class'=>'btn btn-warning btn-lg']),'url'=> '','visible'=>Yii::$app->user->can('Manage Admin'),
                 'items' => [ 
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Settings - Interface'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/invoice/ip/settings'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Settings - Model'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/invoice/ip/list'],],
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','Email Templates'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/invoice/ip/formlist'],],
                            ['label' => str_repeat("&nbsp;", 3).Html::button(Yii::t('app','Create Sales Invoice'),['class'=>'btn btn-warning btn-lg','title'=>Yii::t('app','Create your Invoices under Revenue..House..Debt Column'),'data-toggle'=>'tooltip']), 'url' => ['@web/product/index'],],
                            ['label' => str_repeat("&nbsp;", 4).Html::button(Yii::t('app','Sales Invoice'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/invoice/salesinvoice'],],
                            ['label' => str_repeat("&nbsp;", 4).Html::button(Yii::t('app','Sales Invoice Payment Method'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/invoice/salesinvoicemethodpay'],],
                            ['label' => str_repeat("&nbsp;", 5).Html::button(Yii::t('app','Sales Invoice Payment'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/invoice/salesinvoicepayment'],],
                            ['label' => str_repeat("&nbsp;", 6).Html::button(Yii::t('app','Signup an Invoice Payer'),['class'=>'btn btn-warning btn-lg','title'=>Yii::t('app','Give the "Make payment online" permission to the signed up householder/payer.'),'data-toggle'=>'tooltip']), 'url' => ['/libra/signup'],],
                     
                ],
                ],
                ['label' => Html::button(Yii::t('app','Make a payment'),['class'=>'btn btn-warning btn-lg']),'url'=> '','visible'=>Yii::$app->user->can('Make payment online'),
                 'items' => [ 
                            ['label' => str_repeat("&nbsp;", 2).Html::button(Yii::t('app','View Invoices'),['class'=>'btn btn-warning btn-lg']), 'url' => ['/invoice/guest/index'],],
                            ],
                ],
             ];
    }  
    if (Yii::$app->user->isGuest) {
             $menuItems[] = ['label' => Html::button(Yii::t('app','Home'),['class'=>'btn btn-success btn-lg','title'=>Yii::t('app','Home'),'data-toggle'=>'tooltip']), 'url' => ['/site/index'],];
             $menuItems[] = ['label' => Html::button(Yii::t('app','Login'),['class'=>'btn btn-success btn-lg','title'=>Yii::t('app','Login'),'data-toggle'=>'tooltip']), 'url' => ['/libra/login']];
    } else {
             $menuItems[] = '<li>'
            . Html::beginForm(['/libra/logout'], 'post')
            . Html::submitButton(
                Yii::t('app','Logout (') . Yii::$app->user->identity->attributes['name'].')',
                ['class' => 'btn btn-secondary logout btn-lg']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        //'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels'=> false,
        //'options' => ['class' => 'navpills'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container-fluid">
        <div class="content-wrapper">
            <?= Breadcrumbs::widget([
                //an individual breadcrumb per page
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'activeItemTemplate' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n"
            ]);
            ?>
            <div class="container container-alert">
                        <div class="row">
                            <div class="col-xs-12">
                                <?=          
                                   Alert::widget();
                                ?>
                            </div>
                        </div>
            </div>
            <?= $content ?>
        </div>
    </div>
  </div>
</div>
 
 <footer class="footer">
 <div class="container-fluid">    
     <div class="alert alert-success" role="alert" style ="background:lightcyan" align="center">
            <p class="center">&copy; <?= str_repeat("&nbsp;", 2).date('Y').str_repeat("&nbsp;", 2). Yii::t('app','House 2 house  - All rights reserved') ?> </p>
            <p class="center"><?php echo Yii::t('app','Online ~ Regular Services Management Software') ?></p>
            <p class="center"><?= Yii::powered() ?></p>            
     </div> 
 </div>
</footer> 
<?= \bizley\cookiemonster\CookieMonster::widget([
        'content' => [
            'buttonMessage' => Yii::t('app','OK. Got it'), // instead of default 'I understand'
            'mainMessage'=> Yii::t('app','We use cookies on this website to help us offer you the best online experience. By continuing to use our website, you are agreeing to our use of cookies and to our privacy policy.')
                     ],
        'mode' => 'bottom'
    ]) ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
