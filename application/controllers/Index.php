<?php

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data["user_profile"] = $this->session->userdata('logged_in');
        if ($this->input->post() != NULL) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('selectJob', 'Serviços', 'required');
            $this->form_validation->set_rules('selectCity', 'Cidade', 'required');

            $this->form_validation->set_message('required', 'Preencha todos os campos para pesquisar');

            if ($this->form_validation->run() !== FALSE) {
                $idService = $this->input->post('selectJob');
                $idCity = $this->input->post('selectCity');
                redirect("results/index/{$idService}/{$idCity}");
            }
        }
        $data["scripts"] = array(
            base_url("assets/js/ajax-bootstrap-select.min.js"),
            base_url("assets/js/search.js")
        );
        $data["styles"] = array(base_url('assets/css/akijob.css'));
        $this->load->view("_inc/header", $data);
        $this->load->view("search");
        $this->load->view("_inc/footer");
    }

}
