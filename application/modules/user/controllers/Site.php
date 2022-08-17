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
