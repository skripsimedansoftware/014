<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage MY_Language
 * @category   Helpers
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

if (!function_exists('load_language'))
{
	/**
	 * Load language
	 *
	 * @param      array|string  $langfile    Language file
	 * @param      string        $idiom       Language name
	 * @param      bool          $return      Return loaded file
	 * @param      bool          $add_suffix  _lang suffix
	 * @param      string        $alt_path    Load alternate path
	 *
	 * @return     bool|array
	 */
	function load_language($langfile, $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '')
	{
		$ci =& get_instance();
		return $ci->lang->load($langfile, $idiom, $return, $add_suffix, $alt_path);
	}
}

if (!function_exists('current_language'))
{
	/**
	 * Get current language
	 *
	 * @return     string
	 */
	function current_language()
	{
		$ci =& get_instance();
		return $ci->lang->current();
	}
}

if (!function_exists('available_language'))
{
	/**
	 * Get available user language
	 *
	 * @return     array
	 */
	function available_language()
	{
		$ci =& get_instance();
		return $ci->lang->available();
	}
}

if (!function_exists('system_language'))
{
	/**
	 * Get available system language
	 *
	 * @return     array
	 */
	function system_language()
	{
		$ci =& get_instance();
		return $ci->lang->system();
	}
}

if (!function_exists('language_lookup'))
{
	/**
	 * Language lookup
	 *
	 * @param      string  $language  Languaage name
	 *
	 * @return     bool
	 */
	function language_lookup($language = 'english')
	{
		$ci =& get_instance();
		return $ci->lang->lookup($language);
	}
}

if (!function_exists('translate'))
{
	/**
	 * Translate key of language
	 *
	 * @param      string        $key      Language key
	 * @param      string|array  $search   Search for replace
	 * @param      string|array  $replace  Replace translation string
	 *
	 * @return     string
	 */
	function translate($key, $search = NULL, $replace = NULL)
	{
		return (!empty($search)) ? str_replace($search, $replace, lang($key)) : lang($key);
	}
}

if (!function_exists('lang_iso_639_1'))
{
	/**
	 * Language ISO 639-1
	 *
	 * @param      string  $lang   Language (in english)
	 *
	 * @return     string
	 */
	function lang_iso_639_1($lang)
	{
		switch (strtolower($lang))
		{
			case 'arabic':
				return 'ar';
			break;

			case 'armenian':
				return 'hy';
			break;

			case 'azerbaijani':
				return 'az';
			break;

			case 'basque':
				return 'eu';
			break;

			case 'bosnian':
				return 'bs';
			break;

			case 'bulgarian':
				return 'bg';
			break;

			case 'catalan':
				return 'ca';
			break;

			case 'chinese':
				return 'zh';
			break;

			case 'croatian':
				return 'hr';
			break;

			case 'czech':
				return 'cs';
			break;

			case 'danish':
				return 'da';
			break;

			case 'dutch':
				return 'nl';
			break;

			case 'english':
				return 'en';
			break;

			case 'finnish':
				return 'fi';
			break;

			case 'french':
				return 'fr';
			break;

			case 'german':
				return 'de';
			break;

			case 'greek':
				return 'el';
			break;

			case 'gujarati':
				return 'gu';
			break;

			case 'hindi':
				return 'hi';
			break;

			case 'hungarian':
				return 'hu';
			break;

			case 'indonesian':
				return 'id';
			break;

			case 'italian':
				return 'it';
			break;

			case 'japanese':
				return 'ja';
			break;

			case 'khmer':
				return 'km';
			break;

			case 'korean':
				return 'ko';
			break;

			case 'lithuanian':
				return 'lt';
			break;

			case 'marathi':
				return 'mr';
			break;

			case 'norwegian':
				return 'no';
			break;

			case 'polish':
				return 'pl';
			break;

			case 'portuguese':
				return 'pt';
			break;

			case 'romanian':
				return 'ro';
			break;

			case 'russian':
				return 'ru';
			break;

			case 'serbian':
				return 'sr';
			break;

			case 'slovak':
				return 'sk';
			break;

			case 'slovenian':
				return 'sl';
			break;

			case 'spanish':
				return 'es';
			break;

			case 'swedish':
				return 'sv';
			break;

			case 'tamil':
				return 'ta';
			break;

			case 'thai':
				return 'th';
			break;

			case 'turkish':
				return 'tr';
			break;

			case 'ukrainian':
				return 'uk';
			break;

			case 'urdu':
				return 'ur';
			break;

			case 'vietnamese':
				return 'vi';
			break;

			/**
			 * https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
			 */
			case 'filipino':
				return 'tl';
			break;

			case 'portuguese-brazilian':
				return 'pt';
			break;

			case 'simplified-chinese':
				return 'zh-Hans';
			break;

			case 'traditional-chinese':
				return 'zh-Hant';
			break;

			default:
				return 'en';
			break;
		}
	}
}

/* End of file MY_language_helper.php */
/* Location : ./application/helpers/MY_language_helper.php */
