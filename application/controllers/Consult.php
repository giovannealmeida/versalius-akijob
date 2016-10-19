<?php

class consult extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getCityByState($id_state) {
        $this->load->model('City_model');

        $result = $this->City_model->getCityByState($id_state);
        echo json_encode($result);
        die;
    }

}
