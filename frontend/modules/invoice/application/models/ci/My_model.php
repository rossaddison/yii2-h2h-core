<?php
namespace frontend\modules\invoice\application\models\ci;
use Yii;
use frontend\modules\invoice\application\helpers\FormHelper;
use frontend\modules\invoice\application\libraries\FormValidation;
use yii\base\Component;

class My_model extends Component
{
    public $table;

    public $primary_key;

    public $default_limit = 15;

    public $page_links;

    public $query;

    public $form_values = [];

    public $validation_errors;

    public $total_rows;

    public $date_created_field;

    public $date_modified_field;

    public $native_methods = [
        'select',
        'select_max',
        'select_min',
        'select_avg',
        'select_sum',
        'join',
        'where',
        'or_where',
        'where_in',
        'or_where_in',
        'where_not_in',
        'or_where_not_in',
        'like',
        'or_like',
        'not_like',
        'or_not_like',
        'group_by',
        'distinct',
        'having',
        'or_having',
        'order_by',
        'limit',
    ];

    public $total_pages = 0;

    public $current_page;

    public $next_page;

    public $previous_page;

    public $offset;

    public $next_offset;

    public $previous_offset;

    public $last_offset;

    public $id;

    public $filter = [];
    
    //yii2
    protected static $modelname;
    //yii2
    public $db;
    
    protected $default_validation_rules = 'validation_rules';

    protected $validation_rules;
    
    //yii2
    public function init()
    {
       $this->db = Yii::$app->db;
       
    }
        
    public function __call($name, $arguments)
    {
        if (substr($name, 0, 7) == 'filter_') {
            $this->filter[] = [substr($name, 7), $arguments];
        } else {
            call_user_func_array([Yii::$app->db, $name], $arguments);
        }
        return $this;
    }
    
    public function get($include_defaults = true)
    {
        if ($include_defaults) {
            $this->set_defaults();
        }

        $this->run_filters();
        
        //https://www.php.net/manual/en/language.oop5.late-static-bindings.php
        $modelname = $this->modelname;
        $this->query = $modelname::find();

        $this->filter = [];

        return $this;
    }

    private function set_defaults($exclude = [])
    {
        $native_methods = $this->native_methods;

        foreach ($exclude as $unset_method) {
            unset($native_methods[array_search($unset_method, $native_methods)]);
        }

        foreach ($native_methods as $native_method) {
            $native_method = 'default_' . $native_method;

            if (method_exists($this, $native_method)) {
                $this->$native_method();
            }
        }
    }

    private function run_filters()
    {
        foreach ($this->filter as $filter) {
            call_user_func_array([Yii::$app->db, $filter[0]], $filter[1]);
        }

        $this->filter = [];
    }
    
    public function db_array()
    {
        $db_array = [];

        $validation_rules = $this->{$this->validation_rules}();

        foreach ($this->input->post() as $key => $value) {
            if (array_key_exists($key, $validation_rules)) {
                $db_array[$key] = $value;
            }
        }

        return $db_array;
    }

    public function delete($id)
    {
        $modelname = $this->modelname;
        $row = $modelname::find()->where(['=',$this->primary_key,$id])->one();
        $row->delete();
    }

    public function row($id)
    {
        $modelname = $this->modelname;
        $row = $modelname::find()->where(['=',$this->primary_key,$id])->one();
        return $row;
    }

    public function result_array()
    {
        return $this->query->result_array();
    }

    public function row_array()
    {
        return $this->query->row_array();
    }

    public function num_rows()
    {
        $modelname = $this->modelname;
        $count = $modelname::find()->count();
        return $count;
    }

    public function prep_form($id = null)
    {
        if (!$_POST && $id) {
            $row = $this->get_by_id($id);

            if ($row) {
                foreach ($row as $key => $value) {
                    $this->form_values[$key] = $value;
                }

                return true;
            }

            return false;
        } elseif (!$id) {
            return true;
        }
    }

    public function get_by_id($id)
    {
        $modelname = $this->modelname;
        $row = $modelname::find()->where(['=',$this->primary_key,$id])->one();
        return $row;
    }

    public function run_validation($validation_rules = null)
    {
        if (!$validation_rules) {
            $validation_rules = $this->default_validation_rules;
        }

        foreach (array_keys(Yii::$app->request->post()) as $key) {
            $this->form_values[$key] = Yii::$app->request->post($key);
        }

        if (method_exists($this, $validation_rules)) {
            $this->validation_rules = $validation_rules;

            $form_validation = new FormValidation();
            $form_helper = new FormHelper();
            
            $form_validation->set_rules($form_helper->$validation_rules());
            
            $run = $form_validation->run();

            $this->validation_errors = $form_helper->validation_errors();

            return $run;
        }               
    }
    
    public function save($id = null, $db_array = null)
    {
        if (!$db_array) {
            $db_array = $this->db_array();
        }

        $datetime = date('Y-m-d H:i:s');

        if (!$id) {
            if ($this->date_created_field) {
                if (is_array($db_array)) {
                    $db_array[$this->date_created_field] = $datetime;

                    if ($this->date_modified_field) {
                        $db_array[$this->date_modified_field] = $datetime;
                    }
                } else {
                    $db_array->{$this->date_created_field} = $datetime;

                    if ($this->date_modified_field) {
                        $db_array->{$this->date_modified_field} = $datetime;
                    }
                }
            } elseif ($this->date_modified_field) {
                if (is_array($db_array)) {
                    $db_array[$this->date_modified_field] = $datetime;
                } else {
                    $db_array->{$this->date_modified_field} = $datetime;
                }
            }
            
            //save the new record    
            $modelname = $this->modelname;
            $row = new $modelname();
            //save the array
            foreach ($db_array as $key => $value)
            {
                $row->$key = $value;
            }
            $row->save();
            return $row->$id;

        } else {
            if ($this->date_modified_field) {
                if (is_array($db_array)) {
                    $db_array[$this->date_modified_field] = $datetime;
                } else {
                    $db_array->{$this->date_modified_field} = $datetime;
                }
            }
        
        //update the record    
        $modelname = $this->modelname;
        $row = $modelname::find()->where(['=',$this->primary_key,$id])->one();
        //save the array
        foreach ($db_array as $key => $value)
        {
            $row->$key = $value;
        }
        $row->save();
        return $row->$id;
      }
    }

    public function form_value($key, $escape = false)
    {
        $value = isset($this->form_values[$key]) ? $this->form_values[$key] : '';
        return $escape ? htmlspecialchars($value) : $value;
    }

    public function set_form_value($key, $value)
    {
        $this->form_values[$key] = $value;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }
    
    public function set_rules($field, $label = '', $rules = array(), $errors = array())
    {
		// No reason to set rules if we have no POST data
		// or a validation array has not been specified
		if (empty(Yii::$app->request->post()) && empty($this->validation_data))
		{
			return $this;
		}

		// If an array was passed via the first parameter instead of individual string
		// values we cycle through it and recursively call this function.
		if (is_array($field))
		{
			foreach ($field as $row)
			{
				// Houston, we have a problem...
				if ( ! isset($row['field'], $row['rules']))
				{
					continue;
				}

				// If the field label wasn't passed we use the field name
				$label = isset($row['label']) ? $row['label'] : $row['field'];

				// Add the custom error message array
				$errors = (isset($row['errors']) && is_array($row['errors'])) ? $row['errors'] : array();

				// Here we go!
				$this->set_rules($row['field'], $label, $row['rules'], $errors);
			}

			return $this;
		}

		// No fields or no rules? Nothing to do...
		if ( ! is_string($field) OR $field === '' OR empty($rules))
		{
			return $this;
		}
		elseif ( ! is_array($rules))
		{
			// BC: Convert pipe-separated rules string to an array
			if ( ! is_string($rules))
			{
				return $this;
			}

			$rules = preg_split('/\|(?![^\[]*\])/', $rules);
		}

		// If the field label wasn't passed we use the field name
		$label = ($label === '') ? $field : $label;

		$indexes = array();

		// Is the field name an array? If it is an array, we break it apart
		// into its components so that we can fetch the corresponding POST data later
		if (($is_array = (bool) preg_match_all('/\[(.*?)\]/', $field, $matches)) === TRUE)
		{
			sscanf($field, '%[^[][', $indexes[0]);

			for ($i = 0, $c = count($matches[0]); $i < $c; $i++)
			{
				if ($matches[1][$i] !== '')
				{
					$indexes[] = $matches[1][$i];
				}
			}
		}

		// Build our master array
		$this->_field_data[$field] = array(
			'field'		=> $field,
			'label'		=> $label,
			'rules'		=> $rules,
			'errors'	=> $errors,
			'is_array'	=> $is_array,
			'keys'		=> $indexes,
			'postdata'	=> NULL,
			'error'		=> ''
		);

		return $this;
	}
}
