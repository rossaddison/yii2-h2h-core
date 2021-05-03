<?php
namespace frontend\modules\invoice\application\models\ci;
 
use frontend\modules\invoice\application\models\Settings;
use yii\base\Component;
  
class Mdl_Settings extends Component
{
    public $settings = [];

    public function save($key, $value)
    {
        $s = Settings::find()->where(['=','setting_key',$key])->one();
        if (!empty($s)) {$s->setting_value = $value;
         $s->save();        
        } else {
            $newsetting = new Settings();
            $newsetting->setting_key = $key;
            $newsetting->setting_value = $value;
            $newsetting->save();        
        }       
    }
    
    public function getValue($key)
    {
        $s = Settings::find()->where(['=','setting_key',$key])->one();
        if (!empty($s) && !empty($s->setting_value)) {
            $g = $s->setting_value;
            return $g;
        }
        else return '';        
    }
    
    public function delete($key)
    {
        $s = Settings::find()->where(['=','setting_key',$key])->one();
        $s->delete();
    }
    
    public function load_settings()
    {
        $settings = Settings::find()->all();       
  
        foreach ($settings as $data) {
            $this->settings[$data->setting_key] = $data->setting_value;
        }        
    }

    public function get_setting($key, $default = '')
    {
        return (isset($this->settings[$key])) ? $this->settings[$key] : $default;
    }
    
    public function setting($key, $default = '')
    {
        return (isset($this->settings[$key])) ? $this->settings[$key] : $default;
    }    
    
    public function set_setting($key, $value)
    {
        $this->settings[$key] = $value;
    }
    
    public function expandDirectoriesMatrix($base_dir, $level = 0) {
    $directories = [];
    foreach(scandir($base_dir) as $file) {
        if($file == '.' || $file == '..') continue;
        $dir = $base_dir.DIRECTORY_SEPARATOR.$file;
        if(is_dir($dir)) {
            $directories[]= array(
                    'level' => $level,
                    'name' => $file,
                    'path' => $dir,
                    'children' => $this->expandDirectoriesMatrix($dir, $level +1)
            );
        }
    }
    return $directories;
    }
    
    public function check_select($value1, $value2 = null, $operator = '==', $checked = false)
    {
    $select = $checked ? 'checked="checked"' : 'selected="selected"';

    // Instant-validate if $value1 is a bool value
    if (is_bool($value1) && $value2 === null) {
        echo $value1 ? $select : '';
        return;
    }

    switch ($operator) {
        case '==':
            $echo_selected = $value1 == $value2 ? true : false;
            break;
        case '!=':
            $echo_selected = $value1 != $value2 ? true : false;
            break;
        case 'e':
            $echo_selected = empty($value1) ? true : false;
            break;
        case '!e':
            $echo_selected = empty($value1) ? true : false;
            break;
        default:
            $echo_selected = $value1 ? true : false;
            break;
    }

    echo $echo_selected ? $select : '';
    }
}
