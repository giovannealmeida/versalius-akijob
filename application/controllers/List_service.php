<?php

class List_service extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model("List_service_model");
        $services = $this->List_service_model->getServicesAll();
        $data = array("services" => $services);
        $this->load->view("list_service.php", $data);
    }

}
