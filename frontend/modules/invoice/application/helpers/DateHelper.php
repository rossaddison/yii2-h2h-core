<?php
Namespace frontend\modules\invoice\application\helpers;

Use  frontend\modules\invoice\application\models\ci\Mdl_settings;
Use  yii\base\Component;
Use  \DateTime;

Class DateHelper extends Component
{

public $mdl_settings;
    
public function init()
{
    parent::init();
    $this->mdl_settings = new Mdl_settings();
    $this->mdl_settings->load_settings();
}
    
public function date_formats()
{
    return [
        'd/m/Y' => [
            'setting' => 'd/m/Y',
            'datepicker' => 'dd/mm/yyyy',
        ],
        'd-m-Y' => [
            'setting' => 'd-m-Y',
            'datepicker' => 'dd-mm-yyyy',
        ],
        'd-M-Y' => [
            'setting' => 'd-M-Y',
            'datepicker' => 'dd-M-yyyy',
        ],
        'd.m.Y' => [
            'setting' => 'd.m.Y',
            'datepicker' => 'dd.mm.yyyy',
        ],
        'j.n.Y' => [
            'setting' => 'j.n.Y',
            'datepicker' => 'd.m.yyyy',
        ],
        'd M,Y' => [
            'setting' => 'd M,Y',
            'datepicker' => 'dd M,yyyy',
        ],
        'm/d/Y' => [
            'setting' => 'm/d/Y',
            'datepicker' => 'mm/dd/yyyy',
        ],
        'm-d-Y' => [
            'setting' => 'm-d-Y',
            'datepicker' => 'mm-dd-yyyy',
        ],
        'm.d.Y' => [
            'setting' => 'm.d.Y',
            'datepicker' => 'mm.dd.yyyy',
        ],
        'Y/m/d' => [
            'setting' => 'Y/m/d',
            'datepicker' => 'yyyy/mm/dd',
        ],
        'Y-m-d' => [
            'setting' => 'Y-m-d',
            'datepicker' => 'yyyy-mm-dd',
        ],
        'Y.m.d' => [
            'setting' => 'Y.m.d',
            'datepicker' => 'yyyy.mm.dd',
        ],
    ];
}

public function date_from_mysql($date, $ignore_post_check = false)
{
    
    if ($date <> '0000-00-00') {
        if (!$_POST or $ignore_post_check) {
            $date = DateTime::createFromFormat('Y-m-d', $date);
            return $date->format($this->mdl_settings->setting('date_format'));
        }
        return $date;
    }
    return '';
}

public function date_from_timestamp($timestamp)
{
    $date = new DateTime();
    $date->setTimestamp($timestamp);
    return $date->format($this->mdl_settings->setting('date_format'));
}

public function date_to_mysql($date)
{
   $date = DateTime::createFromFormat($this->mdl_settings->setting('date_format'), $date);
   return $date->format('Y-m-d');
}


public function is_date($date)
{
    $format = $this->mdl_settings->setting('date_format');
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

public function date_format_setting()
{
    $date_format = $this->mdl_settings->setting('date_format');

    $date_formats = date_formats();

    return $date_formats[$date_format]['setting'];
}

function date_format_datepicker()
{
    $date_format = $this->mdl_settings->setting('date_format');
    
    $date_formats = $this->date_formats();
    
    if (empty($date_format)){return $date_formats['d-m-Y']['datepicker'];}
    if (!empty($date_format)){return $date_formats[$date_format]['datepicker'];}
}

public function increment_user_date($date, $increment)
{
    $mysql_date = date_to_mysql($date);

    $new_date = new DateTime($mysql_date);
    $new_date->add(new DateInterval('P' . $increment));

    return $new_date->format($this->mdl_settings->setting('date_format'));
}

public function increment_date($date, $increment)
{
    $new_date = new DateTime($date);
    $new_date->add(new DateInterval('P' . $increment));
    return $new_date->format('Y-m-d');
}
}