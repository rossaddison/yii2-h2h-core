<?php
use yii\helpers\Html;
use Yii;
if ($exception instanceof \yii\db\IntegrityException) {
   $name = $exception->getName; 
   $message = Yii::t('app','Integrity constraint has occurred.');
};  
if ($exception instanceof yii\web\MethodNotAllowedHttpException) {
   $name = Yii::t('app','Method not allowed'); 
   $message = Yii::t('app','Method not allowed: Http Exception');
}   
if (method_exists($this, 'beginPage')) {
    $this->beginPage();
}
if ($exception instanceof GoCardlessPro\Core\Exception) {
   $name = 'Gocardless Error'; 
   $message = 'Gocardless Error';
}   
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php $exception ?>Title</title>
    <style>
        body {
            font: normal 9pt "Verdana";
            color: #000;
            background: #fff;
        }
        h1 {
            font: normal 18pt "Verdana";
            color: #f00;
            margin-bottom: .5em;
        }
        h2 {
            font: normal 14pt "Verdana";
            color: #800000;
            margin-bottom: .5em;
        }
        h3 {
            font: bold 11pt "Verdana";
        }
        p {
            font: normal 9pt "Verdana";
            color: #000;
        }
        .version {
            color: gray;
            font-size: 8pt;
            border-top: 1px solid #aaa;
            padding-top: 1em;
            margin-bottom: 1em;
        }
    </style>
</head>
<body>
    <h1><?= Html::encode($name)?></h1>
    <h2><?= Html::encode($message)?></h2>
    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <div class="version">
        <?= date('Y-m-d H:i:s', time()) ?>
    </div>
    <?php
    if (method_exists($this, 'endBody')) {
        $this->endBody(); // to allow injecting code into body (mostly by Yii Debug Toolbar)
    }
    ?>
</body>
</html>
<?php
if (method_exists($this, 'endPage')) {
    $this->endPage();
}
