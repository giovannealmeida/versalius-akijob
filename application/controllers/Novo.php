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

    public function profile() {
        $this->load->model("Subscription_model", "subs");
        $this->load->model("Services_model", "services");
        $this->load->model("Users_model", "user");
        $this->load->model("City_model", 'city');
        $this->load->model("State_model", 'state');

        $data["user_profile"] = $this->session->userdata('logged_in');
        $data["premium_data"]["isPremium"] = $this->subs->isSubscribed($data["user_profile"]->id);
        $data['services'] = $this->services->getServicesByUser($data["user_profile"]->id);

        $data['city'] = $this->city->getCityById($data["user_profile"]->id_city);
        $data['state'] = $this->state->getStateByCity($data['user_profile']->id_city);

        $this->load->view("profile", $data);
    }

}
