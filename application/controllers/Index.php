<?php

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (isset($this->session->userdata('logged_in')->id_status) && $this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        }
    }

    public function index() {
        $data["user_profile"] = $this->session->userdata('logged_in');
        $data["scripts"] = array(
            base_url("assets/js/ajax-bootstrap-select.min.js"),
            base_url("assets/js/search.js")
        );
        $data["styles"] = array(base_url('assets/css/akijob.css'));
        $this->load->view("_inc/header", $data);
        $this->load->view("search");
        $this->load->view("_inc/footer");
    }

}
