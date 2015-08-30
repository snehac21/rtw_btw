<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		if($this->session->userdata('user_group_id'))
		{
			$this->get_home_page();
		}else
		{
			$data['content'] ='login/login';
			$this->load->view('layout/content',$data);
		}
		
	}
	
	public function do_login()
	{
		$config = array(
               array(
                     'field'   => 'username', 
                     'label'   => 'Username', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required'
                  )
            );

		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			if($this->login_model->login())
			{
				$this->session->set_flashdata('message', 'Logged In Successfully');
				$this->get_home_page();
			}else
			{
				$this->session->set_flashdata('message', 'Invalid Credentials');
				redirect('login/index');
			}
		}
		
	}
	
	public function get_home_page()
	{
		if(in_array(1, $this->session->userdata('user_group_id')))
		{
			redirect('admin/home');
		}else if(in_array(2, $this->session->userdata('user_group_id')))
		{
			redirect('admin/home');
		}else if(in_array(3, $this->session->userdata('user_group_id')))
		{
			redirect('admin/home');
		}else if(in_array(4, $this->session->userdata('user_group_id')))
		{
			redirect('admin/home');
		}else
		redirect('login/index');
	}

	public function change_password()
	{
		if($this->session->userdata('user_group_id'))
		{
			$data['content'] ='login/change_password';
			$this->load->view('partials/custom',$data);
		}else
		{
			show_403();
		}
	}

	public function save_password()
	{
		if($this->session->userdata('rid'))
		{
			$config = array(
               array(
                     'field'   => 'current_pass', 
                     'label'   => 'Current Password', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'pass', 
                     'label'   => 'Password', 
                     'rules'   => 'min_length[5]|matches[cpass]'
                  ),
				  array(
                     'field'   => 'cpass', 
                     'label'   => 'Confirm Password', 
                     'rules'   => 'min_length[5]'
                  )
            );
            $this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == TRUE)
		{
			if($this->login_model->check_current_password())
			{
				echo 'okk';
				$this->login_model->change_password();
				$this->session->set_flashdata('message', 'Password changed successfully');
				redirect('login/change_password');
			}else
			{
				echo 'okk1';
				$this->session->set_flashdata('message', 'Current Password not matching');
				redirect('login/change_password');
			}
		}else
		echo 'okk2';
			$this->change_password();
		}else
		{
			show_403();
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', 'Logged Out Successfully');
		redirect('login/index');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */