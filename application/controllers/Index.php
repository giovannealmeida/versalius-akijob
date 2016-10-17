<?php

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

		if (!$this->session->userdata("logged_in")) {
			redirect("login");
		} else {
			redirect("profile");
		}

    }

	public function index()
	{



	}
}
