<?php
	class About extends CI_Controller{
		public function __construct() {
        	parent::__construct();
    	}
		
		public function terms(){
			$this->load->view("_inc/header");
        	$this->load->view("terms");
        	$this->load->view("_inc/footer");
		}
	}
?>