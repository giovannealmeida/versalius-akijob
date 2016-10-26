<?php

class Register_service extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model("Register_service_model");
        $this->load->model("State_model");
        $this->load->model("City_model");

        if ($this->input->post() != NULL) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('selectService[]', 'Serviço(s)', 'required');
            $this->form_validation->set_rules('address', 'Endereço', 'required');
            $this->form_validation->set_rules('neighborhood', 'Bairro', 'required');
            $this->form_validation->set_rules('selectState', 'Estado', 'required');
            $this->form_validation->set_rules('selectCity', 'Cidade', 'required');
            $this->form_validation->set_rules('zipCode', 'CEP', 'required');
            $this->form_validation->set_rules('latitude', 'Latitude', 'required|callback_points_maps');

            $this->form_validation->set_message('required', 'O campo %s é obrigatório');
            $this->form_validation->set_message('points_maps', 'Click no mapa para marcar sua localização');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            if ($this->form_validation->run() !== FALSE) {
                $form['id_user'] = 1;
                $form['address'] = $this->input->post('address');
                $form['number'] = $this->input->post('number');
                $form['complement'] = $this->input->post('complement');
                $form['neighborhood'] = $this->input->post('neighborhood');
                $form['id_city'] = $this->input->post('selectCity');
                $form['zip_code'] = $this->input->post('zipCode');
                $form['latitude'] = $this->input->post('latitude');
                $form['longitude'] = $this->input->post('longitude');
                $form['qualification'] = $this->input->post('qualification');
                $form['id_job'] = $this->input->post('selectService');
                if ($this->input->post('availability_fds') != NULL) {
                    $form['availability_fds'] = $this->input->post('availability_fds');
                }
                if ($this->input->post('availability_24h') != NULL) {
                    $form['availability_24h'] = $this->input->post('availability_24h');
                }
                $confirmationInsert = $this->Register_service_model->insertServices($form);
                if ($confirmationInsert) {
                    $this->session->set_flashdata("mensagem", "Cadastro realizado com sucesso");
                } else {
                    $this->session->set_flashdata("erro", "Falha ao cadastrar! Consulte administrador do sistema");
                }
                redirect('Register_service/index');
            }
        }
        $jobs = $this->Register_service_model->getJobsAll();
        $coordinates = $this->Register_service_model->getUserLatLng(3);
        $states = $this->State_model->getStatesAll();
        $data = array("jobs" => $jobs,
            "states" => $states,
            'coordinates' => $coordinates
        );

        if ($this->input->post('selectState') != NULL) {
            $data['citys'] = $this->City_model->getCityByState($this->input->post('selectState'));
        }

        $this->load->view("register_service.php", $data);
    }

    public function callback_points_maps() {
        return false;
    }

}
