<?php 
get_instance()->load->helper('global_helper');
$this->load->view('layout/header');  
/*load  js specific to particular view */
if(isset($js))
{
	//echo '<pre>'; print_r($js); exit;
	foreach($js as $single_js)
	{
		echo '<script type="text/javascript" src="'.base_url().'public/scripts/'.$single_js.'"></script>';
	}
}
/*load css specific to particular view */
if(isset($css))
{
	foreach($css as $single_css)
	{
		echo '<link rel="stylesheet" href="'.base_url().'public/styles/'.$single_css.'"/>';
	}
}

/*load js specific to particular view */
if(isset($files_js))
{
	foreach($files_js as $single_files)
	{
		echo '<script type="text/javascript" src="'.base_url().'public/'.$single_files.'"></script>';
	}
}

/*load css specific to particular view */
if(isset($files_css))
{
	foreach($files_css as $single_files)
	{
		echo '<link rel="stylesheet" href="'.base_url().'public/'.$single_files.'"/>';
	}
}
if($this->session->userdata('user_group_id'))
$this->load->view('layout/menu');

if(isset($content)) 
$this->load->view($content);
$this->load->view('layout/footer');

 ?>