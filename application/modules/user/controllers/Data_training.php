<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage Data_training
 * @category   HMVC Controller
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class Data_training extends HMVC_Controller
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

	public function index()
	{
		$data['title'] = 'Data Training';
		$data['data_training'] = $this->data_training->get();
		$this->template->load('data-training/index', $data);
	}

	public function create()
	{
		$data['title'] = 'Data Training Add';
		$data['data_training'] = $this->data_training->get();

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('text', 'Text', 'trim|required');
			$this->form_validation->set_rules('class', 'Class', 'trim|required');

			if ($this->form_validation->run() == TRUE)
			{
				$this->data_training->insert(array(
					'text' => $this->input->post('text'),
					'classification' => $this->input->post('class')
				));

				redirect(module_link('data_training'), 'refresh');
			}
			else
			{
				$this->template->load('data-training/create', $data);
			}
		}
		else
		{
			$this->template->load('data-training/create', $data);
		}
	}

	public function update($id = NULL)
	{
		$data['title'] = 'Data Training Add';
		$data['data'] = $this->data_training->get_where(array('id' => $id))->row_array();

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('text', 'Text', 'trim|required');
			$this->form_validation->set_rules('class', 'Class', 'trim|required');

			if ($this->form_validation->run() == TRUE)
			{
				$this->data_training->update(array(
					'text' => $this->input->post('text'),
					'classification' => $this->input->post('class')
				), array('id' => $id));

				redirect(module_link('data_training'), 'refresh');
			}
			else
			{
				$this->template->load('data-training/update', $data);
			}
		}
		else
		{
			$this->template->load('data-training/update', $data);
		}
	}

	public function delete($id = NULL)
	{
		$this->data_training->delete(array('id' => $id));
		redirect(module_link('data_training'), 'refresh');
	}

	public function delete_all()
	{
		$this->data_training->truncate();
		redirect(module_link('data_training'), 'refresh');
	}
}

/* End of file Data_training.php */
/* Location : ./user/controllers/Data_training.php */
