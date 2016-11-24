<?php

class Service extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function novo() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Subscription_model", "subs");
            $this->load->model("Services_model", 'service');

            $data["user_profile"] = $this->session->userdata('logged_in');
            $data['services'] = $this->service->getServicesByUser($data["user_profile"]->id);
            $data["premium_data"]["isPremium"] = $this->subs->isSubscribed($data["user_profile"]->id);

            if ($data["premium_data"]["isPremium"] || count($data['services']) === 0) {
                $this->load->model("State_model", 'state');
                $this->load->model("City_model", 'city');

                if ($this->input->post()) {
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
                    $data['selected_city'] = $this->city->getCityById($this->input->post('selectCity'));
                } else {
                    $data['citys'] = $this->city->getCityByState(1);
                }
                
                if ($this->input->post('selectState') != NULL) {
                    $data['citys'] = $this->city->getCityByState($this->input->post('selectState'));
                    $data['functions_scripts'] = array("setLatLng({$data['selected_city']->latitude},{$data['selected_city']->longitude});");
                }
                $data['styles'] = array(
                    base_url('assets/css/bootstrap-toggle.min.css'),
                    base_url('/assets/css/google_maps/mapsRegister.css')
                );
                $data['scripts'] = array(
                    base_url('assets/js/bootstrap-toggle.min.js'),
                    base_url('assets/js/changeCity.js'),
                    base_url('/assets/js/google_maps/mapsRegister.js'),
                    "https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js",
                    base_url("assets/js/mask.js")
                );

                if ($this->input->post('latitude')) {
                    array_push($data['functions_scripts'], "setMarker({lat: {$this->input->post('latitude')}, lng:{$this->input->post('longitude')}});");
                }
                $this->load->view("_inc/header", $data);
                $this->load->view("new_service");
                $this->load->view("_inc/footer");
            } else {
                redirect('subscribe');
            }
        }
    }

    public function edit($idService) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", 'service');
            $this->load->model("State_model", 'state');
            $this->load->model("City_model", 'city');
            $data['dataService'] = $this->service->getServicesByIdAndUser($this->session->userdata('logged_in')->id, $idService);
            if ($data['dataService']) {
                if ($this->input->post()) {
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
                $data['idState'] = $this->state->getStateByCity($data['dataService']->id_city);
                $data['citys'] = $this->city->getCityByState($data['idState']->id);
                $data["styles"] = array(
                    base_url('assets/css/bootstrap-toggle.min.css'),
                    base_url('/assets/css/google_maps/mapsRegister.css')
                );

                $data['scripts'] = array(
                    base_url('assets/js/bootstrap-toggle.min.js'),
                    base_url('assets/js/changeCity.js'),
                    base_url('/assets/js/google_maps/mapsRegister.js'),
                    "https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js",
                    base_url("assets/js/mask.js")
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
            } else {
                show_404();
            }
        }
    }

    public function toView($idService) {
        $this->load->model("Users_model", 'user');
        $this->load->model("Services_model", 'service');
        $this->load->model("State_model", 'state');
        $this->load->model("City_model", 'city');
        $this->load->model("Recommendation_model", 'recommendation');
        $this->load->model("Rating_model", 'rating');
        $this->load->model("Comments_model", 'comments');
        $this->load->model("Visits_model", "visits");
        date_default_timezone_set('America/Bahia');
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('comment', 'Nome', 'required');
            $this->form_validation->set_message('required', 'O campo %s é obrigatório');
            $form['id_service'] = $this->input->post('id_service');
            $form['id_user'] = $this->input->post('id_user');
            if ($this->form_validation->run() !== FALSE) {
                $form['comment'] = $this->input->post('comment');
                $confirmationInsertComment = $this->comments->insert($form);
                if ($confirmationInsertComment) {
                    $this->session->set_flashdata("mensagem_service", "Comentário inserido com sucesso");
                } else {
                    $this->session->set_flashdata("erro_service", "Falha ao enviar comentário! Consulte administrador do sistema");
                }
                redirect('service/toView/' . $idService);
            }
        }

////////////////////////////////////////////////

        $user_service = $this->user->getUserByService($idService);
        $data["user_profile"] = $this->user->getUserById($user_service);
        $data["user_session"] = $this->session->userdata('logged_in');
        $data['recommendations_positive'] = $this->recommendation->getRecommendationPositiveByUser($user_service);
        $data['recommendations_negative'] = $this->recommendation->getRecommendationNegativeByUser($user_service);
        $data['recommendations'] = $this->recommendation->getRecommendationByUser($user_service);
        $data['city'] = $this->city->getCityById($data["user_profile"]->id_city);
        $data['state'] = $this->state->getStateByCity($data['user_profile']->id_city);
        $data['id'] = $idService;
        $data['dataService'] = $this->service->getServicesById($idService);
        $data['portfolios'] = $this->service->getPortfoliosByUser($user_service);
        $data['comments'] = $this->comments->getCommentsByIdServices($idService, 0);


        if (isset($data["user_session"]->id) == FALSE) {
            $visit['id_user'] = NULL;
        } else {
            $visit['id_user'] = $data["user_session"]->id;
        }
        $visit['visit_date'] = date('Y-m-d H:i:s');
        $visit['id_service'] = $idService;
        $this->visits->insert($visit);

        if (isset($this->session->userdata('logged_in')->id))
            $data['rating'] = $this->rating->getRating($this->session->userdata('logged_in')->id, $user_service, $idService);
        $data["styles"] = array(
            base_url("assets/css/google_maps/mapsRegister.css"),
            base_url("assets/css/star-rating.css")
        );

        $data['scripts'] = array(
            base_url('/assets/js/google_maps/mapsServiceView.js'),
            base_url("assets/js/star-rating.js"),
            base_url('assets/js/funcoes.js'),
        );
        $data['functions_scripts'] = array(
            "setLatLng({$data['dataService']->latitude},{$data['dataService']->longitude});",
            "setMarker({lat: {$data['dataService']->latitude}, lng:{$data['dataService']->longitude}});"
        );
        $this->load->view("_inc/header", $data);
        $this->load->view("service_view");
        $this->load->view("_inc/footer");
    }

    public function portifolio($idService) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", 'services');
            $data['services'] = $this->services->getServicesByIdAndUser($this->session->userdata('logged_in')->id, $idService);
            $data['portfolios'] = $this->services->getPortfoliosByUser($this->session->userdata('logged_in')->id);
            $this->load->view("_inc/header", $data);
            $this->load->view("portifolio_list");
            $this->load->view("_inc/footer");
        }
    }

    public function portfolioNovo() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", 'services');
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('description', 'Descrição', 'required');
                if (empty($_FILES['inputFile']['name'])) {
                    $this->form_validation->set_rules('inputFile', 'Imagem', 'required');
                }

                $this->form_validation->set_message('required', 'O campo %s é obrigatório');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

                if ($this->form_validation->run() !== FALSE) {
                    $form['id_user'] = $this->session->userdata('logged_in')->id;
                    $form['description'] = $this->input->post('description');
                    $form['image'] = addslashes(file_get_contents($_FILES['inputFile']['tmp_name']));

                    $confirmation = $this->services->insertPortfolio($form);
                    if ($confirmation)
                        redirect('profile/services');
                    else
                        $this->session->set_flashdata("erro", "Falha ao enviar comentário! Consulte administrador do sistema");
                }
            }
            $data['scripts'] = array(base_url("assets/js/funcoes.js"));
            $this->load->view("_inc/header", $data);
            $this->load->view("portifolio_form");
            $this->load->view("_inc/footer");
        }
    }

    public function editPortfolio($idPortfolio) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", 'services');
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('description', 'Descrição', 'required');

                $this->form_validation->set_message('required', 'O campo %s é obrigatório');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

                if ($this->form_validation->run() !== FALSE) {
                    $form['id_user'] = $this->session->userdata('logged_in')->id;
                    $form['description'] = $this->input->post('description');
                    if (!empty($_FILES['inputFile']['name'])) {
                        $form['image'] = addslashes(file_get_contents($_FILES['inputFile']['tmp_name']));
                    }


                    $confirmation = $this->services->updatePortfolio($idPortfolio, $form);
                    if ($confirmation)
                        redirect('profile/services');
                    else
                        $this->session->set_flashdata("erro", "Falha ao enviar comentário! Consulte administrador do sistema");
                }
            }
            $data['portfolio'] = $this->services->getPortfolioById($idPortfolio);
            $data['scripts'] = array(base_url("assets/js/funcoes.js"));
            $this->load->view("_inc/header", $data);
            $this->load->view("portifolio_edit");
            $this->load->view("_inc/footer");
        }
    }

    public function deletePortfolio($idPortfolio) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", "services");
            $delete = $this->services->deletePortfolio($idPortfolio);
            if ($delete) {
                $this->session->set_flashdata("mensagem", "Portfolio excluído com sucesso");
            } else {
                show_404();
            }
            redirect('profile/services');
        }
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

    public function delete($idService) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", "services");
            $delete = $this->services->delete($this->session->userdata('logged_in')->id, $idService);
            if ($delete) {
                $this->session->set_flashdata("mensagem_service", "Serviço excluído com sucesso");
            } else {
                show_404();
            }
            redirect('profile/services');
        }
    }

    public function updateRating($idService, $value) {
        $this->load->model("Users_model", 'user');
        $this->load->model("Rating_model", 'rating');
        $user_service = $this->user->getUserByService($idService);
        $form = array('id_user' => $this->session->userdata('logged_in')->id, 'id_user_receiver' => $user_service, 'id_service' => $idService, 'value' => $value);
        $rating = $this->rating->getRating($this->session->userdata('logged_in')->id, $user_service, $idService);
        if ($rating) {
            if ($rating->value != $value)
                $this->rating->update_rating($form);
        } else {
            $this->rating->insert_rating($form);
        }
        redirect("service/toView/{$idService}");
    }

}
