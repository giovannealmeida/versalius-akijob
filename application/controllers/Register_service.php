<?php

class Register_service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model("Register_service_model");
        $this->load->model("State_model");
        $jobs = $this->Register_service_model->getJobsAll();
        $states = $this->State_model->getStatesAll();
        $data = array("jobs" => $jobs,
                      "states" => $states
                    );
        $this->load->view("register_service.php", $data);
    }
}
