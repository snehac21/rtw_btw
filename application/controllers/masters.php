<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masters extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(isset($this->session->userdata['id']) && in_array(1,$this->session->userdata['user_group_id'])){
			$this->load->library('grocery_CRUD');
		}/*else{
			//show_403();
		}*/
	}
	function _example_output($output = null)
    {
		$this->load->view('layout/header');  
		$this->load->view('layout/menu');
		$this->load->view('example',$output);
		$this->load->view('layout/footer');
    }
	
	function country_management()
	{
	    $crud = new grocery_CRUD();
	 
	    $crud->set_table('country_master');
	    $crud->set_subject('Country');
	    $crud->columns('country','oktb_required','visa_flag','currency','currency_rupee_cost','status');
	    $crud->fields('country','oktb_required','visa_flag','currency','currency_rupee_cost','status');
	    $crud->required_fields('country','oktb_required','visa_flag','currency','currency_rupee_cost');
	 
	    $crud->set_primary_key('country_id','country_master');
	    //$crud->set_relation('country','countries','country_title');
	 
	    $output = $crud->render(array('name' => 'Country Management'));
	 
	    $this->_example_output($output);
	}

	function state_management()
	{
	    $crud = new grocery_CRUD();
	 
	    $crud->set_table('state_master');
	    $crud->set_subject('State');
	 	$crud->columns('state_name','country_id','status');
	    $crud->fields('state_name','country_id','status');
	    $crud->required_fields('state_name','country_id');
	    $crud->display_as('country_id','Country');
	    $crud->set_primary_key('country_id','country_master');
	    $crud->set_relation('country_id','country_master','country');
	 
	    $output = $crud->render(array('name' => 'State Management'));
	 
	    $this->_example_output($output);
	}
	function city_management()
	{
	    $crud = new grocery_CRUD();
	 
	    $crud->set_table('city_master');
	    $crud->set_subject('City');
	 	$crud->columns('city','state_id','status');
	    $crud->fields('city','state_id','status');
	    $crud->required_fields('city','state_id');
	    $crud->display_as('state_id','State');
	    $crud->set_primary_key('state_id','state_master');
	    $crud->set_relation('state_id','state_master','state_name');
	 
	    $output = $crud->render(array('name' => 'City Management'));
	 
	    $this->_example_output($output);
	}

	function designation_management()
	{
	    $crud = new grocery_CRUD();
	 
	    $crud->set_table('designation_master');
	    $crud->set_subject('Designation');
	 	$crud->columns('designation','status');
	    $crud->fields('designation','status');
	    $crud->required_fields('designation');
	    $output = $crud->render(array('name' => 'Designation Management'));
	    $this->_example_output($output);
	}
 
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */