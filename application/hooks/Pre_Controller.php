<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage Pre_Controller
 * @category   Hooks
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class Pre_Controller
{
	/**
	 * Installation
	 */
	public function installation()
	{
		$RTR =& load_class('Router', 'core', isset($routing) ? $routing : NULL);

		if (strtoupper(env('DB_INSTALLED')) == 'NO' && $RTR->fetch_class() !== 'migration')
		{
			redirect(base_url('migration'), 'refresh');
		}
	}
}

/* End of file Pre_Controller.php */
/* Location : ./application/hooks/Pre_Controller.php */
