<?php
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
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Case_model');
    }

	public function index()
	{
		$this->load->view('layout/content');
	}
	
	public function caseForm()
	{
		//$getCustomers = $this->Case_model->getCustomers();
		$data['content'] = 'case_form';
		$this->load->view('layout/content',$data);
	}

	public function addUser()
	{
		$data['content'] = 'add_user';
		$this->load->view('layout/content',$data);
	}

	public function saveUser()
	{
		//$getCustomers = $this->Case_model->getCustomers();
		$error = array();
		//print_r($this->input->post());
		if(strlen($this->input->post('user_name')) > 0 ){
			$chk_uname = $this->Case_model->isUniqueUname($this->input->post('user_name'));
			if($chk_uname == 1)
			$error['err_uname'] = 'Username already exist';
		}

		if(strlen($this->input->post('user_email')) > 0){
			$chk_email = $this->Case_model->isUniqueEmail($this->input->post('user_email'));
			if($chk_email == 1)
			$error['err_email'] = 'Email Id already exist';
		}

		if(count($error) == 0 ){
			//print_r($this->input->post()); exit;

			$user_type = $this->input->post('user_type');
			$max = $this->Case_model->maxUserVal($user_type);
			$max = ($max == 0) ? 1 : ((strlen($max) == 1) ? ('00'.($max+1)) : ('0'.($max+1)));
			if($user_type == 4) $code = 'A'.$max ;
			else if($user_type == 5) $code = 'C'. $max;
			else $code = 'W'. $max;
			$data = $this->input->post();
			$data = array_merge(array("code"=>$code),$data);
			$this->Case_model->saveUser($data);
			echo 1;
		}else
		echo json_encode($error);
		exit;

	}

	public function getCustomer()
	{
		$json = array();
		$results = $this->Case_model->getCustomers($_REQUEST['value']);
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

	public function getCustomerVal()
	{
		$json = array();
		if(isset($_POST['cust_id'])){
			$results = $this->Case_model->getCustomerVal($_POST['cust_id']);
			if($results != 0){
				foreach ($results as $result) {
					$json[] = array(
						'user_id' => $result['id'],
						'uname'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
						'contact'    => strip_tags(html_entity_decode($result['contact_no'], ENT_QUOTES, 'UTF-8')),
						'email'      => strip_tags(html_entity_decode($result['email'], ENT_QUOTES, 'UTF-8')),
						'utype'       => strip_tags(html_entity_decode($result['user_group_id'], ENT_QUOTES, 'UTF-8')),
					);
				}
				echo json_encode($json);
			}else
		echo 0;
		}else
		echo 0;
	}

}
