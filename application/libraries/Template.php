<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage Template
 * @category   Library
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class Template
{
	protected $ci;

	protected $path;

	protected $base = 'base';

	/**
	 * constructor
	 */
	public function __construct()
	{
		$this->ci =& get_instance();
	}

	/**
	 * Set path
	 *
	 * @param      string  $path
	 *
	 * @return     self
	 */
	public function set_path($path)
	{
		$this->path = $path;
		return $this;
	}

	/**
	 * Set base file name
	 *
	 * @param      string  $file   File name
	 *
	 * @return     self
	 */
	public function set_base($file)
	{
		$this->base = $file;
		return $this;
	}

	/**
	 * Load page
	 *
	 * @param      string  $page   Page name
	 * @param      array   $data   Page data
	 */
	public function load($page, $data = array())
	{
		$data['__content'] = $this->ci->load->view($this->path.'/'.$page, $data, TRUE);
		$this->ci->load->view($this->path.'/'.$this->base, $data, FALSE);
	}
}

/* End of file Template.php */
/* Location : ./application/libraries/Template.php */
