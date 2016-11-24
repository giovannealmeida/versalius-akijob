<?php

class About extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (isset($this->session->userdata('logged_in')->id_status) && $this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        }
    }

    public function terms() {
        $this->load->view("_inc/header");
        $this->load->view("terms");
        $this->load->view("_inc/footer");
    }

}

?>