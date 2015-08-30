<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function login()
	{
		$username =$this->input->post('username');
		$password =$this->input->post('password');
		$result =$this->db->get_where('users',array('username'=>$username,'password'=>md5($password),'status'=>'1'));
		
		if($result->num_rows() > 0)
		{
			$first_row = $result->first_row();
			$user =  (array) $first_row;
			//echo '<pre>'; print_r($user); exit;
			$user['user_group_id'] =get_all_user_groups($first_row->id);
			$this->session->set_userdata($user);
			//echo '<pre>'; print_r($first_row->id); exit;

			$now_date = strtotime("now");

			$this->db->update('users',array('last_login'=>$now_date),array('id'=>$first_row->id));
			return true;
		}else
			return false;
	}

	public function check_current_password()
	{
		$user = $this->db->get_where('users',array('uid'=>$this->session->userdata('uid')))->first_row();
		if($user)
		{
			$password =$this->input->post('current_pass');
			if(md5($password) == $user->password)
				return true;
			else
				return false;
		}else
			return false;
	}

	public function change_password()
	{
		$password =$this->input->post('pass');
		$this->db->update('users',array('password'=>md5($password)),array('uid'=>$this->session->userdata('uid')));
		return true;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */