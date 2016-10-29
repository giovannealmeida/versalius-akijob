<?php

class Service extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function novo() {
        $data["user_profile"] = $this->session->userdata('logged_in');
        $this->load->model("Services_model", 'service');
        $this->load->model("State_model", 'state');
        $this->load->model("City_model", 'city');

        if ($this->input->post() != NULL) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('selectService', 'Serviço(s)', 'required');
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
                $form['id_user'] = $this->session->userdata('logged_in')->id;
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
                $confirmationInsert = $this->service->insert($form);
                if ($confirmationInsert) {
                    $this->session->set_flashdata("mensagem", "Cadastro realizado com sucesso");
                } else {
                    $this->session->set_flashdata("erro", "Falha ao cadastrar! Consulte administrador do sistema");
                }
                redirect('profile/services');
            }
        }
        $data['id'] = NULL;
        $data['title'] = 'Cadastrar';
        $data['action'] = 'novo';
        $data['titleAction'] = 'Cadastar';
        $data['jobs'] = $this->service->getJobsAll();
        $data['coordinates'] = $this->service->getUserLatLng($this->session->userdata('logged_in')->id);
        $data['states'] = $this->state->getAll();
        if ($this->input->post('selectState') != NULL) {
            $data['citys'] = $this->city->getCityByState($this->input->post('selectState'));
        } else {
            $data['citys'] = $this->city->getCityByState(1);
        }

        $this->load->view("service.php", $data);
    }

    public function edit($idService) {
        $this->load->model("Services_model", 'service');
        $this->load->model("State_model", 'state');
        $this->load->model("City_model", 'city');

        if ($this->input->post() != NULL) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('selectService', 'Serviço(s)', 'required');
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
                }else{
                    $form['availability_fds'] = 0;
                }
                if ($this->input->post('availability_24h') != NULL) {
                    $form['availability_24h'] = $this->input->post('availability_24h');
                }else{
                    $form['availability_24h'] = 0;
                }
                $confirmationUpdate = $this->service->update($idService, $form);
                if ($confirmationUpdate) {
                    $this->session->set_flashdata("mensagem", "Atualização realizada com sucesso");
                } else {
                    $this->session->set_flashdata("erro", "Falha ao atualizar! Consulte administrador do sistema");
                }
                redirect('profile/services');
            }
        }
        $data['id'] = $idService;
        $data['title'] = 'Editar';
        $data['action'] = 'edit';
        $data['titleAction'] = 'Atualizar';
        $data['jobs'] = $this->service->getJobsAll();
        $data['coordinates'] = $this->service->getUserLatLng($this->session->userdata('logged_in')->id);
        $data['states'] = $this->state->getAll();
        $data['dataService'] = $this->service->getServicesById($idService);
        $data['idState'] = $this->city->getStateByCity($data['dataService']->id_city);
        $data['citys'] = $this->city->getCityByState($data['idState']);

        $this->load->view("service.php", $data);
    }

    public function points_maps() {
        if ($this->input->post('latitude') == NULL)
            return FALSE;
        else
            return TRUE;
    }

    public function cancel() {
        redirect('profile/services');
    }

}