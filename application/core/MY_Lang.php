<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage MY_Lang
 * @category   Libraries
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class MY_Lang extends \HMVC_Lang
{
	public $base;

	public $path;

	public $file;

	public $current;

	public function __construct()
	{
		parent::__construct();
		$this->base = config_item('language');
		$this->current = array_key_exists('language', $_COOKIE) ? $_COOKIE['language'] : $this->base;
		$this->set_path(config_item('language_path'));
	}

	/**
	 * Set custom language path
	 *
	 * @param      string  $path   Path to language directory
	 *
	 * @return     self
	 */
	public function set_path($path)
	{
		$this->path = realpath($path);
		return $this;
	}

	/**
	 * Get available user languages
	 *
	 * @return     array
	 */
	public function available()
	{
		$ci =& get_instance();
		$ci->load->helper('directory');

		if (!empty($this->path) && is_dir($this->path))
		{
			return array_values(array_filter(array_map(function($language){
				return rtrim(stripslashes($language), '/');
			}, array_keys(directory_map($this->path)))));
		}

		return FALSE;
	}

	/**
	 * Get system languages
	 *
	 * @return     array
	 */
	public function system()
	{
		$ci =& get_instance();
		$ci->load->helper('directory');

		return array_merge(array_values(array_filter(array_map(function($language){
			return rtrim(stripslashes($language), '/');
		}, array_keys(directory_map(BASEPATH.'language'))))));
	}

	/**
	 * Lookup user language or system language
	 *
	 * @param      string  $language  Language name
	 *
	 * @return     bool
	 */
	public function lookup($language)
	{
		return (in_array($language, $this->available()) OR in_array($language, $this->system()));
	}

	/**
	 * Get current language
	 *
	 * @return     string
	 */
	public function current()
	{
		$ci =& get_instance();

		$switch = $ci->input->get(config_item('language_query'));

		if (!empty($switch) && $this->lookup($switch))
		{
			$this->current = $switch;
		}

		return $this->current;
	}

	/**
	 * Switch language
	 *
	 * @param      string  $language
	 */
	public function switch($language = '')
	{
		$ci =& get_instance();

		if ($this->lookup($language))
		{
			log_message('info', 'Language switches to : '.$language);
			$this->current = $language;
		}
		else
		{
			$this->current = $this->base;
		}

		// set cookie language
		return $ci->input->set_cookie(array(
			'name'   => 'language',
			'value'  => $this->current(),
			'expire' => 86400,
			'path'   => '/',
			'secure' => FALSE
		));
	}

	/**
	 * Load a language file
	 *
	 * @param      mixed          $langfile    Language file name
	 * @param      string         $idiom       Language name (english, etc.)
	 * @param      bool           $return      Whether to return the loaded array of translations
	 * @param      bool           $add_suffix  Whether to add suffix to $langfile
	 * @param      string         $alt_path    Alternative path to look for the language file
	 * @param      string         $_module     Module name
	 *
	 * @return     void|string[]  Array containing translations, if $return is set to TRUE
	 */
	public function load($langfile, $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '', $_module = '')
	{
		$lang = array();

		if (is_array($langfile))
		{
			foreach ($langfile as $value)
			{
				$load = $this->load($value, $idiom, $return, $add_suffix, $alt_path);

				if ($return === TRUE)
				{
					$lang = array_merge($lang, $load);
				}
			}

			if ($return === TRUE)
			{
				return $lang;
			}

			return;
		}

		$found = FALSE;
		$filename = $langfile;
		$langfile = str_replace(['.php', '.json'], '', $langfile);

		$php_file = $this->filename($langfile, 'php', TRUE);
		$json_file = $this->filename($langfile, 'json', TRUE);

		if (empty($idiom) OR !preg_match('/^[a-z_-]+$/i', $idiom))
		{
			$idiom = $this->current();
		}

		/**
		 * Check language file is loaded (PHP)
		 */
		if ($return === FALSE && ($this->is_loaded($php_file, $idiom) OR $this->is_loaded($this->filename($langfile, 'php', FALSE), $idiom)))
		{
			log_message('info', 'Language PHP has been loaded : '.$idiom.'/'.$langfile);
			return;
		}

		/**
		 * Check language file is loaded (JSON)
		 */
		if ($return === FALSE && ($this->is_loaded($json_file, $idiom) OR $this->is_loaded($this->filename($langfile, 'json', FALSE), $idiom)))
		{
			log_message('info', 'Language JSON has been loaded : '.$idiom.'/'.$langfile);
			return;
		}

		$basepath = BASEPATH . 'language/' . $idiom . '/' . $php_file;

		if (($found = file_exists($basepath)) === TRUE)
		{
			log_message('info', 'Load language : BASEPATH/language/'.$idiom.'/'.$php_file);
			$this->set_loaded($php_file, $idiom);

			include ($basepath);
		}
		else
		{
			// load the default language first, if necessary
			// only do this for the language files under system/
			$basepath = SYSDIR . 'language/' . $this->base . '/' . $php_file;

			if (($found = file_exists($basepath)) === TRUE)
			{
				log_message('info', 'Load language : SYSDIR/language/'.$this->base.'/'.$php_file);
				$this->set_loaded($php_file, $this->base);

				include ($basepath);
			}
		}

		if (class_exists('Modules'))
		{
			$_module OR $_module = get_instance()->router->fetch_module();

			/**
			 * Find language file in : <module>/<language>/<idiom>/<filename><prefix_lang>.php
			 */
			foreach (Modules::find($php_file, $_module, 'language/'.$idiom.'/') as $path)
			{
				if ($path !== FALSE && $path !== $php_file && file_exists($path . $php_file))
				{
					$found = TRUE;

					log_message('info', 'Load language module : '.$_module.'/language/'.$idiom.'/'.$php_file);
					$this->set_loaded($php_file, $idiom);

					include ($path.$php_file);
				}
			}

			if ($found !== TRUE)
			{
				/**
				 * Find language file in : <module>/<language>/<idiom>/<filename>.php
				 */
				foreach (Modules::find($this->filename($langfile, 'php', FALSE), $_module, 'language/'.$idiom.'/') as $path)
				{
					if ($path !== FALSE && $path !== $this->filename($langfile, 'php', FALSE) && file_exists($path . $this->filename($langfile, 'php', FALSE)))
					{
						$found = TRUE;

						log_message('info', 'Load language module : '.$_module.'/language/'.$idiom.'/'.$this->filename($langfile, 'php', FALSE));
						$this->set_loaded($this->filename($langfile, 'php', FALSE), $idiom);

						include ($path.$this->filename($langfile, 'php', FALSE));
					}
				}
			}

			if ($found !== TRUE)
			{
				/**
				 * Find language file in : <module>/<language>/<idiom>/<filename><prefix_lang>.json
				 */
				foreach (Modules::find($json_file, $_module, 'language/'.$idiom.'/') as $path)
				{
					if ($path !== FALSE && $path !== $json_file && file_exists($path . $json_file))
					{
						$found = TRUE;

						log_message('info', 'Load language module : '.$_module.'/language/'.$idiom.'/'.$json_file);
						$this->set_loaded($json_file, $idiom);

						$lang = array_merge($lang, $this->load_from_json($path . $json_file));
					}
				}
			}

			if ($found !== TRUE)
			{
				/**
				 * Find language file in : <module>/<language>/<idiom>/<filename>.json
				 */
				foreach (Modules::find($this->filename($langfile, 'json', FALSE), $_module, 'language/'.$idiom.'/') as $path)
				{
					if ($path !== FALSE && $path !== $this->filename($langfile, 'json', FALSE) && file_exists($path . $this->filename($langfile, 'json', FALSE)))
					{
						$found = TRUE;

						log_message('info', 'Load language module : '.$_module.'/language/'.$idiom.'/'.$this->filename($langfile, 'json', FALSE));
						$this->set_loaded($this->filename($langfile, 'json', FALSE), $idiom);

						$lang = array_merge($lang, $this->load_from_json($path . $this->filename($langfile, 'json', FALSE)));
					}
				}
			}

			/**
			 * Find by base language
			 */

			if ($found !== TRUE)
			{
				/**
				 * Find language file in : <module>/<language>/<base_language>/<filename>.php
				 */
				foreach (Modules::find($php_file, $_module, 'language/'.$this->base.'/') as $path)
				{
					if ($path !== FALSE && $path !== $php_file && file_exists($path . $php_file))
					{
						$found = TRUE;

						log_message('info', 'Load language module : '.$_module.'/language/'.$this->base.'/'.$php_file);
						$this->set_loaded($php_file, $this->base);

						include ($path.$php_file);
					}
				}
			}

			if ($found !== TRUE)
			{
				/**
				 * Find language file in : <module>/<language>/<base_language>/<filename>.php
				 */
				foreach (Modules::find($this->filename($langfile, 'php', FALSE), $_module, 'language/'.$this->base.'/') as $path)
				{
					if ($path !== FALSE && $path !== $this->filename($langfile, 'php', FALSE) && file_exists($path . $this->filename($langfile, 'php', FALSE)))
					{
						$found = TRUE;

						log_message('info', 'Load language module : '.$_module.'/language/'.$this->base.'/'.$this->filename($langfile, 'php', FALSE));
						$this->set_loaded($this->filename($langfile, 'php', FALSE), $this->base);

						include ($path.$this->filename($langfile, 'php', FALSE));
					}
				}
			}

			if ($found !== TRUE)
			{
				/**
				 * Find language file in : <module>/<language>/<base_language>/<filename><prefix_lang>.json
				 */
				foreach (Modules::find($json_file, $_module, 'language/'.$this->base.'/') as $path)
				{
					if ($path !== FALSE && $path !== $json_file && file_exists($path . $json_file))
					{
						$found = TRUE;

						log_message('info', 'Load language module : '.$_module.'/language/'.$this->base.'/'.$json_file);
						$this->set_loaded($json_file, $this->base);

						$lang = array_merge($lang, $this->load_from_json($path . $json_file));
					}
				}
			}

			if ($found !== TRUE)
			{
				/**
				 * Find language file in : <module>/<language>/<base_language>/<filename>.json
				 */
				foreach (Modules::find($this->filename($langfile, 'json', FALSE), $_module, 'language/'.$this->base.'/') as $path)
				{
					if ($path !== FALSE && $path !== $this->filename($langfile, 'json', FALSE) && file_exists($path . $this->filename($langfile, 'json', FALSE)))
					{
						$found = TRUE;

						log_message('info', 'Load language module : '.$_module.'/language/'.$this->base.'/'.$this->filename($langfile, 'json', FALSE));
						$this->set_loaded($this->filename($langfile, 'json', FALSE), $this->base);

						$lang = array_merge($lang, $this->load_from_json($path . $this->filename($langfile, 'json', FALSE)));
					}
				}
			}
		}

		// Do we have an alternative path to look in?
		if ($alt_path !== '')
		{
			$has_found = $found;

			if ($found = file_exists($alt_path.DIRECTORY_SEPARATOR.'language/'.$idiom.'/'.$php_file))
			{
				log_message('info', 'Load language : '.$alt_path.'/language/'.$idiom.'/'.$php_file);
				$this->set_loaded($php_file, $idiom);

				include ($alt_path.DIRECTORY_SEPARATOR.'language/'.$idiom.'/'.$php_file);
			}
			elseif ($found = file_exists($alt_path.DIRECTORY_SEPARATOR.'language/'.$this->base.'/'.$php_file))
			{
				log_message('info', 'Load language : '.$alt_path.'/language/'.$this->base.'/'.$php_file);
				$this->set_loaded($php_file, $this->base);

				include ($alt_path.DIRECTORY_SEPARATOR.'language/'.$this->base.'/'.$php_file);
			}
			else
			{
				$found = $has_found;
			}
		}
		else
		{
			$has_found = $found;

			foreach (get_instance()->load->get_package_paths(TRUE) as $package_path)
			{
				$package_path = realpath($package_path);

				if ($package_path !== FALSE && $package_path !== realpath(BASEPATH))
				{
					$package_path .= DIRECTORY_SEPARATOR;

					// <idiom>/<filename><prefix_lang>.php
					if ($found = file_exists($package_path.'language/' . $idiom . '/' . $php_file))
					{
						log_message('info', 'Load language : '.$package_path.'/language/'.$idiom.'/'.$php_file);
						$this->set_loaded($php_file, $idiom);

						include ($package_path.'language/' . $idiom . '/' . $php_file);
						break;
					}
					// <idiom>/<filename>.php
					elseif ($found = file_exists($package_path.'language/' . $idiom . '/' . $this->filename($langfile, 'php', FALSE)))
					{
						log_message('info', 'Load language : '.$package_path.'/language/'.$idiom.'/'.$this->filename($langfile, 'php', FALSE));
						$this->set_loaded($this->filename($langfile, 'php', FALSE), $idiom);

						include ($package_path.'language/' . $idiom . '/' . $this->filename($langfile, 'php', FALSE));
						break;
					}
					// <base_language>/<filename><prefix_lang>.php
					elseif ($found = file_exists($package_path.'language/' . $this->base . '/' . $php_file))
					{
						log_message('info', 'Load language : '.$package_path.'/language/'.$this->base.'/'.$php_file);
						$this->set_loaded($php_file, $this->base);

						include ($package_path.'language/' . $this->base . '/' . $php_file);
						break;
					}
					// <base_language>/<filename>.php
					elseif ($found = file_exists($package_path.'language/' . $this->base . '/' . $this->filename($langfile, 'php', FALSE)))
					{
						log_message('info', 'Load language : '.$package_path.'/language/'.$this->base.'/'.$this->filename($langfile, 'php', FALSE));
						$this->set_loaded($this->filename($langfile, 'php', FALSE), $this->base);

						include ($package_path.'language/' . $this->base . '/' . $this->filename($langfile, 'php', FALSE));
						break;
					}
					// <idiom>/<filename><prefix_lang>.json
					elseif ($found = file_exists($package_path.'language/' . $idiom . '/' . $json_file))
					{
						log_message('info', 'Load language : '.$package_path.'/language/'.$idiom.'/'.$json_file);
						$this->set_loaded($json_file, $idiom);

						$lang = array_merge($lang, $this->load_from_json($package_path.'language/' . $idiom . '/' . $json_file));
						break;
					}
					// <idiom>/<filename>.json
					elseif ($found = file_exists($package_path.'language/' . $idiom . '/' . $this->filename($langfile, 'json', FALSE)))
					{
						log_message('info', 'Load language : '.$package_path.'/language/'.$idiom.'/'.$this->filename($langfile, 'json', FALSE));
						$this->set_loaded($this->filename($langfile, 'json', FALSE), $idiom);

						$lang = array_merge($lang, $this->load_from_json($package_path.'language/' . $idiom . '/' . $this->filename($langfile, 'json', FALSE)));
						break;
					}
					// <base_language>/<filename><prefix_lang>.json
					elseif ($found = file_exists($package_path.'language/' . $this->base . '/' . $json_file))
					{
						log_message('info', 'Load language : '.$package_path.'/language/'.$this->base.'/'.$json_file);
						$this->set_loaded($json_file, $this->base);

						$lang = array_merge($lang, $this->load_from_json($package_path.'language/' . $this->base . '/' . $json_file));
						break;
					}
					// <base_language>/<filename>.json
					elseif ($found = file_exists($package_path.'language/' . $this->base . '/' . $this->filename($langfile, 'json', FALSE)))
					{
						log_message('info', 'Load language : '.$package_path.'/language/'.$this->base.'/'.$this->filename($langfile, 'json', FALSE));
						$this->set_loaded($this->filename($langfile, 'json', FALSE), $this->base);

						$lang = array_merge($lang, $this->load_from_json($package_path.'language/' . $this->base . '/' . $this->filename($langfile, 'json', FALSE)));
						break;
					}
					else
					{
						$found = $has_found;
					}
				}
			}
		}

		if (is_dir($this->path))
		{
			$has_found = $found;

			// <idiom>/<filename><prefix_lang>.json
			if ($found = file_exists($this->path . DIRECTORY_SEPARATOR . $idiom . '/' . $json_file))
			{
				log_message('info', 'Load language : '.$this->path . DIRECTORY_SEPARATOR . $idiom.'/'.$json_file);
				$this->set_loaded($json_file, $idiom);

				$lang = array_merge($lang, $this->load_from_json($this->path . DIRECTORY_SEPARATOR . $idiom . '/' . $json_file));
			}
			// <idiom>/<filename>.json
			elseif ($found = file_exists($this->path . DIRECTORY_SEPARATOR . $idiom . '/' . $this->filename($langfile, 'json', FALSE)))
			{
				log_message('info', 'Load language : '.$this->path . DIRECTORY_SEPARATOR . $idiom.'/'.$this->filename($langfile, 'json', FALSE));
				$this->set_loaded($this->filename($langfile, 'json', FALSE), $idiom);

				$lang = array_merge($lang, $this->load_from_json($this->path . DIRECTORY_SEPARATOR . $idiom . '/' . $this->filename($langfile, 'json', FALSE)));
			}
			// <base_language>/<filename><prefix_lang>.json
			elseif ($found = file_exists($this->path . DIRECTORY_SEPARATOR . $this->base . '/' . $json_file))
			{
				log_message('info', 'Load language : '.$this->path . DIRECTORY_SEPARATOR . $this->base.'/'.$json_file);
				$this->set_loaded($json_file, $this->base);

				$lang = array_merge($lang, $this->load_from_json($this->path . DIRECTORY_SEPARATOR . $this->base . '/' . $json_file));
			}
			// <base_language>/<filename>.json
			elseif ($found = file_exists($this->path . DIRECTORY_SEPARATOR . $this->base . '/' . $this->filename($langfile, 'json', FALSE)))
			{
				log_message('info', 'Load language : '.$this->path . DIRECTORY_SEPARATOR . $this->base.'/'.$this->filename($langfile, 'json', FALSE));
				$this->set_loaded($this->filename($langfile, 'json', FALSE), $this->base);

				$lang = array_merge($lang, $this->load_from_json($this->path . DIRECTORY_SEPARATOR . $this->base . '/' . $this->filename($langfile, 'json', FALSE)));
			}
			else
			{
				$found = $has_found;
			}
		}

		if ($found !== TRUE)
		{
			show_error('Unable to load the requested language file: language/'.$idiom.'/'.$langfile);
		}

		if (!isset($lang) OR !is_array($lang))
		{
			if ($found)
			{
				log_message('error', 'Language file contains no data: language/' . $idiom . '/' . $filename);
			}

			if ($return === TRUE)
			{
				return array();
			}

			return;
		}

		if ($return === TRUE)
		{
			return $lang;
		}

		$this->language = array_merge($this->language, $lang);

		return TRUE;
	}

	/**
	 * Set file name
	 *
	 * @param      string  $name    File name
	 * @param      string  $ext     Extension
	 * @param      bool    $suffix  Using suffix _lang
	 *
	 * @return     string
	 */
	public function filename($name, $ext = '', $suffix = FALSE)
	{
		if (filter_var($suffix, FILTER_VALIDATE_BOOLEAN))
		{
			$name = preg_replace('/_lang$/', '', $name).'_lang';
		}

		return $name.'.'.$ext;
	}

	/**
	 * Set loaded file
	 *
	 * @param      string  $file   File name with extension
	 * @param      string  $idiom  Language name
	 *
	 * @return     self
	 */
	public function set_loaded($file, $idiom)
	{
		$this->is_loaded[$file] = $idiom;

		// set loaded file languages
		if (!is_array($this->file))
		{
			$this->file = array();
		}

		if (array_key_exists($file, $this->file))
		{
			if (!array_key_exists($idiom, $this->file[$file]))
			{
				$this->file[$file] = array_merge($this->file[$file], array($idiom));
			}
		}
		else
		{
			$this->file[$file] = array($idiom);
		}

		return $this;
	}

	/**
	 * Check is loaded file
	 *
	 * @param      string  $file   File name with extension
	 * @param      string  $idiom  Language name
	 *
	 * @return     bool
	 */
	public function is_loaded($file, $idiom = NULL)
	{
		if (!empty($idiom))
		{
			return (array_key_exists($file, $this->is_loaded) && $this->is_loaded[$file] == $idiom);
		}
		else
		{
			return array_key_exists($file, $this->is_loaded);
		}
	}

	/**
	 * Load language from .json
	 *
	 * @param      string  $langfile
	 *
	 * @return     array
	 */
	public function load_from_json($langfile)
	{
		$lang = array();
		$content = file_get_contents($langfile);

		if (!empty($content) && $this->valid_json($content))
		{
			$lang = json_decode($content, TRUE);
		}

		return $lang;
	}

	/**
	 * Fetches a single line of text from the language
	 * array with PHP DotNotation
	 *
	 * @param      string  $line        Language key
	 * @param      bool    $log_errors  Whether to log an error message if the
	 *                                  line is not found
	 *
	 * @return     string
	 */
	public function line($line, $log_errors = TRUE)
	{
		$dot = dot($this->language);
		return ($dot->has($line) ? $dot->get($line) : $line);
	}

	/**
	 * Is valid json file
	 *
	 * @param      string  $json   JSON
	 *
	 * @return     bool
	 */
	private function valid_json($json)
	{
		json_decode($json);
		return (json_last_error() == JSON_ERROR_NONE);
	}
}

/* End of file MY_Lang.php */
/* Location : ./application/core/MY_Lang.php */
