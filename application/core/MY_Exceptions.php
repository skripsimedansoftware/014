<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage MY_Exceptions
 * @category   Libraries
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class MY_Exceptions extends CI_Exceptions
{
	/**
	 * Show error page
	 *
	 * @param      string  $heading
	 * @param      string  $message
	 * @param      string  $template
	 * @param      int     $status_code
	 */
	public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
	{
		$ci =& get_instance();

		if (!empty($ci))
		{
			if (class_exists('Modules'))
			{
				if ($ci->router->fetch_module() !== $ci->router->default_controller)
				{
					$error_handlle = Modules::run($ci->router->fetch_module().'/'.$ci->router->routes['error_handlle'], $status_code, $heading, $message);

					if ($error_handlle !== NULL)
					{
						$ci->output->set_content_type('text/html')->set_output($error_handlle);
						$ci->output->_display();
					}
					else
					{
						parent::show_error($heading, $message, $template, $status_code);
					}
				}
			}
			else
			{
				parent::show_error($heading, $message, $template, $status_code);
			}
		}
		else
		{
			parent::show_error($heading, $message, $template, $status_code);
		}
	}
}

/* End of file MY_Exceptions.php */
/* Location : ./application/core/MY_Exceptions.php */
