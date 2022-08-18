<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage Site
 * @category   HMVC Controller
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class Site extends HMVC_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->authenticated_module(NULL, function() {
			redirect(module_link('sign-in'), 'refresh');
		});
	}

	/**
	 * Show error page
	 */
	public function show_error()
	{
		$this->template->load('error');
	}
}

/* End of file Site.php */
/* Location : ./user/controllers/Site.php */
