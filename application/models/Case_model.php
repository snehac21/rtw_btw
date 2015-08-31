<?php

/**
    Created on : 2015-07-25
    Created By : Sunita Mistry
    Purpose : Db related function to save inquiries and add new users
    Filename : Case_model.php
**/

defined('BASEPATH') OR exit('No direct script access allowed');

class Case_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getCustomers($value){

    
        $data = $this->db->query('Select CONCAT(username,", ",usercode,", ",email,", ",contact_no) as name, id From users Where status = "1" AND active = "Yes" AND approve = 1 AND user_group_id NOT IN (1,2) AND (username LIKE "%'.$value.'%" OR email LIKE "%'.$value.'%" OR usercode LIKE "%'.$value.'%" OR contact_no LIKE "%'.$value.'%" ) ');

    	if($data->num_rows() > 0){
            
            return $data->result_array();
        }
        return $data = "";
    }

    public function getCustomerVal($cust_id){

       // echo 'Select CONCAT(first_name," ",last_name) as name,usercode,email,contact_no,user_group_id id From users Where status = 1 AND active = 1 AND approve = 1 AND id = '.$cust_id; exit;
        $data = $this->db->query('Select username as name,usercode,email,contact_no,user_group_id, id From users Where status = "1" AND active = "Yes" AND approve = 1 AND id = '.$cust_id);

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
        $now_date = strtotime("now");
        $this->db->insert('users',array('usercode'=>$data['code'],'user_group_id'=>$data['user_type'],'username'=>$data['user_name'],'password'=>md5($data['new_password']),'email'=>$data['user_email'],'contact_no'=>$data['user_contact'],'last_login'=>date('Y-m-d H:i:s'),'created'=>$now_date,'updated'=>$now_date, 'active'=>'Yes','approve'=>1));

        /** To get last insert ID **/
        $user_id = $this->db->insert_id();
        $user_meta_fields = array('user_type'=>'agent_type','bus_name'=>'bus_name','user_contact'=>'contact_no','user_area'=>'area','user_city'=>'city','user_state'=>'state','user_country'=>'country','alt_contact'=>'alt_contact_no');

        if(in_array($data['user_type'],get_all_user_groups($user_id)))
            $this->db->update('user_groups_mapping',array('updated'=>$now_date));
        else
            $this->db->insert('user_groups_mapping',array('user_id'=>$user_id,'user_group_id'=>$data['user_type'],'created'=>$now_date,'updated'=>$now_date));

        foreach($user_meta_fields as $k=>$v){
            $this->db->insert('user_meta',array('user_id'=>$user_id,'meta_key'=>$v,'meta_value'=>$data[$k]));
        }
        return true;
    }

    public function get_dropdown_value($table,$field1,$field2,$condition = ''){
        $value = array();
        $sql = 'Select '.$field1.', '.$field2.' From '.$table.' Where status = "1"';
        $sql .= (strlen($condition) > 0) ? ' AND '.$condition : ''; 
        $data = $this->db->query($sql);
        if($data->num_rows() > 0){
            foreach($data->result_array() as $r){
                $value[$r[$field1]] = $r[$field2];
            }
        }
        //echo $this->db->last_query();
        return $value;
    }

    public function get_oktb_status($country_id){
        $data = $this->db->query("Select oktb_required From country_master Where country_id = ".$country_id);
        if($data->num_rows() > 0){
           return $data->first_row()->oktb_required;
        }
    }

    public function get_visa_value($visa_id){
        $data = $this->db->query("Select other_services,urgent_days,visa_validity_days,processing_days,processing_type,visa_cost,service_charge,urgent_days,document_required From visa_type_master Where visa_type_id = ".$visa_id);
        if($data->num_rows() > 0){
           return $data->first_row();
        }
        else return array();
    }

    /* Save Cases in db */
    public function saveCases($data){
        $now_date = strtotime("now"); 
        $travel_date = strtotime($data['visa_travel_date']);


        /* Insert into case logs table */
        //print_r($data); exit;
        $this->db->insert('case_table',array('case_code'=>$data['case_code'],'front_user_id'=>$this->session->userdata('id'),'customer_id'=>$data['customer_id'],'customer_code'=>$data['cust_code'],'product_type_id'=>$data['product'],'created'=>$now_date,'updated'=>$now_date,'tr_status'=>2));

        $product = $data['product'];

        /** To get last insert ID **/
        $case_id = $this->db->insert_id();

        /* Visa Cases */
        if($product == 1){

            /* To check if visa case is urgent or not */
            $cur_date = date('d-m-Y');

            $urg_days = (strlen($data['visa_urgent_days']) > 0) ? $data['visa_urgent_days'] : 0 ;

            $urgent_date = date('d-m-Y', strtotime("+".$urg_days." days"));

            //echo $data['visa_travel_date'] .'<br>'.$cur_date.'<br>'.$urgent_date;

            if (($data['visa_travel_date'] >= $cur_date) && ($data['visa_travel_date'] <= $urgent_date))
            {
              $urgent_visa = 'Yes';
            }else{
               $urgent_visa = 'No'; 
            }

            $total_count = $data['visa_adult'] + $data['visa_child']; 
            $disc = (( isset($data['visa_disc']) && strlen($data['visa_disc']) > 0) ? $data['visa_disc'] : 0);
            $total_amount_with_disc = ($total_count * ($data['visa_charge'] + $data['visa_service'])) - $disc;
            $total_amount = $total_count * ($data['visa_charge'] + $data['visa_service']);
            
            /* Update into case logs table  */
            $this->db->update('case_table',array('country_id'=>$data['visa_country'],'travel_date'=>$travel_date,'travel_from'=>$data['visa_travel_from'],'total_amount'=>$total_amount,'discount'=>$disc,'final_amount'=>$total_amount_with_disc,'adult_count'=>$data['visa_adult'],'children_count'=>$data['visa_child'],'total_count'=>$total_count,'date_status'=>$data['visa_travel_date_type']),array('case_id'=>$case_id));

            $co_related_services = implode(',',$data['co_related_services']);

            /* Insert into visa case table */
            $this->db->insert('visa_case',array('case_id'=>$case_id,'visa_type_id'=>$data['visa_type'],'visa_cost'=>$data['visa_charge'],'service_charge'=>$data['visa_service'],'doc_required'=>$data['visa_docs'],'communication'=>$data['visa_communication'],'provided_by'=>$data['provided_by'],'co_related_services'=>$co_related_services,'urgent_visa'=>$urgent_visa));

            $visa_case_id = $this->db->insert_id();

            /* Insert into visa meta tables */
            $meta_fields = array('adult_designation','invitee_designation','acceptance_date','passport');

            foreach($meta_fields as $key => $value){
                if($value == 'passport'){
                    foreach($data['passport'] as $k => $v){ foreach($v as $k1 => $v1)
                        $this->db->insert('visa_meta',array('visa_id'=>$visa_case_id,'meta_key'=>$k1,'meta_index'=>$k,'meta_value'=>$v1));
                    }
                }else
                $this->db->insert('visa_meta',array('visa_id'=>$visa_case_id,'meta_key'=>$value,'meta_value'=>$data[$value]));
            }

            /* Insert into Co-related services tables */

            foreach($data['co_related_services'] as $kc => $vc){
                $table = $kc.'_case';
                $field_id = $kc.'_id';
                $this->db->insert($table,array('case_id'=>$case_id));
            }

            /*$group_no = 'GVG-'. rand(111111,999999);
            $this->db->insert('visa_app_group',array('case_id'=>$case_id,'user_id'=>1,'group_no'=>$group_no,'visa_fee'=>$total_amount_with_disc,'app_date'=>$now_date,'adult'=>$data['visa_adult'],'children'=>$data['visa_child'],'tr_status'=>2));

            $group_id = $this->db->insert_id();

            $app_total = $data['visa_charge'] + $data['visa_service'];
            for($i = 1;$i <= $total_count; $i++){
                $app_no = 'GV-'. rand(111111,999999);
                $this->db->insert('visa_tbl',array('group_id'=>$group_id,'app_no'=>$app_no,'tr_status'=>2,'visa_fee'=>$app_total,'create_date'=>$now_date,'apply_date'=>$now_date));
            }*/

        }
            
        return true;
    }

    /* Get max case value */
    public function maxCase(){
        $data = $this->db->query('Select count(case_code) as case_count From case_table Where 1 Order by case_id desc Limit 0,1');
        return $data->first_row()->case_count;
    }

    /*To get all Cases */
    public function getAllCases(){
        $data = $this->db->query('Select case_table.*, user_group_id From case_table , users Where customer_id = id Order by case_id desc');
        if($data->num_rows() > 0){
            return $data->result_array();
        }else
        return 0;
    }
}