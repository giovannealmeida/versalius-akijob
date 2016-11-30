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
        $data = array();
        $data['scripts'] = array(
            base_url('assets/js/facebook-login.js'),
            'https://apis.google.com/js/api:client.js',
            base_url('assets/js/google-login.js'),
            base_url("assets/js/validator.js")
        );
        $this->load->model('Users_model', 'users');
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->load->model('Users_model', 'users');

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Senha', 'required');
            $this->form_validation->set_message('required', 'O campo <strong>%s</strong> é obrigatório');

            if ($this->form_validation->run() == true) {
                if ($user = $this->users->getUserLogin($this->input->post("email"), $this->input->post("password"), 1)) {
                    $this->session->set_userdata("logged_in", $user);
                    redirect("index");
                } else if ($user = $this->users->getUserLogin($this->input->post("email"), $this->input->post("password"), -1)) {
                    $this->session->set_userdata("logged_in", $user);
                    redirect("profile/account");
                } else {
                    $data["login_status"] = "error";
                }
            }
        }

        $this->load->view('_inc/header', $data);
        $this->load->view('login');
        $this->load->view('_inc/footer');
    }

    public function register() {
        $this->load->model('State_model', 'state');
        $this->load->model('City_model', 'city');
        if ($this->input->post()) {
            $this->load->model('Users_model', 'users');
            $this->load->model("Util_model", "util");
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fullname', 'Nome Completo', 'required|callback_validate_name');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'Senha', 'required|min_length[6]|max_length[22]');
            $this->form_validation->set_rules('password2', 'Digite a Senha Novamente', 'required|matches[password]|min_length[6]|max_length[22]');
            $this->form_validation->set_rules('birthDate', 'Data de Nascimento', 'required');
            $this->form_validation->set_rules('gender', 'Sexo', 'required|callback_gender');
            $this->form_validation->set_rules('termAcceptance', 'Termo de aceitação', 'required|callback_term');
            $this->form_validation->set_rules('avatar', 'Avatar', 'callback_validate_image');

            $this->form_validation->set_message('required', 'O campo %s é obrigatório');
            $this->form_validation->set_message('matches', 'As senhas não conferem');
            $this->form_validation->set_message('validate_name', 'O nome só pode conter letras');
            $this->form_validation->set_message('min_length', 'O campo %s deve conter de 6 a 22 caracteres');
            $this->form_validation->set_message('max_length', 'O campo %s deve conter de 6 a 22 caracteres');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            if ($this->form_validation->run() == true) {
                $user_insert = array(
                    'name' => $this->input->post('fullname'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'birthday' => date('Y-m-d', strtotime($this->input->post('birthDate'))),
                    'id_gender' => $this->input->post('gender'),
                    'id_city' => $this->input->post('selectCity'),
                    'phone' => $this->input->post('phone'),
                    'avatar' => $this->input->post('picture') != null ? $this->input->post('picture') : null,
                    'id_status' => 1,
                    'site' => $this->input->post('site'),
                    'facebook' => $this->input->post('facebook'),
                    'twitter' => $this->input->post('twitter'),
                    'avatar' => $this->util->resizeImage($_FILES['avatar'], 200, 200)
                );

                $user = $this->users->insert($user_insert);

                if ($user != null) {
                    $this->session->set_userdata('logged_in', $user);
                    redirect('index');
                }

                $this->session->set_flashdata('erro', 'Falha ao atualizar! Consulte administrador do sistema');
            } else {
                unset($_POST['termAcceptance']);
            }
        }

        if ($this->session->flashdata('temp_user_data')) {
            $data['user_profile'] = $this->session->flashdata('temp_user_data');
        }
        $data['states'] = $this->state->getAll();
        if ($this->input->post('selectState') != null) {
            $data['citys'] = $this->city->getCityByState($this->input->post('selectState'));
        } else {
            $data['citys'] = $this->city->getCityByState(1);
        }
        $helper = $this->facebook->getRedirectLoginHelper();
        $permissions = ['public_profile ', 'user_location', 'user_birthday', 'email', 'user_photos'];
        $data['login_url_facebook'] = $helper->getLoginUrl('http://localhost/akijob/callbacks/callback_facebook', $permissions);
        $data['login_url_google'] = $this->googleplus->loginURL();
        $data['styles'] = array(base_url('assets/css/style.css'));
        $data['scripts'] = array(
            base_url('assets/js/changeCity.js'),
            base_url('assets/js/funcoes.js'),
            'https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js',
            base_url('assets/js/mask.js'),
            base_url('assets/js/facebook-login.js'),
            'https://apis.google.com/js/api:client.js',
            base_url('assets/js/google-login.js'),
            base_url("assets/js/validator.js")
        );

        $this->load->view('_inc/header', $data);
        $this->load->view('register');
        $this->load->view('_inc/footer');
    }

    public function forgot_password($hash = null) {
        $this->load->view('_inc/header');
        $this->load->model('Users_model', 'users');
        if ($hash == null) {
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('email', 'email', 'required|valid_email');
                $this->form_validation->set_message('required', 'Digite um endereço de email');
                $this->form_validation->set_message('valid_email', 'Insira um email válido');

                if ($this->form_validation->run()) {
                    // $this->load->view('forgot_password', $data);
                    $email = $this->input->post('email');
                    $exists = $this->users->exists($email);
                    if ($exists) {
                        $this->load->model('Email_model');
                        if ($this->Email_model->send_forgotten_password($email, $exists)) {
                            $data['message'] = "Enviamos as instruções de recuperação de senha para seu email com sucesso!<br/><br/>Espere 5 segundos para ser redirecionado para tela inicial ou <a href=\"" . base_url("") . "\"> clique aqui</a>";
                            $data["scripts"] = array(base_url('assets/js/timer_redirect.js'));
                        } else {
                            $data['message'] = 'Houve um problema com o envio do email, contate o administrador';
                        }
                    } else {
                        $url = base_url('login/forgot_password');
                        $data['message'] = "Este email não está cadastrado no nosso sistema, <a href=\"{$url}\"> Clique aqui para tentar novamente</a> ";
                    }
                    $this->load->view('message_panel', $data);
                } else {
                    $this->load->view('forgot_password');
                }
            } else {
                $this->load->view('forgot_password');
            }
            $this->load->view('_inc/footer');
        } else {
            $id_user = $this->users->forgot_password($hash);

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
                $this->form_validation->set_rules('password2', 'password2', 'required|matches[password]');
                $this->form_validation->set_message('required', 'Digite todos os campos');
                $this->form_validation->set_message('matches', 'A senhas devem ser iguais');
                $this->form_validation->set_message('min_length', 'A senhas deve ter no mínimo 6 caracteres');
                $this->form_validation->set_error_delimiters('<li>', '</li>');

                if ($this->form_validation->run()) {
                    if ($id_user) {
                        $this->db->trans_start();

                        $result = $this->users->update(
                                $id_user, array('password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT))
                        );

                        $this->db->trans_complete();

                        $this->db->where('hash', $hash);
                        $this->db->delete('tb_forgotten_password_hash');
                        $data['message'] = "Senha alterada com sucesso<br/><br/>Espere 5 segundos para ser redirecionado para tela inicial ou <a href=\"" . base_url("") . "\"> clique aqui</a>";
                        $data["scripts"] = array(base_url('assets/js/timer_redirect.js'));

                        $this->load->view('message_panel', $data);
                        $this->load->view('_inc/footer');
                    } else {
                        $data['message'] = "Este link expirou ou não existe<br/><br/>Espere 5 segundos para ser redirecionado para tela inicial ou <a href=\"" . base_url("") . "\"> clique aqui</a>";
                        $data["scripts"] = array(base_url('assets/js/timer_redirect.js'));

                        $this->load->view('message_panel', $data);
                        $this->load->view('_inc/footer');
                    }
                } else {
                    $this->load->view('forgot_password_change');
                    $this->load->view('_inc/footer');
                }
            } else {
                if ($id_user) {
                    $this->load->view('forgot_password_change');
                    $this->load->view('_inc/footer');
                } else {
                    $data['message'] = 'Este link expirou ou não existe';
                    $data["scripts"] = array(base_url('assets/js/timer_redirect.js'));

                    $this->load->view('message_panel', $data);
                    $this->load->view('_inc/footer');
                }
            }
        }
    }

    public function validate_image() {
        if ($_FILES['avatar']['tmp_name'] !== '') {
            if ($_FILES['avatar']['type'] == 'image/jpeg' || $_FILES['avatar']['type'] == 'image/png' || $_FILES['avatar']['type'] == 'image/jpg') {
                return true;
            } else {
                $this->form_validation->set_message('validate_image', 'Verifique se o tipo da imagem é JPEG ou PNG');
                return false;
            }
        } else {
            return true;
        }
    }

    public function email_check($str) {
        $this->load->model('Users_model');
        if ($this->Users_model->exists($str)) {
            $this->form_validation->set_message('email_check', 'O email já foi cadastrado');

            return false;
        }

        return true;
    }

    public function gender() {
        if ($this->input->post('gender') == null) {
            $this->form_validation->set_message('gender', 'Selecione o sexo para continuar');

            return false;
        }

        return true;
    }

    public function term() {
        if ($this->input->post('termAcceptance') == null) {
            $this->form_validation->set_message('term', 'Para se cadastrar é necessário aceitar o termo de uso');

            return false;
        }

        return true;
    }

    public function logout() {
        session_destroy();
    }

    public function validate_name() {
        if ($this->input->post('fullname') != null) {
            if (!preg_match('/^[a-zA-ZáàâãéèêíìóòôõúüùûñÁÀÂÃÉÈÊÍÌÓÒÔÕÚÜÛÑ ]+$/', $this->input->post('fullname'))) {
                return false;
            }
        }

        return true;
    }

    public function callback_facebook() {
        $jsHelper = $this->facebook->getJavaScriptHelper();
        $facebookClient = $this->facebook->getClient();
        try {
            $accessToken = $jsHelper->getAccessToken($facebookClient);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }

        if (isset($accessToken)) {
            $accessToken = (string) $accessToken;

            $this->facebook->setDefaultAccessToken($accessToken);

            try {
                $response = $this->facebook->get('/me?fields=name,email');

                $aux = $response->getGraphUser();
                $data = array(
                    'name' => $aux->getName(),
                    'email' => $aux->getEmail(),
                    'id_auth' => $aux->getId(),
                    'gender' => $aux->getGender() == 'female' ? 2 : 1,
                    'link_rede' => "https://www.facebook.com/{$aux->getId()}",
                    //   'birthday' => $aux->getBirthday()->format('d/m/Y'),
                    'picture' => 'https://graph.facebook.com/' . $aux->getId() . '/picture?width=200',
                );
                $this->load->model('Users_model', 'users');

                // Check user exists and active
                if ($user = $this->users->getUserExternalAuth($data['email'], $data['id_auth'], 1)) {
                    $this->session->set_userdata('logged_in', $user);
                    redirect('index');
                }

                // Check user exists and disabled
                if ($user = $this->users->getUserExternalAuth($data['email'], $data['id_auth'], -1)) {
                    $this->session->set_userdata('logged_in', $user);
                    redirect('profile/account');
                }

                // Check email exists
                if ($this->users->exists($data['email'])) {
                    $this->session->set_flashdata("login_status", "exists");
                    redirect('login');
                }
                // create basic user and log in
                $insert = array('name' => $data['name'], 'email' => $data['email'], 'id_social' => $data['id_auth'], 'id_status' => 1, "avatar" => $data['picture']);

                $user = $this->users->insert($insert);
                if ($user) {
                    $this->session->set_userdata('logged_in', $user);
                    redirect('index');
                }
                die('Erro: Cannot create user by facebook login');
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
        }
    }

    public function callback_google($token = '') {
        $url = "https://www.googleapis.com/oauth2/v3/tokeninfo?id_token={$token}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);

        $data = array(
            'name' => $response['name'],
            'email' => $response['email'],
            'id_auth' => $response['sub'],
            'gender' => 1,
            'link_rede' => "https://plus.google.com/{$response['sub']}",
            'picture' => $response['picture'],
        );

        $this->load->model('Users_model', 'users');

        // Check user exists
        if ($user = $this->users->getUserExternalAuth($data['email'], $data['id_auth'], 1)) {
            $this->session->set_userdata('logged_in', $user);
            redirect('index');
        }

        if ($user = $this->users->getUserExternalAuth($data['email'], $data['id_auth'], -1)) {
            $this->session->set_userdata('logged_in', $user);
            redirect('profile/account');
        }

        if ($this->users->exists($data['email'])) {
            $this->session->set_flashdata("login_status", "exists");
            redirect('login');
        }

        $insert = array('name' => $data['name'], 'email' => $data['email'], 'id_social' => $data['id_auth'], 'id_status' => 1, 'avatar' => $data['picture']);

        $user = $this->users->insert($insert);
        if ($user) {
            $this->session->set_userdata('logged_in', $user);
            redirect('index');
        }
        die('Erro: Cannot create user by google login');
    }

}
