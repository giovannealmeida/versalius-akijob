<?php

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->facebook = new Facebook\Facebook([
            'app_id' => '1330791536954247',
            'app_secret' => '71ba607dfdc732389a7cc46a6ee209d8',
            'default_graph_version' => 'v2.5',
        ]);
        $this->load->library('googleplus');
    }

    public function index() {
        $this->load->model("Services_model", 'service');
        $this->load->model("City_model", 'city');
        $data["user_profile"] = $this->session->userdata('logged_in');
        $data['jobs'] = $this->service->getJobsAll();
        $data['citys'] = $this->city->getAllWithStateInitials();
        $this->load->view("search", $data);
    }

}
