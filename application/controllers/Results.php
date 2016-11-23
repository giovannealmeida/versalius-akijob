<?php

class Results extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model("Services_model", 'service');
        $this->load->model("City_model", 'city');
        $this->load->model("Recommendation_model", 'recommendation');
        $data["user_profile"] = $this->session->userdata('logged_in');
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('selectJob', 'Serviços', 'required');
            $this->form_validation->set_rules('selectCity', 'Cidade', 'required');

            $this->form_validation->set_message('required', 'Preencha todos os campos para pesquisar');

            if ($this->form_validation->run() !== FALSE) {
                $idService = $this->input->post('selectJob');
                $idCity = $this->input->post('selectCity');
            }else{
                $this->session->set_flashdata("erro", "Preencha todos os campos para pesquisar");
                redirect('index');
            }
        }
        $data['idService'] = $idService;
        $data['idCity'] = $idCity;
        $data['services'] = $this->service->getServicesByIdByCity($idService, $idCity);
        $data['city'] = $this->city->getCityById($idCity);
        $this->load->view("results", $data);
    }

}
