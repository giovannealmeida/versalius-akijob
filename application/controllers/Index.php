<?php

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->facebook = new Facebook\Facebook([
          'app_id' => '1330791536954247',
          'app_secret' => '71ba607dfdc732389a7cc46a6ee209d8',
          'default_graph_version' => 'v2.5',
        ]);
        $this->load->library('googleplus');

    }

	public function index()
	{
        $data = array();
        if ($this->session->userdata("logged_in")) {
            $data["user_name"] = $this->session->userdata("logged_in")->name;
        } else {
            $helper = $this->facebook->getRedirectLoginHelper();
            $permissions = ['public_profile ', 'user_location', 'user_birthday', 'email'];
            $data['login_url_facebook'] = $helper->getLoginUrl('http://localhost/akijob/callbacks/callback_facebook', $permissions);
            $data['login_url_google'] = $this->googleplus->loginURL();

        }


        $this->load->view("index", $data);
	}
}
