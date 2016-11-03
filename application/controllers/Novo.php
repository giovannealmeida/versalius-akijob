<?php

class Novo extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function search() {
        $this->load->model("Services_model", 'service');
        $this->load->model("City_model", 'city');
        $data['jobs'] = $this->service->getJobsAll();
        $data['citys'] = $this->city->getAll();
        $this->load->view("search", $data);
    }

    public function results() {
        $this->load->model("Services_model", 'service');
        $this->load->model("City_model", 'city');
        $data['jobs'] = $this->service->getJobsAll();
        $data['citys'] = $this->city->getAll();
        if ($this->input->post() != NULL) {
            $data['services'] = $this->service->getServicesByIdByCity($this->input->post('selectJob'), $this->input->post('selectCity'));
            $data['city'] = $this->city->getCityById($this->input->post('selectCity'));
        }
        $this->load->view("results", $data);
    }

    public function foursquare() {

        $this->load->view("foursquare_boot");
    }

    public function cadastro(){
        $this->load->view("cadastro");

    }

    public function assinatura(){
        $this->load->view("assinatura");
    }

    public function senha(){
        $this->load->view("senha");
    }
}
