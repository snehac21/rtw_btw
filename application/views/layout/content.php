<?php 
$this->load->view('layout/header');  
$this->load->view('layout/menu');
if(isset($content)) 
$this->load->view($content);
$this->load->view('layout/footer');
 ?>