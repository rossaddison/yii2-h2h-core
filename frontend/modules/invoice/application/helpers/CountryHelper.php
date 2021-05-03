<?php
Namespace frontend\modules\invoice\application\helpers;

use Yii;
use yii\base\Component;

Class CountryHelper extends Component
{
public function get_country_list($cldr)
{
    if (file_exists(Yii::getAlias('@webroot') . '/frontend/modules/invoice/application/helpers/country-list/' . $cldr . '/country.php')) {
        return (include Yii::getAlias('@webroot') . 'helpers/country-list/' . $cldr . '/country.php');
    } else {
        return (include Yii::getAlias('@webroot') . 'helpers/country-list/en/country.php');
    }
}

public function get_country_name($cldr, $countrycode)
{
    $countries = $this->get_country_list($cldr);
    return (isset($countries[$countrycode]) ? $countries[$countrycode] : $countrycode);
}
}