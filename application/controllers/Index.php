<?php

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model("Services_model", 'service');
        $this->load->model("City_model", 'city');
        $data["user_profile"] = $this->session->userdata('logged_in');
        $data['jobs'] = $this->service->getJobsAll();
        // $data['citys'] = $this->city->getAllWithStateInitials();
        $data["scripts"] = array(
            base_url("assets/js/ajax-bootstrap-select.min.js"),
            base_url("assets/js/search.js")

        );
        $this->load->view("_inc/header", $data);
        $this->load->view("search");
        $this->load->view("_inc/footer");
    }

}
