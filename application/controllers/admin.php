<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(isset($this->session->userdata['id']) && $this->session->userdata['user_group_id'] == 1){
			$this->load->model('admin_model');
			$this->load->model('case_model');
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
		$users_array = $this->admin_model->get_all_users();
		$data['users_array'] =$users_array;
		$data['content'] ='admin/users';
		$this->load->view('partials/custom',$data);
	}
	public function add_new_user()
	{
		$data['js'][] = 'custom/add_user.js';
		$data['country_master'] = $this->case_model->get_dropdown_value('country_master','country_id','country');
		//$data['role_arr'] =$this->admin_model->get_all_roles();
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
		if(isset($_POST['uid'])){
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
			array(
                     'field'   => 'username', 
                     'label'   => 'Username', 
                     'rules'   => 'required|email|is_unique[users.username]'
                  ),
               array(
                     'field'   => 'pass', 
                     'label'   => 'Password', 
                     'rules'   => 'required|min_length[5]|matches[cpass]'
                  ),
				  array(
                     'field'   => 'cpass', 
                     'label'   => 'Confirm Password', 
                     'rules'   => 'required|min_length[5]'
                  )
				  );
		}

		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			if(isset($_POST['uid']))
				$this->edit_user($this->input->post('uid'),'edit');
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
	
	public function mis()
	{		
		$data['agency'] = array('0'=>'All') + $this->admin_model->get_all_agency();
		$data['fmonthSelected'] = $data['tmonthSelected'] = date('m');
		$data['fyearSelected'] = $data['tyearSelected'] =  date('Y');
		
		//print_r($data);
		$data['content'] ='admin/mis';
		$this->load->view('partials/custom',$data);
	}
	
	public function get_mis_report(){
		$value = $this->admin_model->get_mis_report($_POST);
		$value['agency'] = $value['id'];

		$html = $this->load->view('admin/misreport',$value);
		echo $html;
	}
	
	public function uploaded($mnth,$year,$uid){
		
		$listings = $this->admin_model->get_uploaded_images_by_id($mnth,$year,$uid);
		$data['listing'] =$listings;
		$data['month'] =$mnth;
		$data['year'] =$year;
		$data['content'] ='admin/upload_image_listing';
		$this->load->view('partials/custom',$data);
	}
	
	public function downloaded($mnth,$year,$uid){
		
		$listings = $this->admin_model->get_downloaded_images_by_id($mnth,$year,$uid);
		$data['listing'] =$listings;
		$data['month'] =$mnth;
		$data['year'] =$year;
		$data['content'] ='admin/download_image_listing';
		$this->load->view('partials/custom',$data);
	}
	
	public function view_upload_image($img_id = 0)
	{
		if($img_id > 0)
		{
		$details = $this->agency_model->get_image_details($img_id);
		if(count($details) > 0)
		{
			$data['image'] = $details[0];
			$data['download_count'] = $this->agency_model->get_image_download_count($img_id);
			$data['content'] ='admin/image_details';
			$this->load->view('partials/custom',$data);
		}else
			return false;
		}
	}
	
	public function delete_download_image($dimg_id)
	{
		if($this->agency_model->delete_download_image($dimg_id))
		{
			$this->session->set_flashdata('message', 'Image deleted successfully from your download list');
			redirect($_SERVER['HTTP_REFERER']);
		}
		
	}
	
	public function delete_upload_image($img_id)
	{
		if($this->agency_model->delete_upload_image($img_id)){
			$this->session->set_flashdata('message', 'Image deleted successfully');
			redirect($_SERVER['HTTP_REFERER']);
		}else
		{
			$this->session->set_flashdata('message', 'Sorry Image Not Deleted...Please try again!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	public function download_image($img_id)
	{
		$this->load->helper('download');
		$details = $this->agency_model->get_image_details($img_id);
		if(count($details) > 0)
		{
			
			$data = file_get_contents("./uploads/".$details[0]['img_name']); // Read the file's contents
			$name = $details[0]['img_name'];

			force_download($name, $data);
			
		}
	}

	public function website_listing()
	{
		$website_array = $this->admin_model->get_all_websites();
		$data['web_array'] =$website_array;
		$data['content'] ='admin/website';
		$this->load->view('partials/custom',$data);
	}
	
	public function add_new_website()
	{
		$data['content'] ='admin/add_website';
		$this->load->view('partials/custom',$data);
	}
	
	public function edit_website($web_id,$type='')
	{
		$data = array();
		if(strlen($type) <= 0){
		$data = $this->admin_model->get_website($web_id);
		}
		if(count($data) > 0 || strlen($type) > 0){
		$data['web_id'] = $web_id;
		$data['content'] ='admin/edit_website';
		$this->load->view('partials/custom',$data);
		}else
		{
			$this->session->set_flashdata('message', 'No website found');
			redirect('admin/website_listing');
		}
	}
	
	public function delete_website($web_id)
	{
		if($this->admin_model->delete_website($web_id)){
			$this->session->set_flashdata('message', 'website deleted successfully');
			redirect('admin/website_listing');
		}else
		{
			$this->session->set_flashdata('message', 'Sorry Website Not Deleted...Please try again!!');
			redirect('admin/website_listing');
		}
	}
	
	public function save_website()
	{
		if(isset($_POST['web_id'])){
		$config = array(
               array(
                     'field'   => 'website', 
                     'label'   => 'Website Name', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'website_url', 
                     'label'   => 'Website URL', 
                     'rules'   => 'required'
                  ),
            );
		}else{
			$config = array(
               array(
                     'field'   => 'website', 
                     'label'   => 'Website Name', 
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'website_url', 
                     'label'   => 'Website URL', 
                     'rules'   => 'required|is_unique[website.url]'
                  ),
               array(
                     'field'   => 'desc', 
                     'label'   => 'Description', 
                     'rules'   => 'required'
                  )
            );
			
		}

		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			
			if(isset($_POST['web_id']))
				$this->edit_website($this->input->post('web_id'),'edit');
			else
				$this->add_new_website();
		}
		else
		{
			if($this->admin_model->save_website())
			{
				
				$this->session->set_flashdata('message', 'Website Saved Successfully');
				redirect('admin/website_listing');
			}else
			{
				$this->session->set_flashdata('message', 'Website Not Saved...Please Try Again!!');
				redirect('admin/website_listing');
			}
		}
		
	}

	public function settings()
	{
		$data = $this->admin_model->get_settings();
		$data['content'] ='admin/settings';
		$this->load->view('partials/custom',$data);
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