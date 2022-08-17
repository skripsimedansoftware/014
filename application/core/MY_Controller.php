<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage MY_Controller
 * @category   Libraries
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * User session
	 */
	public function __user_session()
	{
		if ($this->session->has_userdata('user'))
		{
			$this->__current_user_session();
			return $this->session->userdata('user');
		}

		return FALSE;
	}

	/**
	 * Current user session
	 */
	public function __current_user_session()
	{
		$user = $this->user->get_where(array('id' => $this->session->userdata('user')));

		if ($user->num_rows() > 0)
		{
			$user = $user->row_array();
			$this->load->vars('user_session', $user);
		}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}

	/**
	 * Authenticated module
	 */
	public function authenticated_module($except_methods = array(), $callback = NULL)
	{
		// Not have user session?
		if ($this->__user_session() === FALSE)
		{
			// Whitelist method check
			if (empty($except_methods) OR !in_array($this->router->fetch_method(), $except_methods))
			{
				if (is_callable($callback))
				{
					call_user_func($callback);
				}
			}
		}
	}
}

/* End of file MY_Controller.php */
/* Location : ./application/core/MY_Controller.php */
