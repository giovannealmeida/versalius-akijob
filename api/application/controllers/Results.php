<?php

class Results extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (isset($this->session->userdata('logged_in')->id_status) && $this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        }
    }

    public function index() {
        if ($this->input->post()) {
            $this->load->model("Services_model", 'service');
            $this->load->model("City_model", 'city');
            $this->load->model("Recommendation_model", 'recommendation');
            $this->load->model("Users_model", 'users');
            $data["user_profile"] = $this->session->userdata('logged_in');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('selectJob', 'Serviços', 'required');
            $this->form_validation->set_rules('selectCity', 'Cidade', 'required');

            $this->form_validation->set_message('required', 'Preencha todos os campos para pesquisar');

            if ($this->form_validation->run() !== FALSE) {
                $idService = $this->input->post('selectJob');
                $idCity = $this->input->post('selectCity');
            } else {
                $this->session->set_flashdata("erro", "Preencha todos os campos para pesquisar");
                redirect('index');
            }
            $data['idService'] = $idService;
            $data['idCity'] = $idCity;
            $data['services'] = $this->service->getServicesByIdByCity($idService, $idCity);
            if (count($data["services"]) > 0) {
                foreach ($data["services"] as $service) {
                    $data["tier_url"][$service->id] = $this->users->getTierImage($service->id_user, $service->saldo, true);
                }
            }
            $data['city'] = $this->city->getCityById($idCity);
            $this->load->view("results", $data);
        } else {
            redirect('index');
        }
    }

}
