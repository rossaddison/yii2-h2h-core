<?php
namespace frontend\modules\invoice\application\models;

use frontend\modules\invoice\application\models\Salesinvoice;
use frontend\modules\invoice\application\models\ci\Mdl_settings;
use yii\base\Component;

class SalesinvoiceQuery extends Component
{
    public static function find()
    {
       return Salesinvoice::find();
    }    
    
    public function readonly($value = true)
    {
        return $this->andWhere(['is_read_only' => $value]);
    }

    public function freshFirst()
    {
        return $this->orderBy('created_at DESC');
    }

    public function is_sent()
    {
        return $this->andWhere(['invoice_status_id' => Salesinvoice::STATUS_SENT]);
    }

    public function is_viewed()
    {
        return $this->andWhere(['invoice_status_id' => Salesinvoice::STATUS_VIEWED]);
    }
    
    public function visible()
    {
        return $this->andWhere(['invoice_status_id' => Salesinvoice::$availableStatusIds]);
    }
    
    // Excludes draft and paid invoices, i.e. keeps unpaid invoices.
    // viewed and unpaid
    public function is_open()
    {
        return $this->andWhere(['invoice_status_id' => [2, 3]]);        
    }
    
    public function is_draft()
    {
        return $this->andWhere(['=','invoice_status_id', 1]);
    }

    public function is_paid()
    {
         return $this->andWhere(['=','invoice_status_id', 4]);
    }

    public function isoverdue()
    {
         return $this->andWhere(['=','is_overdue', 1]);
    }
        
    public function hasUser(User $user)
    {
        $this->leftJoin('works_salesinvoice_user siu', 'siu.invoice_id = invoice.id');
        return $this->andWhere(['siu.user_id' => $user->id]);
    }
    
    public function by_product($product_id)
    {
        return $this->andWhere(['=','product_id',$product_id]);
    }
    
    
    
    
}
