<?php

class Novo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


    }

    public function search()
	{

        $this->load->view("search");
	}

    public function results()
	{

        $this->load->view("results");
	}

    public function foursquare()
	{

        $this->load->view("foursquare_boot");
	}


}
