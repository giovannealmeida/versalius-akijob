<?php

class Profile extends CI_Controller {

    private $user_info;

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else {
            $this->load->model("Recommendation_model", 'recommendation');
            $this->load->model("Users_model", "users");
            $this->load->model("Subscription_model", "subs");
            $this->load->model("City_model", "city");
            $this->load->model("State_model", "state");

            $this->user_info["user_profile"] = $this->session->userdata('logged_in');
            $this->user_info['recommendations_positive'] = $this->recommendation->getRecommendationPositiveByUser($this->user_info["user_profile"]->id);
            $this->user_info['recommendations_negative'] = $this->recommendation->getRecommendationNegativeByUser($this->user_info["user_profile"]->id);
            $tier_balance = $this->user_info['recommendations_positive'] - $this->user_info['recommendations_negative'];
            $this->user_info["tier_img"] = $this->users->getTierImage($this->user_info["user_profile"]->id, $tier_balance);
            $this->user_info["premium_data"]["isPremium"] = $this->subs->isSubscribed($this->user_info["user_profile"]->id);
            $this->user_info["scripts"] = array(base_url("assets/js/page-highlight.js"));
        }
    }

    public function index() {

        $data = $this->user_info;
        if ($data['user_profile']->id_status == -1) {
            redirect('profile/account');
        }
        $this->load->view("_inc/header", $data);
        $this->load->view("profile/menu");
        $this->load->view("profile/overview");
        $this->load->view("_inc/footer");
    }

    public function config() {
        $data = $this->user_info;
        if ($data['user_profile']->id_status == -1) {
            redirect('profile/account');
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fullname', 'Nome Completo', 'required|callback_validate_name');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('gender', 'Gênero', 'required');
            $this->form_validation->set_rules('birthDate', 'Data de Nascimento', 'required');
            $this->form_validation->set_rules('selectState', 'Estado', 'required');
            $this->form_validation->set_rules('selectCity', 'Cidade', 'required');

            $this->form_validation->set_message('required', 'O campo %s é obrigatório');
            $this->form_validation->set_message('validate_name', 'O nome só pode conter letras');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            if ($this->form_validation->run() !== FALSE) {
                $form['name'] = $this->input->post('fullname');
                $form['email'] = $this->input->post('email');
                $form['id_city'] = $this->input->post('selectCity');
                $form['id_gender'] = $this->input->post('gender');
                $form['birthday'] = $this->input->post('birthDate');
                $form['phone'] = $this->input->post('phone');
                $form['site'] = $this->input->post('site');
                $form['facebook'] = $this->input->post('facebook');
                $form['twitter'] = $this->input->post('twitter');
                if ($_FILES['upload_avatar']['tmp_name'] !== "") {
                    $form['avatar'] = addslashes(file_get_contents($_FILES['upload_avatar']['tmp_name']));
                }
                $confirmationUpdate = $this->users->update($data["user_profile"]->id, $form);
                if ($confirmationUpdate) {
                    $this->session->set_flashdata("mensagem_profile", "Cadastro atualizado com sucesso");
                    $user = $this->users->getUserById($data["user_profile"]->id);
                    $this->session->set_userdata('logged_in', $user);
                } else {
                    $this->session->set_flashdata("erro_profile", "Falha ao atualizar! Consulte administrador do sistema");
                }
                redirect('profile/config');
            } else {
                $this->session->set_flashdata("erro_validation_profile", validation_errors());
            }
        }

        $data['city'] = $this->city->getCityById($data["user_profile"]->id_city);
        $data['states'] = $this->state->getAll();
        $data['state'] = $this->state->getStateByCity($data['user_profile']->id_city);
        if (isset($data['state']->id)) {
            $data['citys'] = $this->city->getCityByState($data['state']->id);
        } else if ($this->input->post('selectState') != null) {
            $data['citys'] = $this->city->getCityByState($this->input->post('selectState'));
        } else {
            $data['citys'] = $this->city->getCityByState(1);
        }
        $data["scripts"] = array(
            base_url("assets/js/profile-config.js"),
            "https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js",
            base_url("assets/js/mask.js"),
            base_url('assets/js/changeCity.js'),
            base_url("assets/js/validator.js")
        );
        $this->load->view("_inc/header", $data);
        $this->load->view("profile/menu");
        $this->load->view("profile/config");
        $this->load->view("_inc/footer");
    }

    public function plan() {
        $data = $this->user_info;
        if ($data['user_profile']->id_status == -1) {
            redirect('profile/account');
        }
        if ($data["premium_data"]["isPremium"]) {
            $data["plan"] = "PREMIUM";
            $data["plan_class"] = "success";
            $data["date_end"] = date('d/m/Y', strtotime($this->subs->getEndSubscription($data["user_profile"]->id)));
        } else {
            $data["plan"] = "Grátis";
            $data["plan_class"] = "default";
        }

        $data['scripts'] = array(
            base_url("assets/js/validator.js")
        );

        $this->load->view("_inc/header", $data);
        $this->load->view("profile/menu");
        $this->load->view("profile/subscription");
        $this->load->view("_inc/footer");
    }

    public function account() {
        $data = $this->user_info;
        $this->load->view("_inc/header", $data);
        if ($data['user_profile']->id_status == 1) {
            $this->load->view("profile/menu");
        }
        $this->load->view("profile/account");
        $this->load->view("_inc/footer");
    }

    public function alterPassword() {
        $data = $this->user_info;
        if ($data['user_profile']->id_status == -1) {
            redirect('profile/account');
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            if ($data["user_profile"]->password !== NULL)
                $this->form_validation->set_rules('oldPassword', 'Senha Atual', 'trim|required');
            $this->form_validation->set_rules('password', 'Nova Senha', 'trim|required|min_length[8]|max_length[22]');
            $this->form_validation->set_rules('ConfirmPassword', 'Confirmar Nova Senha', 'required|matches[password]|min_length[8]|max_length[22]');

            $this->form_validation->set_message('required', 'O campo %s é obrigatório');
            $this->form_validation->set_message('matches', 'As senhas não conferem');
            $this->form_validation->set_message('min_length', 'O campo %s deve conter de 8 a 22 caracteres');
            $this->form_validation->set_message('max_length', 'O campo %s deve conter de 8 a 22 caracteres');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() !== FALSE) {
                if ($data["user_profile"]->password !== NULL) {
                    if ($this->users->validatePassword($data["user_profile"]->id, sha1($this->input->post('oldPassword')))) {
                        $form['password'] = sha1($this->input->post('password'));
                        $confirmationUpdate = $this->users->update($data["user_profile"]->id, $form);
                        if ($confirmationUpdate) {
                            $this->session->set_flashdata("mensagem_password", "Senha cadastrada com sucesso");
                            $user = $this->users->getUserById($data["user_profile"]->id);
                            $this->session->set_userdata('logged_in', $user);
                        } else {
                            $this->session->set_flashdata("erro_password", "Falha ao atualizar! Consulte administrador do sistema");
                        }
                    } else {
                        $this->session->set_flashdata("erro_password", "Senha antiga incorreta");
                    }
                } else {
                    $form['password'] = sha1($this->input->post('password'));
                    $confirmationUpdate = $this->users->update($data["user_profile"]->id, $form);
                    if ($confirmationUpdate) {
                        $this->session->set_flashdata("mensagem_password", "Senha cadastrada com sucesso");
                        $user = $this->users->getUserById($data["user_profile"]->id);
                        $this->session->set_userdata('logged_in', $user);
                    } else {
                        $this->session->set_flashdata("erro_password", "Falha ao atualizar! Consulte administrador do sistema");
                    }
                }
                redirect('profile/config#alter_pass');
            } else {
                $this->session->set_flashdata("erro_validation_password", validation_errors());
            }
        }
        redirect('profile/config#alter_pass');
    }

    public function services() {
        $data = $this->user_info;
        if ($data['user_profile']->id_status == -1) {
            redirect('profile/account');
        }
        $this->load->model("Services_model", "services");
        $data['services'] = $this->services->getServicesByUser($data["user_profile"]->id);


        $this->load->view("_inc/header", $data);
        $this->load->view("profile/menu");
        $this->load->view("profile/services");
        $this->load->view("_inc/footer");
    }

    public function recommendations($idService, $id_recommendation) {
        if ($data['user_profile']->id_status == -1) {
            redirect('profile/account');
        }
        $this->load->model("Users_model", 'user');
        $this->load->model("Recommendation_model", 'recommendation');
        $user_service = $this->users->getUserByService($idService);
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

    public function excluir($idUser) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id == $idUser) {
            $this->load->model("Users_model", "users");
            $delete = $this->users->excluir($idUser);
            if ($delete) {
                session_destroy();
                redirect('index');
            } else {
                show_404();
            }
            redirect('profile/services');
        }
    }

    public function disable($idUser) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id == $idUser) {
            $this->load->model("Users_model", "users");
            $data['id_status'] = -1;
            $disable = $this->users->update($idUser, $data);
            if ($disable) {
                session_destroy();
                redirect('index');
            } else {
                show_404();
            }
            redirect('profile/services');
        }
    }

    public function active($idUser) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata('logged_in')->id == $idUser) {
            $this->load->model("Users_model", "users");
            $data['id_status'] = 1;
            $active = $this->users->update($idUser, $data);
            if ($active) {
                $user = $this->users->getUserById($this->session->userdata('logged_in')->id);
                $this->session->set_userdata('logged_in', $user);
                redirect('index');
            } else {
                show_404();
            }
            redirect('profile/services');
        }
    }

    public function validate_name() {
        if ($this->input->post('fullname') != NULL) {
            if (!preg_match('/^[a-zA-ZáàâãéèêíìóòôõúüùûñÁÀÂÃÉÈÊÍÌÓÒÔÕÚÜÛÑ ]+$/', $this->input->post('fullname'))) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function statistics() {
        $data = $this->user_info;
		$data['typeGraphic'] = array(
			'Visitas'=>'Visitas',
			'Visitantes' => 'Visitantes'
		);
		$data['months'] = array(
			'0' => '',
			'1' => "Janeiro",
			'2' => 'Fevereiro',
			'3' => 'Março',
			'4' => 'Abril',
			'5' => 'Maio',
			'6' => 'Junho',
			'7' => 'Julho',
			'8' => 'Agosto',
			'9' => 'Setembro',
			'10' => 'Outubro',
			'11' => 'Novembro',
			'12' => 'Dezembro',
		);
		$data['years'] = array(
		'0'=>'', 
		'2016'=>"2016",
		);
		$this->load->view("_inc/header", $data);
	    $this->load->view("profile/menu");
	    $this->load->view("profile/statistics");
	    $this->load->view("_inc/footer");       
    }
	
	public function redirectGraphic(){
		$data = $this->input->post();
		
		if($data['selectTypeGraphic'] == 'Visitas'){
			redirect('graphics/visitsGraphics/'.$data['selectMonth'].'/'.$data['selectYear']);
		}
		else if($data['selectTypeGraphic'] == 'Visitantes'){
			redirect('graphics/visitorsGraphics/'.$data['selectMonth'].'/'.$data['selectYear']);
		}	
	}

}
