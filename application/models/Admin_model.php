<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function get_all_roles()
	{
		$roles=array();
		$result = $this->db->get_where('roles',array('rid !='=>1));
		if($result->num_rows() > 0)
		{
			foreach($result->result_array() as $r)
			{
				$roles[$r['rid']] = $r['role'];
			}
			return $roles;
		}else
			return array();
	}
	
	public function get_all_users()
	{
		$this->db->select('users.*,state_master.state_name,country_master.country,city_master.city');
		$this->db->from('users');
		$this->db->join('country_master', 'country_master.country_id = users.country_id', 'left outer');
		$this->db->join('state_master', 'state_master.state_id = users.state_id', 'left outer');
		$this->db->join('city_master', 'city_master.city_id = users.city_id', 'left outer');
		$this->db->where('users.status','1');
		$this->db->order_by('created','desc');
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}else
			return array();
	}
	
	public function save_user()
	{
		$this->load->model('case_model');
		$this->load->helper('global_helper');
		$id = 0;
		$data['user_group_id'] =$this->input->post('user_type');
		$data['username'] = $this->input->post('user_name');
		$data['password'] = md5($this->input->post('new_password'));
		$data['email'] = $this->input->post('user_email');
		$data['contact_no'] = $this->input->post('user_contact');
		$data['city_id'] = $this->input->post('user_city');
		$data['state_id'] = $this->input->post('user_state');
		$data['country_id'] = $this->input->post('user_country');
		if($data['user_group_id'] == 4 || $data['user_group_id'] == 5){
			$data['first_name'] = $this->input->post('bus_name');
		}
		else{
			$data['first_name'] = $this->input->post('first_name');
			$data['last_name'] = $this->input->post('last_name');
		}

		$data['address'] = $this->input->post('user_area');
		$data['created'] = strtotime("now");
		$data['updated'] = strtotime("now");
		$data['last_login'] = strtotime("now");

		if($id == 0){
			$max = $this->case_model->maxUserVal($data['user_group_id']);
			$max = ($max == 0) ? '001' : ((strlen($max) == 1) ? ('00'.($max+1)) : ('0'.($max+1)));
			if($data['user_group_id'] == 4) $code = 'A'.$max ;
			else if($data['user_group_id'] == 5) $code = 'C'. $max;
			else if($data['user_group_id'] == 2) $code = 'U'. $max;
			else $code = 'W'. $max;

			$data['usercode'] = $code;
		}
		
		if(isset($id) && $id > 0){
			if(strlen($password) > 0)
				$this->db->update('users',array('rid'=>$role,'username'=>$username,'password'=>md5($password),'temp_pwd'=>$password),array('uid'=>$uid));
			else
				$this->db->update('users',array('rid'=>$role,'username'=>$username),array('uid'=>$uid));
		}
		else
			$this->db->insert('users',$data);
		
		if($id == 0)
			$id = $this->db->insert_id();
		if(in_array($data['user_group_id'],get_all_user_groups($id)))
			$this->db->update('user_groups_mapping',array('updated'=>$data['updated']));
		else
			$this->db->insert('user_groups_mapping',array('user_id'=>$id,'user_group_id'=>$data['user_group_id'],'created'=>$data['updated'],'updated'=>$data['updated']));
		return true;
	}
	
	public function get_user($uid)
	{
		$data=array();
		$result = $this->db->get_where('users',array('uid'=>$uid,'status'=>'1'));
		if($result->num_rows() > 0)
		{
			$res = $result->first_row();
			$data['uid'] = $res->uid;
			$data['role'] = $res->rid;
			$data['username'] = $res->username;
			
		}
		return $data;
	}
	
	public function delete_user($uid)
	{
		$this->db->update('users',array('status'=>'0'),array('uid'=>$uid));
		return true;
	}

	public function get_settings()
	{
		$data=array();
		$settings =$this->db->get('settings');
		foreach($settings->result() as $setting){

			$data[$setting->meta_key] = $setting->meta_value;
		}
		return $data;
	}

	public function save_settings()
	{
		$email = $this->input->post('admin_email');
		$this->db->update('settings',array('meta_value'=>$email),array('meta_key'=>'admin_email'));
		return true;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */