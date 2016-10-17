<?php

class Maps_register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("maps_register.php");
    }
}
