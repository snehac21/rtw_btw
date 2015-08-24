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

$this->load->view('layout/menu');
if(isset($content)) 
$this->load->view($content);
$this->load->view('layout/footer');

 ?>