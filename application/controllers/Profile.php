<?php

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index(){
        $this->load->model("Recommendation_model", 'recommendation');
        $this->load->model("Subscription_model", "subs");

        $data["user_profile"] = $this->session->userdata('logged_in');
        if ($data["user_profile"]->avatar === null)
            $data["scr_photo"] = base_url('/assets/pages/media/profile/profile_user.png');
        elseif ($data["user_profile"]->avatar == base64_decode(base64_encode(stripslashes($data["user_profile"]->avatar))))
            $data["scr_photo"] = $data["user_profile"]->avatar;
        else
            $data["scr_photo"] = 'data:image/jpeg;base64,' . base64_encode(stripslashes($data["user_profile"]->avatar));

        $data["premium_data"]["isPremium"] = $this->subs->isSubscribed($data["user_profile"]->id);
        $data['recommendations_positive'] = $this->recommendation->getRecommendationPositiveByUser($data["user_profile"]->id);
        $data['recommendations_negative'] = $this->recommendation->getRecommendationNegativeByUser($data["user_profile"]->id);
        $data["scripts"] = array(base_url("assets/js/page-highlight.js"));
        $this->load->view("_inc/header", $data);
        $this->load->view("profile/menu");
        $this->load->view("profile/overview");
        $this->load->view("_inc/footer");
    }

    public function config(){
        $this->load->model("Recommendation_model", 'recommendation');

        $data["user_profile"] = $this->session->userdata('logged_in');
        if ($data["user_profile"]->avatar === null)
            $data["scr_photo"] = base_url('/assets/pages/media/profile/profile_user.png');
        elseif ($data["user_profile"]->avatar == base64_decode(base64_encode(stripslashes($data["user_profile"]->avatar))))
            $data["scr_photo"] = $data["user_profile"]->avatar;
        else
            $data["scr_photo"] = 'data:image/jpeg;base64,' . base64_encode(stripslashes($data["user_profile"]->avatar));

        $data['recommendations_positive'] = $this->recommendation->getRecommendationPositiveByUser($data["user_profile"]->id);
        $data['recommendations_negative'] = $this->recommendation->getRecommendationNegativeByUser($data["user_profile"]->id);
        $data["scripts"] = array(base_url("assets/js/page-highlight.js"), base_url("assets/js/profile-config.js"));
        $this->load->view("_inc/header", $data);
        $this->load->view("profile/menu");
        $this->load->view("profile/config");
        $this->load->view("_inc/footer");
    }

    public function old() {
        $this->load->model("Services_model", "services");
        $this->load->model("Users_model", "user");
        $this->load->model("City_model", 'city');
        $this->load->model("State_model", 'state');
        $this->load->model("Recommendation_model", 'recommendation');

        $data["user_profile"] = $this->session->userdata('logged_in');
        $data['services'] = $this->services->getServicesByUser($data["user_profile"]->id);
        $data['city'] = $this->city->getCityById($data["user_profile"]->id_city);
        $data['state'] = $this->state->getStateByCity($data['user_profile']->id_city);
        $data['recommendations'] = $this->recommendation->getRecommendationByUser($data["user_profile"]->id);
        $data['recommendations_positive'] = $this->recommendation->getRecommendationPositiveByUser($data["user_profile"]->id);
        $data['recommendations_negative'] = $this->recommendation->getRecommendationNegativeByUser($data["user_profile"]->id);

        $this->load->view("_inc/header", $data);
        $this->load->view("profile");
        $this->load->view("_inc/footer");
    }

    public function edit() {
        $data["user_profile"] = $this->session->userdata('logged_in');
        $this->load->model("Gender_model", "gender");
        $this->load->model("State_model", "state");
        $this->load->model("City_model", "city");
        $this->load->model("Users_model", "user");

        if ($this->input->post() != NULL) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fullname', 'Nome', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('gender', 'Gênero', 'required');
            $this->form_validation->set_rules('birthDate', 'Data de Nascimento', 'required');
            $this->form_validation->set_rules('selectState', 'Estado', 'required');
            $this->form_validation->set_rules('selectCity', 'Cidade', 'required');

            $this->form_validation->set_message('required', 'O campo %s é obrigatório');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            if ($this->form_validation->run() !== FALSE) {
                $form['name'] = $this->input->post('fullname');
                $form['email'] = $this->input->post('email');
                $form['id_city'] = $this->input->post('selectCity');
                $form['id_gender'] = $this->input->post('gender');
                $form['birthday'] = $this->input->post('birthDate');
                $form['phone'] = $this->input->post('phone');
                if ($_FILES['avatar']['tmp_name'] !== "") {
                    $form['avatar'] = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
                }
                $confirmationUpdate = $this->user->update($data["user_profile"]->id, $form);
                if ($confirmationUpdate) {
                    $this->session->set_flashdata("mensagem", "Cadastro atualizado com sucesso");
                    $user = $this->user->getUserById($data["user_profile"]->id);
                    $this->session->set_userdata('logged_in', $user);
                } else {
                    $this->session->set_flashdata("erro", "Falha ao atualizar! Consulte administrador do sistema");
                }
                redirect('profile');
            }
        }

        $data['genders'] = $this->gender->getAll();
        $data['states'] = $this->state->getAll();
        $data['state'] = $this->state->getStateByCity($data['user_profile']->id_city);
        $data['citys'] = $this->city->getCityByState($data['state']->id);
        $data['scripts'] = array(
            base_url("assets/js/changeCity.js"),
            base_url("assets/js/funcoes.js"));
        $this->load->view("_inc/header", $data);
        $this->load->view("edit_user");
        $this->load->view("_inc/footer");
    }

    public function alterPassword() {
        $data["user_profile"] = $this->session->userdata('logged_in');
        $this->load->model("Users_model", "user");
        if ($this->input->post() != NULL) {
            $this->load->library('form_validation');
            if ($data["user_profile"]->password !== NULL)
                $this->form_validation->set_rules('oldPassword', 'Senha antiga', 'trim|required');
            $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[8]|max_length[22]');
            $this->form_validation->set_rules('ConfirmPassword', 'Confirmação da senha', 'required|matches[password]|min_length[8]|max_length[22]');

            $this->form_validation->set_message('required', 'O campo %s é obrigatório');
            $this->form_validation->set_message('matches', 'As senhas não conferem');
            $this->form_validation->set_message('min_length', 'A %s tem que ter no mínimo 8 caracteres');
            $this->form_validation->set_message('max_length', 'A %s tem que ter no máximo 22 caracteres');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() !== FALSE) {
                if ($data["user_profile"]->password !== NULL) {
                    if ($this->user->validatePassword($data["user_profile"]->id, sha1($this->input->post('oldPassword')))) {
                        $form['password'] = sha1($this->input->post('password'));
                        $confirmationUpdate = $this->user->update($data["user_profile"]->id, $form);
                        if ($confirmationUpdate) {
                            $this->session->set_flashdata("mensagem", "Senha cadastrada com sucesso");
                            $user = $this->user->getUserById($data["user_profile"]->id);
                            $this->session->set_userdata('logged_in', $user);
                        } else {
                            $this->session->set_flashdata("erro", "Falha ao atualizar! Consulte administrador do sistema");
                        }
                    } else {
                        $this->session->set_flashdata("erro", "Senha antiga incorreta");
                    }
                } else {
                    $form['password'] = sha1($this->input->post('password'));
                    $confirmationUpdate = $this->user->update($data["user_profile"]->id, $form);
                    if ($confirmationUpdate) {
                        $this->session->set_flashdata("mensagem", "Senha cadastrada com sucesso");
                    } else {
                        $this->session->set_flashdata("erro", "Falha ao atualizar! Consulte administrador do sistema");
                    }
                }
                redirect('profile/alterPassword');
            }
        }
        $this->load->view("_inc/header", $data);
        $this->load->view("profile/alterPassword");
        $this->load->view("_inc/footer");
    }

    public function services() {
        $this->load->model("Subscription_model", "subs");
        $data["user_profile"] = $this->session->userdata('logged_in');
        if ($data["user_profile"]->avatar === null){
            $data["scr_photo"] = base_url('/assets/pages/media/profile/profile_user.png');
        }
        elseif ($data["user_profile"]->avatar == base64_decode(base64_encode(stripslashes($data["user_profile"]->avatar)))){
            $data["scr_photo"] = $data["user_profile"]->avatar;
        }
        else{
            $data["scr_photo"] = 'data:image/jpeg;base64,' . base64_encode(stripslashes($data["user_profile"]->avatar));
        }
        $data["premium_data"]["isPremium"] = $this->subs->isSubscribed($data["user_profile"]->id);
        $this->load->model("Services_model", "services");
        $data['services'] = $this->services->getServicesByUser($data["user_profile"]->id);
        $data["scripts"] = array(base_url("assets/js/page-highlight.js"));


        $this->load->view("_inc/header", $data);
        $this->load->view("profile/menu");
        $this->load->view("profile/services");
        $this->load->view("_inc/footer");

    }

    public function recommendations($idService, $id_recommendation) {
        $this->load->model("Users_model", 'user');
        $this->load->model("Recommendation_model", 'recommendation');
        $user_service = $this->user->getUserByService($idService);
        $form = array('id_user' => $this->session->userdata('logged_in')->id, 'id_user_receiver' => $user_service, 'value' => $id_recommendation);
        $recommendation = $this->recommendation->getRecommendation($this->session->userdata('logged_in')->id, $user_service);
        if ($recommendation) {
            if ($recommendation->value == $id_recommendation)
                $this->recommendation->delete_recommendation($form);
            else
                $this->recommendation->update_recommendation($form);
        } else {
            $this->recommendation->insert_recommendation($form);
        }
        redirect("service/toView/{$idService}");
    }

}
