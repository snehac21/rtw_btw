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
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('roles','roles.rid=users.rid');
		$this->db->where('users.status','1');
		$this->db->where('users.uid !=',1);
		$this->db->order_by('uid','desc');
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}else
			return array();
	}
	
	public function save_user()
	{
		$uid =$this->input->post('uid');
		$role =$this->input->post('role');
		$username =$this->input->post('username');
		$password =$this->input->post('pass');
		
		if(isset($uid) && $uid > 0){
			if(strlen($password) > 0)
				$this->db->update('users',array('rid'=>$role,'username'=>$username,'password'=>md5($password),'temp_pwd'=>$password),array('uid'=>$uid));
			else
				$this->db->update('users',array('rid'=>$role,'username'=>$username),array('uid'=>$uid));
		}
		else
			$this->db->insert('users',array('rid'=>$role,'username'=>$username,'password'=>md5($password),'temp_pwd'=>$password,'last_login'=>date('Y-m-d H:i:s')));
		
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