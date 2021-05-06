<?php
namespace frontend\modules\invoice\application\models\ci;

use yii\base\Component;
use Yii;

class Mdl_Templates extends Component
{
    
//used under ip/menu  view to create dropdownlists for matching templates for settings
//salesinvoice/pdf will use these different templates depending on what status the invoice has
public function get_invoice_templates($type = 'pdf')
    {
        if ($type == 'pdf') {
              $templates = \yii\helpers\FileHelper::findFiles(Yii::getAlias('@frontend').'/modules/invoice/application/views/invoice_templates/pdf', [
                                        'only' => ['*.php'],
                                        'recursive' => false,
                                ]);
        } elseif ($type == 'public') {
              $templates = \yii\helpers\FileHelper::findFiles(Yii::getAlias('@frontend').'/modules/invoice/application/views/invoice_templates/public', [
                                        'only' => ['*.php'],
                                        'recursive' => false,
                                ]);
        }
        $templates = $this->remove_extension($templates);
        $templates = $this->remove_path($templates);
        return $templates;
    }

    private function remove_extension($files)
    {
        foreach ($files as $key => $file) {
            $files[$key] = str_replace('.php', '', $file);
        }
        return $files;
    }
    
    private function remove_path($files)
    {
        //https://stackoverflow.com/questions/1418193/how-do-i-get-a-file-name-from-a-full-path-with-php
        foreach ($files as $key => $file) {
            $files[$key] = basename($file);
        }
        return $files;
    }
            
    private function flat_an_array($a)
    {
        foreach($a as $i)
        {
            if(is_array($i)) 
            {
                if($na) $na = array_merge($na,flat_an_array($i));
                else $na = flat_an_array($i);
            }
            else $na[] = $i;
        }
        return $na;
    }
       
    //public function get_quote_templates($type = 'pdf')
    //{
    //   if ($type == 'pdf') {
    //        $templates = \yii\helpers\FileHelper::findFiles('@frontend/modules/invoice/application/views/quote_templates/pdf', [
    //                                    'only' => ['*.pdf'],
    //                                    'recursive' => false,
    //                            ]);
    //    } elseif ($type == 'public') {
    //        $templates = \yii\helpers\FileHelper::findFiles('@frontend/modules/invoice/application/views/quote_templates/public', [
    //                                    'only' => ['*.pdf'],
    //                                    'recursive' => false,
    //                            ]);
    //    }
    //    $templates = $this->remove_extension($templates);
    //    return $templates;
    //}
}
