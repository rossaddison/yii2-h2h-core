<?php
Namespace frontend\modules\invoice\application\components;

use frontend\modules\invoice\application\models\ci\Mdl_settings;
use frontend\modules\invoice\application\libraries\Lang;
use frontend\modules\invoice\application\models\Salesinvoice;
  
class Utilities 
{
    public static function languages()
    {
        $mdl_settings = new Mdl_settings();
        $mdl_settings->load_settings();
        $language = $mdl_settings->get_setting('default_language');
        $lang = [];
        $lang = new Lang();
        $lang->load('ip', $language);
        $lang->load('gateway', $language);
        $lang->load('custom',$language);
        $lang->load('merchant',$language);
        $lang->load('form_validation',$language);
        $languages = $lang->_language;
        return $languages;
    }
    
    public static function trans($quote)
    {
        $languages = Utilities::languages();
        foreach ($languages as $key => $value){
             if ($quote === $key){
                  return $value;                                    
             }
        }                   
    }
    
    public static function random_string($type = 'alnum', $len = 8)
    {
                    switch ($type)
                    {
                            case 'basic':
                                    return mt_rand();
                            case 'alnum':
                            case 'numeric':
                            case 'nozero':
                            case 'alpha':
                                    switch ($type)
                                    {
                                            case 'alpha':
                                                    $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                    break;
                                            case 'alnum':
                                                    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                    break;
                                            case 'numeric':
                                                    $pool = '0123456789';
                                                    break;
                                            case 'nozero':
                                                    $pool = '123456789';
                                                    break;
                                    }
                                    return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
                            case 'unique': // todo: remove in 3.1+
                            case 'md5':
                                    return md5(uniqid(mt_rand()));
                            case 'encrypt': // todo: remove in 3.1+
                            case 'sha1':
                                    return sha1(uniqid(mt_rand(), TRUE));
                    }
    }
    
    public static function mark_viewed($invoice_id)
    {
        $invoice = Salesinvoice::find()
                   ->where(['=','invoice_id',$invoice_id])->andWhere(['invoice_status_id' => 2])
                   ->one();
        
        //mark as viewed if status is 2                                    
        if (!empty($invoice)){
            //set the invoice to viewed status ie 3
            $invoice->invoice_status_id = 3;
            $invoice->save();
        }
        
        $mdl_settings = new Mdl_settings();
        
        //set the invoice to 'read only' only once it has been viewed according to 'Other settings' 
        //2 sent, 3 viewed, 4 paid,
        if ($mdl_settings->setting('read_only_toggle') == 3)
        {
            $invoice = Salesinvoice::find()
                   ->where(['=','invoice_id',$invoice_id])
                   ->one();
            $invoice->is_read_only = 1;
            $invoice->save();
        }
    }
    
    public static function mark_sent($invoice_id)
    {
        $invoice = Salesinvoice::find()
                   ->where(['=','invoice_id',$invoice_id])
                   ->andWhere(['=','invoice_status_id', 1])
                   ->one();
        //draft->sent->view->paid
        //set the invoice to sent ie. 2                                    
        if (!empty($invoice)){
            $invoice->invoice_status_id = 2;
            $invoice->save();
        }
        
        $mdl_settings = new Mdl_settings();
        
        //set the invoice to read only ie. not updateable, if invoice_status_id is 2
        if ($mdl_settings->setting('read_only_toggle') == 2)
        {
            $invoice = Salesinvoice::find()
                   ->where(['=','invoice_id',$invoice_id])
                   ->one();
            $invoice->is_read_only = 1;
            $invoice->save();
        }
    }
    
    public static function getPlaceholderRelativeUrl()
    {
        return '/frontend/modules/invoice/uploads/';
    } 
    
    public static function getPlaceholderAbsoluteUrl(){
        return Url::to(Utilities::getPlaceholderRelativeUrl,true);                                    
    }
    
    public static function getAssetholderRelativeUrl()
    {        
        return '/frontend/modules/invoice/assets/';
    }
    
    public static function getCustomerfolderRelativeUrl()
    {        
        return '/frontend/modules/invoice/uploads/customer_files/';
    }
    
    public static function getMpdfTempfolderRelativeUrl()
    {        
        return '/frontend/modules/invoice/uploads/temp/mpdf/';
    }
    
    public static function getTemplateholderRelativeUrl()
    {
        return '/invoice_templates/pdf/';
    }        
    
    public static function getUploadsArchiveholderRelativeUrl()
    {
        return '/frontend/modules/invoice/uploads/archive';
    }
}// class