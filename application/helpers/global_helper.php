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

?>