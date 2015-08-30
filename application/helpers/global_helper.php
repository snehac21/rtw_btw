<?php


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

/*get all group name of single user by user id*/

if(!function_exists('get_all_user_groups_name')){
	function get_all_user_groups_name($user_id)
	{
		$user_groups_name =array();
		$ci =& get_instance();
		$user_groups = get_all_user_groups($user_id);
		$ci->db->select('name');
		$ci->db->from('user_groups');
		$ci->db->where_in('id',$user_groups);
		$result = $ci->db->get()->result_array();
		foreach($result as $r)
		{
			$user_groups_name[] = $r['name'];
		}
		return $user_groups_name;
	}
}

/* To get dropdown values */

if(!function_exists('get_dropdown_value')){
	function get_dropdown_value($table,$field1,$field2,$condition = '')
	{
		$ci =& get_instance();
		$value = array();
        $sql = 'Select '.$field1.', '.$field2.' From '.$table.' Where status = "1"';
        $sql .= (strlen($condition) > 0) ? ' AND '.$condition : ''; 
        $data = $ci->db->query($sql);
        if($data->num_rows() > 0){
            foreach($data->result_array() as $r){
                $value[$r[$field1]] = $r[$field2];
            }
        }
        //echo $this->db->last_query();
        return $value;
	}
}
?>