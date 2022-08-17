<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage User
 * @category   Helper
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

if (!function_exists('user_session'))
{
	/**
	 * User sesion
	 *
	 * @param      string  $field  Field name
	 */
	function user_session($field = NULL, $default_value = NULL)
	{
		$ci =& get_instance();

		if ($ci->session->has_userdata('user'))
		{
			$user = $ci->user->get_where(array('id' => $ci->__user_session()))->row_array();

			if (!empty($field))
			{
				return isset($user[$field]) ? (!empty($user[$field]) ? $user[$field] : $default_value) : $default_value;
			}
			else
			{
				return $user;
			}
		}

		return FALSE;
	}
}

/* End of file user_helper.php */
/* Location : ./user/helpers/user_helper.php */
