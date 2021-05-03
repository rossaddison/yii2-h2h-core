<?php
namespace frontend\modules\invoice\application\models\ci;

use frontend\modules\invoice\application\models\Salesinvoice;
use frontend\modules\invoice\application\models\SalesinvoiceUploads;
use frontend\modules\invoice\application\components\Utilities;
use yii\base\Component;

class Mdl_Uploads extends Component 
{
    public function create($db_array = null)
    {
        $new = new SalesinvoiceUploads();
        $new->product_id = $db_array['product_id'];
        $new->url_key = $db_array['url_key'];
        $new->file_name_original = $db_array['file_name_original'];
        $new->file_name_new = $db_array['file_name_new'];
        $new->uploaded_date = date('Y-m-d');
        $new->save();        
        return $new->upload_id;
    }

    public function get_invoice_uploads($invoice_id)
    {
        $invoice = Salesinvoice::find()->where(['=','invoice_id',$invoice_id])->one();
        $uploads = SalesinvoiceUploads::find()->where(['=','url_key',$invoice->invoice_url_key])->all();
        $names = [];
        if (!empty($uploads)) {
            foreach ($uploads as $key => $value) {
                array_push($names, [
                    //create a complete path here ie. absolute. Not a relative path.
                    'filename_with_path' => \Yii::getAlias('@webroot') .Utilities::getCustomerfolderRelativeUrl(). $uploads[$key]['file_name_new'],                   
                ]);
            }
        }
        return $names;
    }
}
