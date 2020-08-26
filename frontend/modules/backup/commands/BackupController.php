<?php
namespace frontend\modules\backuper\commands;

use frontend\modules\backuper\components\BackupHelper;
use frontend\modules\backuper\components\BackuperFilter;
use frontend\modules\backuper\models\FinalStep;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class BackupController extends Controller
{
    private $db = null;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'backuper' => [
                'class' => BackuperFilter::class,
            ],
        ];
    }

    public function actionIndex()
    {
        
            return $this->backup();
        
    }

    private function backup()
    {
     
        $this->stdout("Running backups...\n", Console::FG_YELLOW);
        /** @var UpdateHelper $helper */
        $helper = Yii::createObject([
            'class' => BackupHelper::className(),
        ]);
        $process = $helper->applyAppMigrations(
            false
        );

        $process->run();

        if (!$this->interactive && getenv("BACKUP_ADMIN")) {
            return $this->finalStep();
        } else {
            return $this->adminUser();
        }
    }

    private function finalStep()
    {
        $model = new FinalStep();
        Yii::setAlias('@webroot', Yii::getAlias('@app/web/'));
        foreach ($model->attributes() as $attribute) {
            if ($attribute !== 'useMemcached') {
                $model->setAttributes(
                    [
                        $attribute => $this->prompt("-> $attribute", [
                            'required' => true,
                            'default' => $model->$attribute,
                        ]),
                    ]
                );
            } else {
                $model->useMemcached = $this->confirm("Use memcached extension?", false);
            }
        }
        if (getenv('H2H_SERVER_NAME')) {
            $model->serverName = getenv('H2H_SERVER_NAME');
        }
        if (getenv('H2H_SERVER_PORT')) {
            $model->serverPort = intval(getenv('H2H_SERVER_PORT'));
        }
            $this->stdout("Backup complete!\n", Console::FG_GREEN);
        return 0;
    }
}
