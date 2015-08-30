<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(isset($this->session->userdata['id']) && in_array(1,$this->session->userdata['user_group_id'])){
			$this->load->model('admin_model');
			$this->load->model('case_model');
			$this->load->library('grocery_CRUD');
		}/*else{
			//show_403();
		}*/
	}

	
	public function home()
	{
		$data['content'] ='admin/home';
		$this->load->view('layout/content',$data);
	}
	
	public function users_listing()
	{
		$data['files_js'][] = 'vendor/datatables/media/js/jquery.dataTables.min.js';
		$data['files_js'][] = 'vendor/datatables_plugins/integration/bootstrap/3/dataTables.bootstrap.min.js';
		$data['js'][] = 'custom/datatable.js';
		$data['files_css'][] = 'vendor/datatables_plugins/integration/bootstrap/3/dataTables.bootstrap.css';
		
		$users_array = $this->admin_model->get_all_users();
		$data['users_array'] =$users_array;
		$data['content'] ='admin/users';
		$this->load->view('layout/content',$data);
	}
	public function add_new_user()
	{
		$data['js'][] = 'custom/add_user.js';
		$data['user_type_arr'] = $this->case_model->get_dropdown_value('user_groups','id','name','allowRegistration=1');
		$data['country_master'] = $this->case_model->get_dropdown_value('country_master','country_id','country');
		//$data['role_arr'] =$this->admin_model->get_all_roles();
		if($this->input->post('user_country') > 0)
			$data['state_master'] = $this->case_model->get_dropdown_value('state_master','state_id','state_name','country_id='.$this->input->post('user_country'));
		if($this->input->post('user_state') > 0)
			$data['city_master'] = $this->case_model->get_dropdown_value('city_master','city_id','city','state_id='.$this->input->post('user_state'));
		$data['content'] ='admin/add_user';
		$this->load->view('layout/content',$data);
	}
	public function edit_user($uid,$type='')
	{
		$data = array();
		if(strlen($type) <= 0){
		$data = $this->admin_model->get_user($uid);
		}
		if(count($data) > 0 || strlen($type) > 0){
		$data['uid'] = $uid;
		$data['role_arr'] =$this->admin_model->get_all_roles();
		$data['content'] ='admin/edit_user';
		$this->load->view('partials/custom',$data);
		}else
		{
			$this->session->set_flashdata('message', 'No User found');
			redirect('admin/user_listing');
		}
	}
	
	public function save_user()
	{
		$this->load->helper('security');
		if(isset($_POST['id'])){
		$config = array(
               array(
                     'field'   => 'username', 
                     'label'   => 'Username', 
                     'rules'   => 'required|email'
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
		}else{
			$config = array(
			array('field'   => 'user_type', 'label'   => 'User Type', 'rules'   => 'required'),
			array('field'   => 'user_name', 'label'   => 'Username', 'rules'   => 'required|min_length[2]|is_unique[users.username]'),
            array('field'   => 'new_password','label'   => 'Password', 'rules'   => 'required|min_length[5]|matches[confirm_password]'),
			array('field'   => 'confirm_password', 'label'   => 'Confirm Password', 'rules'   => 'required|min_length[5]'),
			array('field'   => 'user_email', 'label' =>'Email', 'rules'=> 'required|valid_email|is_unique[users.email]'),
			array('field'   => 'user_contact', 'label'   => 'Contact Number', 'rules'   => 'required|is_natural|max_length[12]'),
			//array('field'   => 'bus_name', 'label'   => 'Business Name', 'rules'   => 'required'),
			array('field'   => 'user_country', 'label'   => 'Country', 'rules'   => 'required'),
			array('field'   => 'user_state', 'label'   => 'State', 'rules'   => 'required'),
			array('field'   => 'user_city', 'label'   => 'City', 'rules'   => 'required')
			);
		}

		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			if(isset($_POST['uid']))
				$this->edit_user($this->input->post('id'),'edit');
			else
				$this->add_new_user();
		}
		else
		{
			if($this->admin_model->save_user())
			{
				$this->session->set_flashdata('message', 'User Saved Successfully');
				redirect('admin/users_listing');
			}else
			{
				$this->session->set_flashdata('message', 'User Not Saved...Please Try Again!!');
				redirect('admin/users_listing');
			}
		}
		
	}
	
	public function delete_user($uid)
	{
		if($this->admin_model->delete_user($uid)){
			$this->session->set_flashdata('message', 'User deleted successfully');
			redirect('admin/users_listing');
		}else
		{
			$this->session->set_flashdata('message', 'Sorry User Not Deleted...Please try again!!');
			redirect('admin/users_listing');
		}
	}
	public function settings()
	{
		$data = $this->admin_model->get_settings();
		$data['content'] ='admin/settings';
		$this->load->view('partials/	',$data);
	}

	public function save_settings()
	{
		$config = array(
               array(
                     'field'   => 'admin_email', 
                     'label'   => 'Admin Email', 
                     'rules'   => 'required|email'
                  )
               );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->admin_model->save_settings();
			$this->session->set_flashdata('message', 'settings saved successfully');
			redirect('admin/settings');
		}else
			$this->settings();
			
	} 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */