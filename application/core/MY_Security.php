<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage MY_Security
 * @category   Libraries
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class MY_Security extends \CI_Security
{
	/**
	 * User password hash
	 *
	 * @param      string       $string  Password as string
	 * @param      string       $hash    Hashed password
	 *
	 * @return     bool|string  Boolean given if hash is not null
	 */
	public function user_password($string, $hash = NULL)
	{
		return empty($hash) ? password_hash($string, PASSWORD_DEFAULT) : password_verify($string, $hash);
	}
}

/* End of file MY_Security.php */
/* Location : ./application/core/MY_Security.php */
