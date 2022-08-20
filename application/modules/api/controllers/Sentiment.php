<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage Sentiment
 * @category   HMVC Controller
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class Sentiment extends HMVC_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index($store_id = NULL, $product_id = NULL)
	{
		$comment = $this->comment->get();
		echo "<pre>";
		print_r ($comment);
		echo "</pre>";
	}

	public function data_training($option = 'view', $id = NULL)
	{
		switch ($option)
		{
			case 'add':
				$this->form_validation->set_rules('class', 'Class', 'trim|required');
				$this->form_validation->set_rules('text', 'Text', 'trim|required');

				if ($this->form_validation->run() == TRUE)
				{
					$this->output->set_content_type('application/json')->set_output(json_encode(array(
						'status' => 'success',
						'data' => array(
							'text' => $this->input->post('text'),
							'class' => $this->input->post('class')
						)
					)));
				}
				else
				{
					$this->output->set_content_type('application/json')->set_output(json_encode($this->form_validation->error_array()));
				}
			break;

			case 'update':
				$this->form_validation->set_rules('class', 'Class', 'trim|required');
				$this->form_validation->set_rules('text', 'Text', 'trim|required');

				if ($this->form_validation->run() == TRUE)
				{
					$this->output->set_content_type('application/json')->set_output(json_encode(array(
						'status' => 'success',
						'data' => array(
							'text' => $this->input->post('text'),
							'class' => $this->input->post('class')
						)
					)));
				}
				else
				{
					$this->output->set_content_type('application/json')->set_output(json_encode($this->form_validation->error_array()));
				}
			break;

			default:
			break;
		}
	}
}

/* End of file Sentiment.php */
/* Location : ./api/controllers/Sentiment.php */
