<?php

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data["user_profile"] = $this->session->userdata('logged_in');

        $this->load->view("profile", $data);
    }
}
