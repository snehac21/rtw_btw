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