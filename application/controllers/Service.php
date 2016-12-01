<?php

class Service extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*
     * Novo serviço
     */

    public function novo() {
        //Verifica se o usuário está logado e ativo
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

            //Verifica se o usuário é premium ou se não há serviços cadastrados
            if ($data["premium_data"]["isPremium"] || count($data['services']) === 0) {
                $this->load->model("State_model", 'state');
                $this->load->model("City_model", 'city');

                if ($this->input->post()) {

                    //validação CodeIgniter
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

                //verifica se algum estado foi selecionado para carregar a cidade escolhida e centralizar o mapa na cidade correspodente caso a a validação falhe
                if ($this->input->post('selectState') != NULL) {
                    $data['selected_city'] = $this->city->getCityById($this->input->post('selectCity'));
                    $data['citys'] = $this->city->getCityByState($this->input->post('selectState'));
                    $data['functions_scripts'] = array("setLatLng({$data['selected_city']->latitude},{$data['selected_city']->longitude});");
                } else {
                    $data['citys'] = $this->city->getCityByState(1);
                }

                //Carrega os styles para página
                $data['styles'] = array(
                    base_url('assets/css/bootstrap-toggle.min.css'),
                    base_url('/assets/css/google_maps/mapsRegister.css')
                );

                //carrega os scripts para página
                $data['scripts'] = array(
                    base_url('assets/js/bootstrap-toggle.min.js'),
                    base_url('assets/js/changeCity.js'),
                    base_url('/assets/js/google_maps/mapsRegister.js'),
                    "https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js",
                    base_url("assets/js/mask.js"),
                    base_url("assets/js/validator.js")
                );

                //Verifica se houve alguma marcação no mapa antes do submit e se sim carrega a marcação caso a validação falhe
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

    /*
     * Editar serviço
     */

    public function edit($idService) {
        //Verifica se o usuário está logado e ativo
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", 'service');
            $this->load->model("State_model", 'state');
            $this->load->model("City_model", 'city');
            $data['dataService'] = $this->service->getServicesByIdAndUser($this->session->userdata('logged_in')->id, $idService);
            //Verifica se o serviço a ser editado é do usuário que está logado
            if ($data['dataService']) {
                if ($this->input->post()) {
                    //validação CodeIgniter
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

                //Carrega os styles para página
                $data["styles"] = array(
                    base_url('assets/css/bootstrap-toggle.min.css'),
                    base_url('/assets/css/google_maps/mapsRegister.css')
                );

                //carrega os scripts para página
                $data['scripts'] = array(
                    base_url('assets/js/bootstrap-toggle.min.js'),
                    base_url('assets/js/changeCity.js'),
                    base_url('/assets/js/google_maps/mapsRegister.js'),
                    "https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js",
                    base_url("assets/js/mask.js"),
                    base_url("assets/js/validator.js")
                );

                //carrega as funções js para página
                $data['functions_scripts'] = array(
                    "setLatLng({$data['dataService']->latitude},{$data['dataService']->longitude});",
                    "setMarker({lat: {$data['dataService']->latitude}, lng:{$data['dataService']->longitude}});"
                );

                //Verifica se houve alguma marcação no mapa antes do submit e se sim carrega a marcação caso a validação falhe
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

    /*
     * Deleta Serviço
     */

    public function delete($idService) {
        //Verifica se o usuário está logado e ativo
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", "services");
            $delete = $this->services->delete($this->session->userdata('logged_in')->id, $idService);
            //verifica se o serviço foi deletado no banco com sucesso
            if ($delete) {
                $this->session->set_flashdata("mensagem_service", "Serviço excluído com sucesso");
            } else {
                show_404();
            }
            redirect('profile/services');
        }
    }

    /*
     * Visualizar anúncio
     */

    public function toView($idService) {
        $this->load->model("Services_model", 'service');
        $data['dataService'] = $this->service->getServicesById($idService);

        //verifica se o serviço existe

        if ($data['dataService']) {
            $this->load->model("Users_model", 'user');
            $this->load->model("State_model", 'state');
            $this->load->model("City_model", 'city');
            $this->load->model("Recommendation_model", 'recommendation');
            $this->load->model("Rating_model", 'rating');
            $this->load->model("Comments_model", 'comments');
            $this->load->model("Visits_model", "visits");
            date_default_timezone_set('America/Bahia');
            if ($this->input->post()) {
                //validação CodeIgniter
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


            $this->load->model("Subscription_model", "subs");
            $user_service = $this->user->getUserByService($idService);
            $data["user_profile"] = $this->user->getUserById($user_service);
            $data["user_session"] = $this->session->userdata('logged_in');
            $data['recommendations_positive'] = $this->recommendation->getRecommendationPositiveByUser($user_service);
            $data['recommendations_negative'] = $this->recommendation->getRecommendationNegativeByUser($user_service);
            $data["premium_data"]["isPremium"] = $this->subs->isSubscribed($user_service);
            $data['city'] = $this->city->getCityById($data["user_profile"]->id_city);
            $data['state'] = $this->state->getStateByCity($data['user_profile']->id_city);
            $data['id'] = $idService;
            $data['portfolios'] = $this->service->getPortfoliosByService($idService);
            $data['comments'] = $this->comments->getCommentsByIdServices($idService, 0);


            //Verifica se o usuário está logado para poder pegar o id do visitante e carregar suas recomendaçoes e notas ao anúncio
            if (!isset($data["user_session"]->id)) {
                $visit['id_user'] = NULL;
            } else {
                $visit['id_user'] = $data["user_session"]->id;
                $data['recommendation'] = $this->recommendation->getRecommendation($this->session->userdata('logged_in')->id, $user_service);
                $data['rating'] = $this->rating->getRating($this->session->userdata('logged_in')->id, $user_service, $idService);
            }
            $visit['visit_date'] = date('Y-m-d H:i:s');
            $visit['id_service'] = $idService;
            $this->visits->insert($visit);

            //Carrega os styles para página
            $data["styles"] = array(
                base_url("assets/css/google_maps/mapsRegister.css"),
                base_url("assets/css/star-rating.css"),
                base_url("assets/css/blueimp-gallery.min.css"),
            );

            //carrega os scripts para página
            $data['scripts'] = array(
                base_url('/assets/js/google_maps/mapsServiceView.js'),
                base_url("assets/js/star-rating.js"),
                base_url('assets/js/funcoes.js'),
                base_url('assets/js/blueimp-gallery.min.js'),
                base_url('assets/js/portfolio-gallery.js'),
            );

            //carrega as funções js para página
            $data['functions_scripts'] = array(
                "setLatLng({$data['dataService']->latitude},{$data['dataService']->longitude});",
                "setMarker({lat: {$data['dataService']->latitude}, lng:{$data['dataService']->longitude}});"
            );
            $this->load->view("_inc/header", $data);
            $this->load->view("service_view");
            $this->load->view("_inc/footer");
        } else {
            show_404();
        }
    }

    /*
     * Carrega o portfolio
     */

    public function portfolio($idService) {
        //Verifica se o usuário está logado e ativo
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", 'services');
            $data['services'] = $this->services->getServicesByIdAndUser($this->session->userdata('logged_in')->id, $idService);
            $data['portfolios'] = $this->services->getPortfoliosByService($idService);
            $data["idService"] = $idService;
            $this->load->view("_inc/header", $data);
            $this->load->view("portifolio_list");
            $this->load->view("_inc/footer");
        }
    }

    /*
     * Novo portfolio
     */

    public function portfolioNovo($idService) {
        //Verifica se o usuário está logado e ativo
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } elseif ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } elseif ($idService == "") {
            redirect("profile");
        } else {
            $this->load->model("Services_model", 'services');
            if ($this->input->post()) {
                //validação CodeIgniter
                $this->load->library('form_validation');
                $this->form_validation->set_rules('description', 'Descrição', 'required');
                $this->form_validation->set_rules('inputFile', 'imagem', 'callback_validate_image');

                $this->form_validation->set_message('required', 'O campo %s é obrigatório');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

                if ($this->form_validation->run()) {
                    $form['id_service'] = $idService;
                    $form['description'] = $this->input->post('description');
                    $form['image'] = addslashes(file_get_contents($_FILES['inputFile']['tmp_name']));

                    $confirmation = $this->services->insertPortfolio($form);
                    //verifica se o portfolio foi inserido no banco com sucesso
                    if ($confirmation)
                        redirect("service/portfolio/{$idService}");
                    else
                        $this->session->set_flashdata("erro", "Falha ao enviar comentário! Consulte administrador do sistema");
                }
            }
            $data["idService"] = $idService;
            $data['scripts'] = array(base_url("assets/js/funcoes.js"));
            $this->load->view("_inc/header", $data);
            $this->load->view("portfolio_form");
            $this->load->view("_inc/footer");
        }
    }

    /*
     * Editar portfolio
     */

    public function editPortfolio($idPortfolio) {
        //Verifica se o usuário está logado e ativo
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", 'services');
            if ($this->input->post()) {
                //validação CodeIgniter
                $this->load->library('form_validation');
                $this->form_validation->set_rules('description', 'Descrição', 'required');
                //verifica se houve carregamento da imagem para poder validar a imagem
                if (!empty($_FILES['inputFile']['name'])) {
                    $this->form_validation->set_rules('inputFile', 'imagem', 'callback_validate_image');
                }

                $this->form_validation->set_message('required', 'O campo %s é obrigatório');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

                if ($this->form_validation->run() !== FALSE) {
                    $form['description'] = $this->input->post('description');
                    //verifica se houve carregamento da imagem para poder atualizar os dadoss sem precisar atualizar a imagem
                    if (!empty($_FILES['inputFile']['name'])) {
                        $form['image'] = addslashes(file_get_contents($_FILES['inputFile']['tmp_name']));
                    }

                    //verifica se o portfolio foi atualizado no banco com sucesso
                    $confirmation = $this->services->updatePortfolio($idPortfolio, $form);
                    if ($confirmation)
                        redirect('profile/services');
                }
            }
            $data['portfolio'] = $this->services->getPortfolioById($idPortfolio);
            $data['scripts'] = array(base_url("assets/js/funcoes.js"));
            $this->load->view("_inc/header", $data);
            $this->load->view("portifolio_edit");
            $this->load->view("_inc/footer");
        }
    }

    /*
     * Deleta portfolio
     */

    public function deletePortfolio($idPortfolio) {
        //Verifica se o usuário está logado e ativo
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        } else {
            $this->load->model("Services_model", "services");
            $delete = $this->services->deletePortfolio($idPortfolio);
            //verifica se o portfolio foi deletado no banco com sucesso
            if ($delete) {
                $this->session->set_flashdata("mensagem", "Portfolio excluído com sucesso");
            } else {
                show_404();
            }
            redirect('profile/services');
        }
    }

    //callback do mapa para validação CodeIgniter
    public function points_maps() {
        if ($this->input->post('latitude') == NULL)
            return FALSE;
        else
            return TRUE;
    }

    /*
     * Ação do botão cancelar
     */

    public function cancel() {
        redirect('profile');
    }

    //callback para validação da imagem
    public function validate_image() {
        if ($_FILES['inputFile']['tmp_name'] !== '') {
            if ($_FILES['inputFile']['type'] == 'image/jpeg' || $_FILES['inputFile']['type'] == 'image/png' || $_FILES['inputFile']['type'] == 'image/jpg') {
                if ($_FILES['inputFile']['type'] <= 2097152) {
                    return true;
                } else {
                    $this->form_validation->set_message('validate_image', 'A imagem deve ter tamanho máximo de 2 MB');
                    return false;
                }
            } else {
                $this->form_validation->set_message('validate_image', 'Verifique se o tipo da imagem é JPEG ou PNG');
                return false;
            }
        } else {
            $this->form_validation->set_message('validate_image', 'Insira uma imagem para cadastrar um portfólio');
            return false;
        }
    }

}
