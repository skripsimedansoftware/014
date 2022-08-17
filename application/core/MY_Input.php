<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage MY_Input
 * @category   Libraries
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class MY_Input extends \CI_Input
{
	/**
	 * Check if $_POST[key] is empty to set default value
	 *
	 * @param      string  $index      Index for item to be fetched from $_POST
	 * @param      mixed   $default    Set default value if property value is
	 *                                 empty
	 * @param      bool    $xss_clean  Whether to apply XSS filtering
	 *
	 * @return     mixed
	 */
	public function empty_post($index, $default = NULL, $xss_clean = NULL)
	{
		if (empty($this->post($index)))
		{
			$_POST[$index] = $default;
		}

		return $this->post($index, $xss_clean);
	}

	/**
	 * Check if $_GET[key] is empty to set default value
	 *
	 * @param      string  $index      Index for item to be fetched from $_GET
	 * @param      mixed   $default    Set default value if property value is
	 *                                 empty
	 * @param      bool    $xss_clean  Whether to apply XSS filtering
	 *
	 * @return     mixed
	 */
	public function empty_get($index, $default = NULL, $xss_clean = NULL)
	{
		if (empty($this->get($index)))
		{
			$_GET[$index] = $default;
		}

		return $this->get($index, $xss_clean);
	}

	/**
	 * Check if $_POST[key] or $_GET[key] is empty to set default value
	 *
	 * @param      string  $index      Index for item to be fetched from $_POST
	 *                                 or $_GET
	 * @param      mixed   $default    Set default value if property value is
	 *                                 empty
	 * @param      bool    $xss_clean  Whether to apply XSS filtering
	 *
	 * @return     mixed
	 */
	public function empty_post_get($index, $default = NULL, $xss_clean = NULL)
	{
		if (empty($this->post_get($index)))
		{
			return $default;
		}

		return $this->post_get($index, $xss_clean);
	}

	/**
	 * Check if $_GET[key] or $_POST[key] is empty to set default value
	 *
	 * @param      string  $index      Index for item to be fetched from $_POST
	 *                                 or $_GET
	 * @param      mixed   $default    Set default value if property value is
	 *                                 empty
	 * @param      bool    $xss_clean  Whether to apply XSS filtering
	 *
	 * @return     mixed
	 */
	public function empty_get_post($index, $default = NULL, $xss_clean = NULL)
	{
		if (empty($this->get_post($index)))
		{
			return $default;
		}

		return $this->get_post($index, $xss_clean);
	}
}

/* End of file MY_Input.php */
/* Location : ./application/core/MY_Input.php */
