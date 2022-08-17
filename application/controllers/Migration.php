<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage Migration
 * @category   Controller
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class Migration extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->template->set_path('migration');
	}

	/**
	 * Home
	 */
	public function index()
	{
		$data['title'] = 'Installation';
		$this->template->load('index', $data);
	}

	/**
	 * Install database
	 */
	public function database()
	{
		$data['title'] = 'Database Installation';
		$env_file = file_get_contents(FCPATH.'.env');

		if ($this->input->method() == 'post')
		{
			$config = array(
				'hostname' => $this->input->post('hostname'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'dbdriver' => $this->input->post('dbdriver')
			);

			$database = @$this->load->database($config, TRUE);

			if ($database->conn_id)
			{
				$config['database'] = $this->input->post('database');

				$database = @$this->load->database($config, TRUE);

				if ($database->conn_id)
				{
					preg_match('/(DB_HOST).*/', $env_file, $db_host);
					$env_file = str_replace($db_host[0], 'DB_HOST = "'.$config['hostname'].'"', $env_file);

					preg_match('/(DB_USER).*/', $env_file, $db_user);
					$env_file = str_replace($db_user[0], 'DB_USER = "'.$config['username'].'"', $env_file);

					preg_match('/(DB_PASS).*/', $env_file, $db_pass);
					$env_file = str_replace($db_pass[0], 'DB_PASS = "'.$config['password'].'"', $env_file);

					preg_match('/(DB_NAME).*/', $env_file, $db_name);
					$env_file = str_replace($db_name[0], 'DB_NAME = "'.$config['database'].'"', $env_file);

					preg_match('/(DB_DRIVER).*/', $env_file, $db_driver);
					$env_file = str_replace($db_driver[0], 'DB_DRIVER = "'.$config['dbdriver'].'"', $env_file);

					preg_match('/(DB_INSTALLED).*/', $env_file, $db_installed);
					$env_file = str_replace($db_installed[0], 'DB_INSTALLED = "YES"', $env_file);

					file_put_contents(FCPATH.'.env', $env_file);
					redirect(base_url('migration/tables'), 'refresh');
				}
				else
				{
					$this->template->load('database', $data);
				}
			}
			else
			{
				$data['error'] = $database->error();
				$this->template->load('database', $data);
			}
		}
		else
		{
			$this->template->load('database', $data);
		}
	}

	/**
	 * Install tables
	 */
	public function tables()
	{
		$this->load->library('migration', array(
			'migration_enabled' => TRUE,
			'migration_type' => 'sequential',
			'migration_path' => APPPATH.'migrations',
			'migration_version' => 1,
			'migration_table' => 'migration'
		));

		if ($this->migration->latest() === FALSE)
		{
			$this->session->set_userdata('migration', FALSE);
			$this->session->set_userdata('migraton-error', $this->migration->error_string());
		}
		else
		{
			$this->session->set_userdata('migration', TRUE);
		}

		redirect(base_url('migration/setup'), 'refresh');
	}

	/**
	 * App setup
	 */
	public function setup()
	{
		$data['title'] = 'Setup';
		$env_file = file_get_contents(FCPATH.'.env');

		if ($this->input->method() == 'post')
		{
			preg_match('/(APP_NAME).*/', $env_file, $app_name);
			$env_file = str_replace($app_name[0], 'APP_NAME = "'.$this->input->post('app_name').'"', $env_file);

			preg_match('/(SITE_NAME).*/', $env_file, $site_name);
			$env_file = str_replace($site_name[0], 'SITE_NAME = "'.$this->input->post('site_name').'"', $env_file);

			file_put_contents(FCPATH.'.env', $env_file);
			redirect(base_url('user'), 'refresh');
		}
		else
		{
			$this->template->load('setup', $data);
		}
	}
}

/* End of file Migration.php */
/* Location : ./application/controllers/Migration.php */
