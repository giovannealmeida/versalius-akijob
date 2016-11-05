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
            $this->form_validation->set_rules('selectJob', 'Serviço', 'required');
            $this->form_validation->set_rules('street', 'Rua', 'required');
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
                $form['street'] = $this->input->post('street');
                $form['number'] = $this->input->post('number');
                $form['complement'] = $this->input->post('complement');
                $form['neighborhood'] = $this->input->post('neighborhood');
                $form['id_city'] = $this->input->post('selectCity');
                $form['zip_code'] = $this->input->post('zipCode');
                $form['latitude'] = $this->input->post('latitude');
                $form['longitude'] = $this->input->post('longitude');
                $form['skills'] = $this->input->post('skills');
                $form['id_job'] = $this->input->post('selectJob');
                if ($this->input->post('availability_fds') != NULL) {
                    $form['availability_fds'] = $this->input->post('availability_fds');
                }
                if ($this->input->post('availability_24h') != NULL) {
                    $form['availability_24h'] = $this->input->post('availability_24h');
                }
                $confirmationInsert = $this->service->insert($form);
                if ($confirmationInsert) {
                    $this->session->set_flashdata("mensagem_service", "Cadastro realizado com sucesso");
                } else {
                    $this->session->set_flashdata("erro_service", "Falha ao cadastrar! Consulte administrador do sistema");
                }
                redirect('profile');
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
        $data['styles'] = array(
            base_url('assets/css/bootstrap-toggle.min.css'),
            base_url('/assets/css/google_maps/mapsRegister.css')
        );
        $data['scripts'] = array(
            base_url('assets/js/bootstrap-toggle.min.js'),
            base_url('assets/js/changeCity.js'),
            base_url('/assets/js/google_maps/mapsRegister.js')
        );
        $data['functions_scripts'] = array(
            "setLatLng({$data['coordinates']->latitude},{$data['coordinates']->longitude});"
        );

        if ($this->input->post('latitude')) {
            array_push($data['functions_scripts'], "setMarker({lat: {$this->input->post('latitude')}, lng:{$this->input->post('longitude')}});");
        }
        $this->load->view("_inc/header", $data);
        $this->load->view("new_service");
        $this->load->view("_inc/footer");
    }

    public function edit($idService) {
        $this->load->model("Services_model", 'service');
        $this->load->model("State_model", 'state');
        $this->load->model("City_model", 'city');

        if ($this->input->post() != NULL) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('selectJob', 'Serviço', 'required');
            $this->form_validation->set_rules('street', 'Rua', 'required');
            $this->form_validation->set_rules('neighborhood', 'Bairro', 'required');
            $this->form_validation->set_rules('selectState', 'Estado', 'required');
            $this->form_validation->set_rules('selectCity', 'Cidade', 'required');
            $this->form_validation->set_rules('zipCode', 'CEP', 'required');
            $this->form_validation->set_rules('latitude', 'Latitude', 'required|callback_points_maps');

            $this->form_validation->set_message('required', 'O campo %s é obrigatório');
            $this->form_validation->set_message('points_maps', 'Click no mapa para marcar sua localização');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            if ($this->form_validation->run() !== FALSE) {
                //print_r($this->input->post());die;
                $form['street'] = $this->input->post('street');
                $form['number'] = $this->input->post('number');
                $form['complement'] = $this->input->post('complement');
                $form['neighborhood'] = $this->input->post('neighborhood');
                $form['id_city'] = $this->input->post('selectCity');
                $form['zip_code'] = $this->input->post('zipCode');
                $form['latitude'] = $this->input->post('latitude');
                $form['longitude'] = $this->input->post('longitude');
                $form['skills'] = $this->input->post('skills');
                $form['id_job'] = $this->input->post('selectJob');
                if ($this->input->post('availability_fds') != NULL) {
                    $form['availability_fds'] = $this->input->post('availability_fds');
                } else {
                    $form['availability_fds'] = 0;
                }
                if ($this->input->post('availability_24h') != NULL) {
                    $form['availability_24h'] = $this->input->post('availability_24h');
                } else {
                    $form['availability_24h'] = 0;
                }
                $confirmationUpdate = $this->service->update($idService, $form);
                if ($confirmationUpdate) {
                    $this->session->set_flashdata("mensagem_service", "Atualização realizada com sucesso");
                } else {
                    $this->session->set_flashdata("erro_service", "Falha ao atualizar! Consulte administrador do sistema");
                }
                redirect('profile');
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
        $data['idState'] = $this->state->getStateByCity($data['dataService']->id_city);
        $data['citys'] = $this->city->getCityByState($data['idState']->id);
        $data["styles"] = array(
            base_url('assets/css/bootstrap-toggle.min.css'),
            base_url('/assets/css/google_maps/mapsRegister.css')
        );

        $data['scripts'] = array(
            base_url('assets/js/bootstrap-toggle.min.js'),
            base_url('assets/js/changeCity.js'),
            base_url('/assets/js/google_maps/mapsRegister.js')
        );
        $data['functions_scripts'] = array(
            "setLatLng({$data['dataService']->latitude},{$data['dataService']->longitude});",
            "setMarker({lat: {$data['dataService']->latitude}, lng:{$data['dataService']->longitude}});"
        );

        if ($this->input->post('latitude')) {
            array_push($data['functions_scripts'], "setMarker({lat: {$this->input->post('latitude')}, lng:{$this->input->post('longitude')}});");
        }

        $this->load->view("_inc/header", $data);
        $this->load->view("new_service");
        $this->load->view("_inc/footer");
    }

    public function toView($idService) {
        $this->load->model("Services_model", 'service');
        $this->load->model("State_model", 'state');
        $this->load->model("City_model", 'city');
        $data["user_profile"] = $this->session->userdata('logged_in');
        $data['recommendations'] = $data["user_profile"]->positive_recommendations - $data["user_profile"]->negative_recommendations;
        $data['city'] = $this->city->getCityById($data["user_profile"]->id_city);
        $data['state'] = $this->state->getStateByCity($data['user_profile']->id_city);
        $data['id'] = $idService;
        $data['dataService'] = $this->service->getServicesById($idService);
        $data['portfolios'] = $this->service->getPortfoliosByUser($data["user_profile"]->id);
        $data["styles"] = array(
            base_url("assets/css/google_maps/mapsRegister.css")
        );

        $data['scripts'] = array(
            base_url('/assets/js/google_maps/mapsRegister.js')
        );
        $data['functions_scripts'] = array(
            "setLatLng({$data['dataService']->latitude},{$data['dataService']->longitude});",
            "setMarker({lat: {$data['dataService']->latitude}, lng:{$data['dataService']->longitude}});"
        );
        $this->load->view("_inc/header", $data);
        $this->load->view("service_view");
        $this->load->view("_inc/footer");
    }

    public function points_maps() {
        if ($this->input->post('latitude') == NULL)
            return FALSE;
        else
            return TRUE;
    }

    public function cancel() {
        redirect('profile');
    }

    public function delete($id) {
        $this->load->model("Services_model", "services");
        $delete = $this->services->delete($id);
        if ($delete) {
            $this->session->set_flashdata("mensagem_service", "Serviço excluído com sucesso");
        } else {
            $this->session->set_flashdata("erro_service", "Falha ao excluir! Consulte administrador do sistema");
        }
        redirect('profile');
    }

}
