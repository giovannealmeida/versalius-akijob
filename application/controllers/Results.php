<?php

class Results extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model("Services_model", 'service');
        $this->load->model("City_model", 'city');
        $data["user_profile"] = $this->session->userdata('logged_in');
        // $data['jobs'] = $this->service->getJobsAll();
        // $data['citys'] = $this->city->getAllWithStateInitials();
        if ($this->input->post() == NULL || $this->input->post("selectJob") == "" || $this->input->post("selectCity") == "") {
            redirect("index");
        } else {
            $data['services'] = $this->service->getServicesByIdByCity($this->input->post('selectJob'), $this->input->post('selectCity'));
            $data['city'] = $this->city->getCityById($this->input->post('selectCity'));
        }
        $this->load->view("results", $data);
    }
}
