<?php

/**
	Created on : 2015-07-25
	Created By : Sunita Mistry
	Purpose : Controller file containing functions to save Inquiries , add Users etc 
	Filename : Cases.php
**/

defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct()
    {
        parent::__construct();
        // Call the Model constructor
        $this->load->model('case_model');
        $this->load->helper('global_helper');
    }

	public function index()
	{
		$this->load->view('layout/content');
	}
	
	/* Function to load Case Form */
	public function caseForm()
	{
		$data['js'] = array('custom/inquiry_form.js', 'custom/add_user.js');
		$data['css'][] = 'custom.css';
		$data['product_type_master'] = get_dropdown_value('product_type_master','pt_id','product_type');
		$data['designation_master'] = get_dropdown_value('designation_master','design_id','designation');
		$data['pp_issue_state_master'] = get_dropdown_value('pp_issue_state_master','issue_id','issue');
		$data['country_master'] = get_dropdown_value('country_master','country_id','country');
		$data['user_type_arr'] = get_dropdown_value('user_groups','id','name','allowRegistration=1');
		
		$data['content'] = 'case_form';
		$this->load->view('layout/content',$data);
	}

	/* Function to load Add User Form */
	public function addUser()
	{
		$data['content'] = 'add_user';
		$this->load->view('layout/content',$data);
	}

	/* Function to save New user info */
	public function saveUser()
	{
		$error = array();
		
		/** Check unique Username **/
		if(strlen($this->input->post('user_name')) > 0 ){
			$chk_uname = $this->case_model->isUniqueUname($this->input->post('user_name'));
			if($chk_uname == 1)
			$error['err_uname'] = 'Username already exist';
		}

		/** Check unique User Email **/
		if(strlen($this->input->post('user_email')) > 0){
			$chk_email = $this->case_model->isUniqueEmail($this->input->post('user_email'));
			if($chk_email == 1)
			$error['err_email'] = 'Email Id already exist';
		}

		/** If no error exist **/
		if(count($error) == 0 ){

			$user_type = $this->input->post('user_type');
			$max = $this->case_model->maxUserVal($user_type);
			$max = ($max == 0) ? '001' : ((strlen($max) == 1) ? ('00'.($max+1)) : ('0'.($max+1)));
			if($user_type == 4) $code = 'A'.$max ;
			else if($user_type == 5) $code = 'C'. $max;
			else $code = 'W'. $max;
			$data = $this->input->post();
			$data = array_merge(array("code"=>$code),$data);
			$this->case_model->saveUser($data);
			echo 1;
		}else
		echo json_encode($error);
		exit;

	}

	/** To get Customers by filter **/
	public function getCustomer()
	{
		$json = array();
		$results = $this->case_model->getCustomers($_REQUEST['value']);
		if($results != 0){
			foreach ($results as $result) {
				$json[] = array(
					'user_id' => $result['id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
				);
			}
		}

		echo json_encode($json);
	}

	/** To get Cusomer Info by Cusomer ID **/
	public function getCustomerVal()
	{
		$json = array();
		if(isset($_POST['cust_id'])){
			$results = $this->case_model->getCustomerVal($_POST['cust_id']);
			if($results != 0){
				foreach ($results as $result) {

					$options = array('' => 'Select User Type','4'=> 'Agent','5'=> 'Corporate','6'=> 'Walkin');

					$json[] = array(
						'user_id' => $result['id'],
						'uname'      => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
						'contact'    => strip_tags(html_entity_decode($result['contact_no'], ENT_QUOTES, 'UTF-8')),
						'email'      => strip_tags(html_entity_decode($result['email'], ENT_QUOTES, 'UTF-8')),
						'utype'      => strip_tags(html_entity_decode($options[$result['user_group_id']], ENT_QUOTES, 'UTF-8')),
						'code'       => strip_tags(html_entity_decode($result['usercode'], ENT_QUOTES, 'UTF-8')),
					);
				}
				echo json_encode($json);
			}else
		echo 0;
		}else
		echo 0;
	}

	/** To get Countrywise Visa Types and Cities dropdown values **/
	public function countrywiseVal()
	{
		$data = array();
		if(isset($_POST['country_id'])){
			
			$data['visa_type_master'] = get_dropdown_value('visa_type_master','visa_type_id','visa_type','country_id = "' . $_POST['country_id'] . '"');
			$html['visa'] = '<select name="visa_type" class="form-control m-b" onchange = "visaVal(this.value)"><option value = "">Select Visa Type</option>';
				if(count($data['visa_type_master']) > 0){
					foreach ($data['visa_type_master'] as $key => $value) {
						$html['visa'] .= '<option value = "'.$key.'">'.$value.'</option>';
					}
				}else{
					$html['visa'] .= '<option value = " ">Select</option>';
				}
			$html['visa'] .= "</select>";



			$html['oktb_required'] = $this->case_model->get_oktb_status($_POST['country_id']);

			echo json_encode($html);
			//print_r($visa_type_master); exit;
		}else echo 0;
	}

	/** to get state  dropdown countrywise **/
	public function countrywiseState()
	{
		$html['state'] = '<option value="">Select State</option>';
		if(isset($_POST['country_id']) and strlen($_POST['country_id']) > 0){
		$states = get_dropdown_value('state_master','state_id','state_name','country_id = "' . $_POST['country_id'] . '"');
		
				if(count($states) > 0){
					foreach ($states as $key => $value) {
						$html['state'] .= '<option value = "'.$key.'">'.$value.'</option>';
					}
				}
		}

		echo json_encode($html);
	}

	/** to get city  dropdown statewise **/
	public function statewiseCity()
	{
		$html['city'] = '<option value="">Select City</option>';
		if(isset($_POST['state_id']) and strlen($_POST['state_id']) > 0){
		$states = get_dropdown_value('city_master','city_id','city','state_id = "' . $_POST['state_id'] . '"');
		
				if(count($states) > 0){
					foreach ($states as $key => $value) {
						$html['city'] .= '<option value = "'.$key.'">'.$value.'</option>';
					}
				}
		}

		echo json_encode($html);
	}


	/** To get Visa values **/
	public function visaInfoByVisaId()
	{
		$data = array();
		if(isset($_POST['visa_id'])){
			
			$visa_info = $this->case_model->get_visa_value($_POST['visa_id']);
			//print_r($visa_info->other_services); exit;

			echo json_encode($visa_info); 
           			
		}else echo 0;
	}

		/** To get Visa values **/
	public function visaCoRelatedServices()
	{
		$data = array();
		if(isset($_POST['visa_id'])){
			
			$visa_info = $this->case_model->get_visa_value($_POST['visa_id']);
			//print_r($visa_info->other_services); exit;

			$html  = '';

			if(isset($visa_info->other_services) && strlen($visa_info->other_services) > 0){

				$other_services = explode(',',$visa_info->other_services); $j = 1;
				foreach($other_services as $os){
					if($j > 3) $j = 1;

					$os_val = get_dropdown_value('product_type_master','pt_id','pt_code','pt_id = "' . $os . '"');
					foreach($os_val as $k => $v){

						$small_case = str_replace(' ','_', $v);
						$small_case = strtolower($small_case);
						if($j == 1 ) $html .= "<tr>";
						$html .= '<td><div class="checkbox checkbox-info checkbox-inline"><input checked = "checked" type="checkbox" value="'. $k .'" name="co_related_services['. $small_case .']"><label for="inlinecheckbox1"> '. strtoupper($v) .' </label></div></td>';
						if($j == 3) $html .= "</tr>";
					}
					$j++;
				}
			}
           
			echo $html;
			
		}else echo 0;
	}

	/** To save Cases **/
	public function saveCases()
	{
		$data = array();
		if($this->input->post())
		    {
		    	//print_r($_POST); exit;
			$max = $this->case_model->maxCase();
			$max = ($max == 0) ? '001' : ((strlen($max) == 1) ? ('00'.($max+1)) : ('0'.($max+1)));
			
			$code = "BTW".$max;
			$data = $this->input->post();
			$data = array_merge(array("case_code"=>$code),$data);
			$visa_info = $this->case_model->saveCases($data);

			echo 1;
		}else echo 0;
	}
}
