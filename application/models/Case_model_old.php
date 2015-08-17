<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Case_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getCustomers($value){

    	//$data = $this->db->query('Select GROUP_CONCAT("\'",username,"\'") as name From users Where status = 1 AND active = 1 AND approve = 1 AND id <> 1 AND (username LIKE "%'.$value.'%" OR email LIKE "%'.$value.'%" OR usercode LIKE "%'.$value.'%" OR contact_no LIKE "%'.$value.'%" ) ');
        //CONCAT(username,"\/",usercode,"\/",email,"\/",contact_no)

        $data = $this->db->query('Select username as name, id From users Where status = 1 AND active = 1 AND approve = 1 AND id <> 1 AND (username LIKE "%'.$value.'%" OR email LIKE "%'.$value.'%" OR usercode LIKE "%'.$value.'%" OR contact_no LIKE "%'.$value.'%" ) ');

    	if($data->num_rows() > 0){
            
            return $data->result_array();
        }
        return $data = "";
    }

    public function getCustomerVal($cust_id){

       // echo 'Select CONCAT(first_name," ",last_name) as name,usercode,email,contact_no,user_group_id id From users Where status = 1 AND active = 1 AND approve = 1 AND id = '.$cust_id; exit;
        $data = $this->db->query('Select CONCAT(first_name," ",last_name) as name,usercode,email,contact_no,user_group_id, id From users Where status = 1 AND active = 1 AND approve = 1 AND id = '.$cust_id);

        if($data->num_rows() > 0){
            
            return $data->result_array();
        }
        return $data = "";
    }

    public function isUniqueUname($uname){
    	$data = $this->db->query('Select * From users Where username = "'.$uname.'"');
    	if($data->num_rows() > 0)
		{
			return 1;
		}else
			return 0;
    }

    public function isUniqueEmail($email){
    	$data = $this->db->query('Select * From users Where email = "'.$email.'"');

    	if($data->num_rows() > 0)
		{
			return 1;
		}else
			return 0;
    }

    public function maxUserVal($utype){
        $data = $this->db->query('Select usercode From users Where user_group_id = "'.$utype.'" Order by id desc Limit 0,1');
        return $data->num_rows();
    }

    public function saveUser($data){
        $this->db->insert('users',array('usercode'=>$data['code'],'user_group_id'=>$data['user_type'],'username'=>$data['user_name'],'password'=>md5($data['new_password']),'email'=>$data['user_email'],'contact_no'=>$data['user_contact'],'last_login'=>date('Y-m-d H:i:s'),'created'=>date('Y-m-d H:i:s'),'modified'=>date('Y-m-d H:i:s')));

        /** To get last insert ID **/
        $user_id = $this->db->insert_id();
        $user_meta_fields = array('user_type'=>'agent_type','bus_name'=>'bus_name','user_contact'=>'contact_no','user_area'=>'area','user_city'=>'city','user_state'=>'state','user_country'=>'country','alt_contact'=>'alt_contact_no');

        foreach($user_meta_fields as $k=>$v){
            $this->db->insert('user_meta',array('user_id'=>$user_id,'meta_key'=>$v,'meta_value'=>$data[$k]));
        }
        return true;

    }
}