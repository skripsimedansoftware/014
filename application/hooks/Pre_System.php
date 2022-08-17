<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage Pre_System
 * @category   Hooks
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class Pre_System
{
	/**
	 * Installation
	 */
	public function installation()
	{
		if (strtoupper(env('DB_INSTALLED')) == 'NO' && get_instance()->router->fetch_class() !== 'migration')
		{
			redirect(base_url('migration'), 'refresh');
		}
	}
}

/* End of file Pre_System.php */
/* Location : ./application/hooks/Pre_System.php */
