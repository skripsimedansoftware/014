<?php
/**
 * @package    Angeli\User
 * @subpackage User
 * @category   Model
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class User extends MY_Model
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->set_table('user');
	}

	/**
	 * Find user
	 *
	 * @param      string  $identity  Identity
	 *
	 * @return     object  CI_DB_mysqli_result
	 */
	public function find($identity)
	{
		$this->db
		->group_start()
			->where('email', $identity)
			->or_group_start()
				->where('username', $identity)
			->group_end()
		->group_end();

		$find = $this->db->get('user');

		if ($find->num_rows() >= 1)
		{
			return $find;
		}

		return FALSE;
	}

	/**
	 * Sign in
	 *
	 * @param      string  $identity  Identity
	 * @param      string  $password  Password
	 *
	 * @return     object  CI_DB_mysqli_result
	 */
	public function sign_in($identity, $password)
	{
		$this->db
		->group_start()
			->where('email', $identity)
			->or_group_start()
				->where('username', $identity)
			->group_end()
		->group_end();

		$sign_in = $this->db->get('user');

		if ($sign_in->num_rows() >= 1 && $this->security->user_password($password, $sign_in->row()->password))
		{
			return $sign_in;
		}

		return FALSE;
	}
}

/* End of file User.php */
/* Location : ./application/models/User.php */
