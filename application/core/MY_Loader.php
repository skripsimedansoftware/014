<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage MY_Loader
 * @category   Libraries
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

require (APPPATH.'third_party/HMVC/Loader.php');

class MY_Loader extends \HMVC_Loader
{
	/**
	 * Load model
	 *
	 * @param      mixed             $model
	 * @param      string            $name
	 * @param      boolean           $db_conn
	 *
	 * @throws     RuntimeException
	 *
	 * @return     object
	 */
	public function model($model, $name = '', $db_conn = FALSE)
	{
		if (empty($model))
		{
			return $this;
		}
		elseif (is_array($model))
		{
			foreach ($model as $key => $value)
			{
				is_int($key) ? $this->model($value, '', $db_conn) : $this->model($key, $value, $db_conn);
			}

			return $this;
		}

		$path = '';

		// Is the model in a sub-folder? If so, parse out the filename and path.
		if (($last_slash = strrpos($model, '/')) !== FALSE)
		{
			// The path is in front of the last slash
			$path = substr($model, 0, ++$last_slash);

			// And the model name behind it
			$model = substr($model, $last_slash);
		}

		if (empty($name))
		{
			$name = $model;
		}

		if (in_array($name, $this->_ci_models, TRUE))
		{
			return $this;
		}

		$CI =& get_instance();

		if (isset($CI->$name))
		{
			throw new RuntimeException('The model name you are loading is the name of a resource that is already being used: '.$name);
		}

		if ($db_conn !== FALSE && ! class_exists('CI_DB', FALSE))
		{
			if ($db_conn === TRUE)
			{
				$db_conn = '';
			}

			$this->database($db_conn, FALSE, TRUE);
		}

		if (!class_exists('CI_Model', FALSE))
		{
			$app_path = APPPATH.'core'.DIRECTORY_SEPARATOR;

			if (file_exists($app_path.'Model.php'))
			{
				require_once ($app_path.'Model.php');

				if ( ! class_exists('CI_Model', FALSE))
				{
					throw new RuntimeException($app_path.'Model.php exists, but doesn\'t declare class CI_Model');
				}

				log_message('info', 'CI_Model class loaded');
			}
			elseif (!class_exists('CI_Model', FALSE))
			{
				require_once (BASEPATH.'core'.DIRECTORY_SEPARATOR.'Model.php');
			}

			$class = config_item('subclass_prefix').'Model';

			if (file_exists($app_path.$class.'.php'))
			{
				require_once ($app_path.$class.'.php');

				if (!class_exists('Angeli\\'.$class, FALSE))
				{
					throw new RuntimeException($app_path.$class.'.php exists, but doesn\'t declare class '.$class);
				}

				log_message('info', config_item('subclass_prefix').'Model class loaded');
			}
		}

		$this->helper('inflector');
		$model = str_replace(' ', '_', humanize($model));

		if (!class_exists('Angeli\\'.$model, FALSE))
		{
			foreach ($this->_ci_model_paths as $mod_path)
			{
				if (!file_exists($mod_path.'models/'.$path.$model.'.php'))
				{
					continue;
				}

				require_once ($mod_path.'models/'.$path.$model.'.php');

				if (!class_exists('Angeli\\'.$model, FALSE))
				{
					throw new RuntimeException($mod_path.'models/'.$path.$model.'.php exists, but doesn\'t declare class '.$model);
				}

				break;
			}

			if ( ! class_exists('Angeli\\'.$model, FALSE))
			{
				throw new RuntimeException('Unable to locate the model you have specified: '.$model);
			}
		}

		$this->_ci_models[] = $name;

		$model = 'Angeli\\'.$model;
		$model = new $model;
		$CI->$name = $model;

		log_message('info', 'Model "'.get_class($model).'" initialized');

		return $this;
	}
}

/* End of file MY_Loader.php */
/* Location: ./application/core/MY_Loader.php */
