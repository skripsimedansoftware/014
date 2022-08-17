<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage User
 * @category   HMVC Controller
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class User extends HMVC_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->authenticated_module(array('sign_up', 'sign_in', 'sign_out', 'forgot_password', 'reset_password'), function() {
			redirect(module_link('sign-in'), 'refresh');
		});
	}

	/**
	 * Dashboard
	 */
	public function index()
	{
		$data['title'] = 'Dashboard';
		$this->template->load('index', $data);
	}

	/**
	 * User profile
	 *
	 * @param      int  $user_id  User ID
	 */
	public function profile($user_id = NULL, $option = 'view')
	{
		$user = (!empty($user_id) ? $this->user->get_where(array('id' => $user_id)) : $this->user->get_where(array('id' => $this->__user_session())));

		if ($user->num_rows() > 0)
		{
			$data['profile'] = $user->row_array();

			switch ($option)
			{
				case 'update':
					if ($this->input->method() == 'post')
					{
						$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
						$this->form_validation->set_rules('username', 'Username', 'trim|required');
						$this->form_validation->set_rules('gender', 'Gender', 'trim|in_list[male,female]|required');
						$this->form_validation->set_rules('full-name', 'Full Stack', 'trim|required');

						if ($this->form_validation->run() == TRUE)
						{
							$this->user->update(array(
								'email' => $this->input->post('email'),
								'username' => $this->input->post('username'),
								'full-name' => $this->input->post('full-name'),
								'gender' => $this->input->post('gender')
							), array('id' => $user_id));

							if (!empty($_FILES['photo']['name']))
							{
								$config['upload_path'] = './public/user-photo/';
								$config['allowed_types'] = 'jpg|jpeg|png';
								$config['encrypt_name'] = TRUE;

								$this->load->library('upload', $config);

								if ($this->upload->do_upload('photo'))
								{
									$this->user->update(array('photo' =>  'public/user-photo/' . $this->upload->data()['file_name']), array('id' => $user_id));
								}
								else
								{
									$this->session->set_flashdata('photo-profile', $this->upload->display_errors());
								}
							}

							redirect(module_link('profile/'.$user_id), 'refresh');
						}
						else
						{
							$this->template->load('profile-update', $data);
						}
					}
					else
					{
						$this->template->load('profile-update', $data);
					}
				break;

				default:
					$this->template->load('profile', $data);
				break;
			}
		}
		else
		{
			show_404();
		}
	}

	/**
	 * Manage user
	 */
	public function manage()
	{
	}

	/**
	 * User authentication
	 *
	 * @param      string  $page   Auth page name
	 * @param      array   $data   Render data
	 */
	public function authentication($page = NULL, $data = NULL)
	{
		$this->template->set_path('auth');
		$this->template->load($page, $data);
	}

	/**
	 * Sign up
	 */
	public function sign_up()
	{
		$data['title'] = 'Sign Up';

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('full-name', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE)
			{
				$this->user->insert(array(
					'full-name' => $this->input->post('full-name'),
					'email' => $this->input->post('email'),
					'password' => $this->security->user_password($this->input->post('password')),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));

				$this->session->set_flashdata('sign-up', TRUE);
				redirect(module_link('sign-in'), 'refresh');
			}
			else
			{
				$this->authentication('sign-up', $data);
			}
		}
		else
		{
			$this->authentication('sign-up', $data);
		}
	}

	/**
	 * Sign in
	 */
	public function sign_in()
	{
		$data['title'] = 'Sign In';

		if ($this->input->post())
		{
			$this->form_validation->set_rules('identity', 'Email / Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE)
			{
				$sign_in = $this->user->sign_in($this->input->post('identity'), $this->input->post('password'));

				if ($sign_in !== FALSE)
				{
					$this->session->set_userdata('user', $sign_in->row()->id);
					redirect(module_link(), 'refresh');
				}
				else
				{
					$this->session->set_flashdata('sign-in', 'Otentikasi gagal');
					redirect(module_link('sign-in'), 'refresh');
				}
			}
			else
			{
				$this->authentication('sign-in', $data);
			}
		}
		else
		{
			$this->authentication('sign-in', $data);
		}
	}

	/**
	 * Sign out
	 */
	public function sign_out()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('sign-out', TRUE);
		redirect(module_link('sign-in'), 'refresh');
	}

	/**
	 * Forgot password
	 */
	public function forgot_password()
	{
		$data['title'] = 'Forgot Password';

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('identity', 'Email / Username', 'trim|required');

			if ($this->form_validation->run() == TRUE)
			{
				$user = $this->user->find($this->input->post('identity'));

				if ($user->num_rows() >= 1)
				{
					$code = random_string('numeric', 6);
					$user = $user->row_array();
					$data['user'] = $user;
					$data['verification_code'] = $code;

					$this->load->config('smtp', TRUE, TRUE);
					$smtp = $this->config->item('smtp');

					if (!empty($smtp) && isset($smtp['default']))
					{
						$this->load->library('email', $smtp['default']);
						$this->email->from($smtp['default']['smtp_user'], $smtp['default']['smtp_name']);
						$this->email->to($user['email']);
						$this->email->subject('Reset Password');
						$this->email->set_mailtype('html');
						$this->email->message($this->load->view('email-template/forgot-password', $data, TRUE));

						if ($this->email->send())
						{
							$this->verification_code->insert(array(
								'type' => 'reset-password',
								'code' => $code,
								'user-id' => $user['id'],
								'expired' => nice_date(unix_to_human(strtotime('+ 1 day')), 'Y-m-d H:i:s'),
								'status' => 'unconfirmed',
								'created_at' => date('Y-m-d H:i:s'),
								'updated_at' => date('Y-m-d H:i:s')
							));

							$this->session->set_flashdata('forgot-password', TRUE);
						}
						else
						{
							$this->session->set_flashdata('forgot-password', FALSE);
						}

						redirect(module_link('sign-in'), 'refresh');
					}
					else
					{

					}
				}
				else
				{
					$this->session->set_flashdata('forgot-password-error', 'Couldn\'t find your account');
					redirect(module_link('forgot-password'), 'refresh');
				}
			}
			else
			{
				$this->authentication('forgot-password', $data);
			}
		}
		else
		{
			$this->authentication('forgot-password', $data);
		}
	}

	/**
	 * Reset password
	 */
	public function reset_password($verification_code = NULL)
	{
		$data['title'] = 'Reset Password';
		$data['verification_code'] = $verification_code;

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('verification-code', 'Verification Code', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('password_confirm', 'Re-type Password', 'trim|matches[password]|required');

			if ($this->form_validation->run() == TRUE)
			{
				$verification_code = $this->verification_code->get_where(array('code' => $this->input->post('verification-code')));

				if ($verification_code->num_rows() >= 1)
				{
					$verification_code = $verification_code->row_array();

					if ($verification_code['type'] == 'reset-password')
					{
						if ($verification_code['status'] == 'unconfirmed')
						{
							if (human_to_unix($verification_code['expired']) > now())
							{
								$user = $this->user->get_where(array('id' => $verification_code['user-id']));

								if ($user->num_rows() >= 1)
								{
									$user = $user->row_array();

									$this->verification_code->update(array('status' => 'used', 'updated_at' => date('Y-m-d H:i:s')), array('id' => $verification_code['id']));
									$this->user->update(array('password' => $this->security->user_password($this->input->post('password'))), array('id' => $user['id']));

									redirect(module_link(), 'refresh');
								}
								else
								{
									// user doesn't exists
									$data['error'] = 'User doesn\'t exists';
									$this->authentication('reset-password', $data);
								}
							}
							else
							{
								// verification code expired
								$data['error'] = 'Reset password session expired';
								$this->authentication('reset-password', $data);
							}
						}
						else
						{
							// verification code used
							$data['error'] = 'Reset password code has been used';
							$this->authentication('reset-password', $data);
						}
					}
					else
					{
						// verification code not for reset-password
						redirect(module_link(), 'refresh');
					}
				}
				else
				{
					// verification doesn't exists
					$data['error'] = 'Verification code is invalid';
					$this->authentication('reset-password', $data);
				}
			}
			else
			{
				$this->authentication('reset-password', $data);
			}
		}
		else
		{
			$this->authentication('reset-password', $data);
		}
	}
}

/* End of file User.php */
/* Location : ./user/controllers/User.php */
