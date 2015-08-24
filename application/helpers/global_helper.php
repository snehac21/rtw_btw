<?php

/** To get Dropdown Value **/
function get_dropdown_value(){
	echo 11;
}

/*get single group name by group id*/

if(!function_exists('get_group_name')){
	function get_group_name($group_id)
	{
		$ci =& get_instance();
		$result = $ci->db->get_where('user_groups',array('id'=>$group_id))->first_row();
		return $result->name;
	}
}

/*get all group od single user by user id*/

if(!function_exists('get_all_user_groups')){
	function get_all_user_groups($user_id)
	{
		$user_groups =array();
		$ci =& get_instance();
		$result = $ci->db->get_where('user_groups_mapping',array('user_id'=>$user_id,'status'=>'1'))->result_array();
		foreach($result as $r)
		{
			$user_groups[] = $r['user_group_id'];
		}
		return $user_groups;
	}
}



?>