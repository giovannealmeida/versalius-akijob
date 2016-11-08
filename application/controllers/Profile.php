<?php

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index() {
        $this->load->model("Services_model", "services");
        $this->load->model("Users_model", "user");
        $this->load->model("City_model", 'city');
        $this->load->model("State_model", 'state');

        $data["user_profile"] = $this->session->userdata('logged_in');
        $data['services'] = $this->services->getServicesByUser($data["user_profile"]->id);
        $data['city'] = $this->city->getCityById($data["user_profile"]->id_city);
        $data['state'] = $this->state->getStateByCity($data['user_profile']->id_city);
        $data['recommendations'] = $data["user_profile"]->positive_recommendations - $data["user_profile"]->negative_recommendations;

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
        $this->load->model("Services_model", "services");
        $data["user_profile"] = $this->session->userdata('logged_in');
        $data["premium_data"]["isPremium"] = $this->subs->isSubscribed($data["user_profile"]->id);
        $data['services'] = $this->services->getServicesByUser($data["user_profile"]->id);

        $this->load->view("_inc/header", $data);
        $this->load->view("profile/services", $data);
        $this->load->view("_inc/footer");
    }

    public function positive_recommendations($idService) {
        $this->load->model("Users_model", 'user');
        $data["user_profile"] = $this->session->userdata('logged_in');
        $form['positive_recommendations'] = $data["user_profile"]->positive_recommendations + 1;

        $this->user->update($data["user_profile"]->id, $form);
        $user = $this->user->getUserById($data["user_profile"]->id);
        $this->session->set_userdata('logged_in', $user);
        redirect("service/toView/{$idService}");
    }

    public function negative_recommendations($idService) {
        $this->load->model("Users_model", 'user');
        $data["user_profile"] = $this->session->userdata('logged_in');
        $form['negative_recommendations'] = $data["user_profile"]->negative_recommendations + 1;
        $this->user->update($data["user_profile"]->id, $form);
        $user = $this->user->getUserById($data["user_profile"]->id);
        $this->session->set_userdata('logged_in', $user);
        redirect("service/toView/{$idService}");
    }

}
