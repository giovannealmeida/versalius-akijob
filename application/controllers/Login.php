<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in')) {
            redirect('index');
        } else {
            // var_dump($this->session->userdata('logged_in'));
        }

        $this->facebook = new Facebook\Facebook([
            'app_id' => '1330791536954247',
            'app_secret' => '71ba607dfdc732389a7cc46a6ee209d8',
            'default_graph_version' => 'v2.5',
        ]);
        $this->load->library('googleplus');
    }

    public function index() {
        $this->load->model('Users_model', 'users');

        if ($this->input->post()) { // Login email/senha
            $user = $this->users->getUser($this->input->post('email'), sha1($this->input->post('password')));
            if ($user == null) {
                $this->session->set_flashdata('account_exists', 1);
                $this->session->set_flashdata("login_error", "E-mail ou senha incorretos");
            } else {

                $this->session->set_userdata('logged_in', $user);
                redirect('index');
            }
        } elseif ($this->session->flashdata('user_data')) { // Autenticação externa
            $user_profile = $this->session->flashdata('user_data')['user_profile'];

            if ($this->users->exists($user_profile['email'])) {
                $user = $this->users->getUserExternalAuth($user_profile['email'], $user_profile['id_auth'], $this->session->flashdata('user_data')['type']);
                if ($user == null) { // Bloquear novo insert
                    $this->session->set_flashdata('email_exists', true);
                    $this->session->set_flashdata('temp_user_data', $user_profile);
                    redirect('login/register');
                } else { // Realizar login com o email da autenticação externa
                    $this->session->set_userdata('logged_in', $user);
                    redirect('index');
                }

                $user = null;
            } else { // Realiza cadastro da autenticação externa
                $user_insert = array('name' => $user_profile['name'], 'email' => $user_profile['email'], 'link_social_media' => $user_profile['link_rede']);
                $user_insert['id_gender'] = $user_profile['gender'] == 'male' ? 1 : 2;
                if ($this->session->flashdata('user_data')['type'] == 'facebook') {
                    $key = 'id_facebook';
                } else {
                    $key = 'id_google';
                }
                $user_insert[$key] = $user_profile['id_auth'];
                if (!isset($user_profile['birthday'])) {
                    $this->session->set_flashdata("temp_user_data", $user_insert);
                    redirect("login/register");
                }
                $user_insert['birthday'] = date('Y-m-d', strtotime($user_profile['birthday']));
                $user = $this->users->insert($user_insert);

                $this->session->set_userdata('logged_in', $user);
                redirect('index');
            }
        }

        $helper = $this->facebook->getRedirectLoginHelper();
        $permissions = ['public_profile ', 'user_location', 'user_birthday', 'email'];
        $data['login_url_facebook'] = $helper->getLoginUrl('http://localhost/akijob/callbacks/callback_facebook', $permissions);
        $data['login_url_google'] = $this->googleplus->loginURL();

        $this->load->view('login', $data);
    }

    public function register() {
        $this->load->model("State_model", 'state');
        $this->load->model("City_model", 'city');
        if ($this->input->post()) {
            $this->load->model('Users_model', 'users');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fullname', 'Nome Completo', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'Senha', 'required');
            $this->form_validation->set_rules('password2', 'Digite a Senha Novamente', 'required|matches[password]');
            $this->form_validation->set_rules('birthDate', 'Data de Nascimento', 'required');
            $this->form_validation->set_rules('termAcceptance', 'Termo de aceitação', 'required');
            $this->form_validation->set_rules('gender', 'Sexo', 'required');

            $this->form_validation->set_message('required', 'O campo %s é obrigatório');
            $this->form_validation->set_message('matches', 'As senhas não conferem');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            if ($this->form_validation->run() == true) {
                $user_insert = array(
                    "name" => $this->input->post("fullname"),
                    "email" => $this->input->post("email"),
                    "password" => sha1($this->input->post("password")),
                    "birthday" => date('Y-m-d', strtotime($this->input->post("birthDate"))),
                    "id_gender" => $this->input->post("gender"),
                    "id_city" => $this->input->post('selectCity')
                );

                $user = $this->users->insert($user_insert);

                if ($user != null) {
                    $this->session->set_userdata("logged_in", $user);
                    redirect("index");
                }

                $this->session->set_flashdata("erro", "Falha ao atualizar! Consulte administrador do sistema");
            }
        }

        if ($this->session->flashdata('temp_user_data')) {
            $data['user_profile'] = $this->session->flashdata('temp_user_data');
        }

        $data['id'] = NULL;
        $data['action'] = 'login/register';
        $data['title'] = 'Cadastrar';
        $data['titleAction'] = 'Cadastre-se';
        $data['states'] = $this->state->getAll();
        if ($this->input->post('selectState') != NULL) {
            $data['citys'] = $this->city->getCityByState($this->input->post('selectState'));
        } else {
            $data['citys'] = $this->city->getCityByState(1);
        }
        $helper = $this->facebook->getRedirectLoginHelper();
        $permissions = ['public_profile ', 'user_location', 'user_birthday', 'email'];
        $data['login_url_facebook'] = $helper->getLoginUrl('http://localhost/akijob/callbacks/callback_facebook', $permissions);
        $data['login_url_google'] = $this->googleplus->loginURL();

        $this->load->view('cadastro', $data);
    }

    public function forgot_password() {
        $this->load->view('senha');
    }

    public function email_check($str) {
        $this->load->model('Users_model', 'users');
        if ($this->users->exists($str)) {
            $this->form_validation->set_message('email_check', 'O email já foi cadastrado');
            return false;
        }

        return true;
    }

    public function logout() {
        session_destroy();
=======
    public function forgot_password($hash = null)
    {
        $data = array("success" => false);
        $this->load->model('Users_model', 'users');
        if ($hash == null) {
            if ($this->input->post()) {
                $email = $this->input->post('email');
                $exists = $this->users->exists($email);
                if ($exists) {
                    $this->load->model('Email_model');
                    $data['success'] = $this->Email_model->send_forgotten_password($email, $exists);
                }

            }

            $this->load->view('forgot_password', $data);
        }
        else {
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
                $this->form_validation->set_rules('password2', 'password2', 'required|matches[password]');
                $this->form_validation->set_message('required', 'Digite todos os campos');
                $this->form_validation->set_message('matches', 'A senhas devem ser iguais');
                $this->form_validation->set_message('min_length', 'A senhas deve ter no mínimo 6 caracteres');
                $this->form_validation->set_error_delimiters('<li>', '</li>');

                if ($this->form_validation->run())
                {

                    if ($this->session->flashdata("user")) {
                        $this->db->trans_start();

                        $this->users->update(
                            $this->session->flashdata("user"),
                            array("password" => sha1($this->input->post("password")))
                        );
                        $this->db->trans_complete();

                        $this->db->where("hash", $hash);
                        $this->db->delete("tb_forgotten_password_hash");
                        $data["message"] = "Senha alterada com sucesso";
                        $this->load->view("message_panel", $data);
                    }
                }
            }

            $id_user = $this->users->forgot_password($hash);
            if ($id_user) {
                $this->session->set_flashdata("user", true);
                $this->load->view('forgot_password_change');
            } else {
                $data["message"] = "Este link expirou ou não existe";
                $this->load->view("message_panel", $data);

            }


        }
>>>>>>> Stashed changes

    }

}
