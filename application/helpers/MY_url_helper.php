<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage MY_URL
 * @category   Helpers
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @param      string      $uri
 * @param      array|bool  $query_string
 * @param      string      $protocol
 *
 * @return     string
 */
function site_url($uri = '', $query_string = FALSE, $protocol = NULL)
{
	$ci =& get_instance();

	if (is_array($query_string))
	{
		return $ci->config->site_url($uri, $protocol).create_http_build_query($query_string);
	}
	else
	{
		return $ci->config->site_url($uri, $protocol).(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?create_http_build_query():FALSE);
	}
}

/**
 * Base URL
 *
 * Create a local URL based on your basepath. Segments can be passed in as a
 * string or an array, same as site_url or a URL to a file can be passed in,
 * e.g. to an image file.
 *
 * @param      string      $uri
 * @param      array|bool  $query_string
 * @param      string      $protocol
 *
 * @return     string
 */
function base_url($uri = '', $query_string = FALSE, $protocol = NULL)
{
	$ci =& get_instance();

	if (is_array($query_string))
	{
		return $ci->config->base_url($uri, $protocol).create_http_build_query($query_string);
	}
	else
	{
		return $ci->config->base_url($uri, $protocol).(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?create_http_build_query():FALSE);
	}
}

/**
 * Get current URL
 *
 * @param      array|boolean  $query_string  Include current query string or
 *                                           build query string
 * @param      bool           $merge_query   Merge query
 * @param      bool           $site_url      Return format with site_url()
 *
 * @return     string
 */
function current_url($query_string = TRUE, $merge_query = TRUE, $site_url = FALSE)
{
	if (is_array($query_string))
	{
		if ($site_url)
		{
			return site_url(!empty(uri_string())?uri_string():'').create_http_build_query($query_string, $merge_query);
		}
		else
		{
			return base_url(!empty(uri_string())?uri_string().config_item('url_suffix'):'').create_http_build_query($query_string, $merge_query);
		}
	}
	else
	{
		if ($site_url)
		{
			return site_url(!empty(uri_string())?uri_string():'').(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?create_http_build_query(array(), $merge_query):FALSE);
		}
		else
		{
			return base_url(!empty(uri_string())?uri_string().config_item('url_suffix'):'').(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?create_http_build_query(array(), $merge_query):FALSE);
		}
	}
}

if (!function_exists('module_link'))
{
	/**
	 * Module link
	 *
	 * @param      string      $path          Append the path
	 * @param      array|bool  $query_string  Use $_GET query
	 * @param      bool        $site_url      Return format with site_url()
	 *
	 * @return     string
	 */
	function module_link($path = NULL, $query_string = FALSE, $site_url = FALSE)
	{
		$ci =& get_instance();
		$path = (!empty($path))?$path:'';
		$module = (!empty($ci->router->fetch_module()))?$ci->router->fetch_module():$ci->router->fetch_class();

		if ($site_url)
		{
			return reduce_double_slashes(site_url($module.'/'.$path, $query_string));
		}
		else
		{
			return reduce_double_slashes(base_url($module.'/'.$path, $query_string));
		}
	}
}

if (!function_exists('create_http_build_query'))
{
	/**
	 * Create HTTP build query
	 *
	 * @param      array   $query        Build query string
	 * @param      bool    $merge_query  Merge query string
	 *
	 * @return     string
	 */
	function create_http_build_query($query = array(), $merge_query = TRUE)
	{
		$ci =& get_instance();

		if (!empty($ci->input->get()))
		{
			$query = ($merge_query) ? array_merge($ci->input->get(), $query) : $query;
		}

		return (!empty($query))?'?'.http_build_query($query):FALSE;
	}
}

if (!function_exists('matches_request'))
{
	/**
	 * Matches request
	 *
	 * @param      string|array  $module       Module name
	 * @param      string|array  $class        Class name
	 * @param      string|array  $method       Method name
	 * @param      string|array  $uri_segment  URI segment
	 * @param      string|array  $get          $_GET parameter
	 *
	 * @return     bool
	 */
	function matches_request($module = FALSE, $class = FALSE, $method = FALSE, $uri_segment = FALSE, $get = FALSE)
	{
		$matches_request = 0;

		$params_count = 0;

		$ci =& get_instance();

		if ($module !== FALSE OR !empty($module))
		{
			$params_count = $params_count += 1;

			if (is_array($module))
			{
				if (in_array($ci->router->fetch_module(), $module))
				{
					$matches_request = $matches_request += 1;
				}
			}
			else
			{
				if ($module == $ci->router->fetch_module())
				{
					$matches_request = $matches_request += 1;
				}
			}
		}

		if ($class !== FALSE OR !empty($class))
		{
			$params_count = $params_count += 1;

			if (is_array($class))
			{
				if (in_array($ci->router->fetch_class(), $class))
				{
					$matches_request = $matches_request += 1;
				}
			}
			else
			{
				if ($class == $ci->router->fetch_class())
				{
					$matches_request = $matches_request += 1;
				}
			}
		}

		if ($method !== FALSE OR !empty($method))
		{
			$params_count = $params_count += 1;

			if (is_array($method))
			{
				if (in_array($ci->router->fetch_method(), $method))
				{
					$matches_request = $matches_request += 1;
				}
			}
			else
			{
				if ($method == $ci->router->fetch_method())
				{
					$matches_request = $matches_request += 1;
				}
			}
		}

		if ($uri_segment !== FALSE OR !empty($uri_segment))
		{
			$params_count = $params_count += 1;

			if (is_array($uri_segment))
			{
				if (is_array($uri_segment['match']))
				{
					if (in_array($uri_segment['match'], $uri_segment['find']))
					{
						$matches_request = $matches_request += 1;
					}
				}
				else
				{
					if ($ci->uri->segment($uri_segment['find']) == $uri_segment['match'])
					{
						$matches_request = $matches_request += 1;
					}
				}
			}
		}

		if ($get !== FALSE OR !empty($get))
		{
			if (is_array($get) && !empty($get))
			{
				$match_count = count($get);
				$match_total = 0;

				$params_count = $params_count += 1;

				if (is_associative_array($get))
				{
					foreach ($get as $key => $val)
					{
						$match_total = ($ci->input->get($key) == $val ? $match_total += 1 : $match_total);
					}
				}
				else
				{
					foreach ($get as $key)
					{
						$match_total = (isset($_GET[$key]) ? $match_total += 1 : $match_total);
					}
				}

				$matches_request = ($match_count == $match_total ? $matches_request += 1 : $matches_request);
			}
		}

		return ($matches_request == $params_count);
	}
}

/* End of file MY_url_helper.php */
/* Location : ./application/helpers/MY_url_helper.php */
